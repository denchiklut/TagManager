<?php

namespace App\Http\Controllers;

use App\Models\Triggers;
use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Templates;
use App\Http\Resources\ComponyResource;
use DB;

class AddPixel extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return ComponyResource::collection(Companies::orderBy('id', 'desc')->get());

    }



    public function store(Request $request)
    {


        $url  = $request->url ? $request->url: exit;    //сохраняем url

        $campaing = new Companies();


        /* выборка id из таблиц */
        $resultCampaigns = Companies::orderby('id','id_campaign')->first();//из таблицы Campaigns выбираем последний id

        /* выборка id из таблиц */


        /*определение id элементов*/
        $id_campaign = (int)$resultCampaigns->id_campaign + 1;
        /*определение id элементов*/


        /* создание уникального имени проекта */
        $signature = maskCompani($url)."_".$id_campaign;
        /* создание уникального имени проекта */


        /* статичные данные */
        $password = 'htnfhutn';
       // $body = codeBody($id_campaign);
       // $RedirectUrl = "https://rpt.reffection.com/?idClient=$"."IDCLIENT&idCampaign=$"."IDCAMPAIGN&number=$"."NUMBER&userData=$"."USERDATA";
        /* статичные данные */

        $TemplatesDefaulr  = Templates::where('default',1)->first();





        /* запись в таблицы компании */
         $campaing->id_client = '16';
         $campaing->id_campaign = $id_campaign;
         $campaing->password = $password;
         $campaing->signature = $signature;
         $campaing->sig = hash('sha1',$id_campaign.$signature.$password.$url);
         $campaing->url = $url;

         $campaing->save();

        /* запись в таблицы компании */


        /* Запись в бд лидслаб */
          //  $sql = DB::connection('sqlsrv2')->select("exec [InsertCustomer] '".$signature."', 16, '".$id_campaign."', 'htnfhutn', '".$url."', '".$RedirectUrl."' , null");
        /* Запись в бд лидслаб */


        /* запись в таблицы код */


        $hash_code = hash('sha1',$id_campaign.$signature.$password.$url);


     return response()->json(['hash_code' => $hash_code,  'signature' => $signature, 'data' => $campaing]);

    }


    public function update(Request $request, $id)
    {
        $campaign = Companies::find($id);
        $campaign->update([
            'id_client' => $request->input('id_client'),
            'id_campaign' => $request->input('id_campaign'),
            'password' => $request->input('password'),
            'signature' => $request->input('signature'),
            'sig' => $request->input('sig'),
            'url' => $request->input('url'),

        ]);

        return response()->json(['message' => 'compaing updated successful']);
    }


    public function destroy($id)
    {
        $compaing = Companies::find($id);

        Triggers::where('id_campaign', $compaing->id_campaign)->delete();

        Companies::destroy($id);

        return response()->json(['message' => 'Pixel deleted successfully']);
    }
}
