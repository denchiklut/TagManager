<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaigns;
use App\Entities;
use App\Http\Resources\ComponyResource;
use Carbon\Carbon;
use DB;

class AddPixel extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return ComponyResource::collection(Campaigns::orderBy('id', 'desc')->get());

    }



    public function store(Request $Request)
    {

        $url  = $Request->url ? $Request->url: exit;    //сохраняем url

        $campaing = new Campaigns();


        /* выборка id из таблиц */
        $resultCampaigns = Campaigns::orderby('id','id_campaign')->first();//из таблицы Campaigns выбираем последний id

        $resultEntities  = Entities::orderby('id','tm_id')->first();//из таблицы Entities выбираем последний id
        /* выборка id из таблиц */


        /*определение id элементов*/
        $tm_id = (int)$resultEntities->tm_id + 1;
        $id_campaign = (int)$resultCampaigns->id_campaign + 1;
        /*определение id элементов*/


        /* создание уникального имени проекта */
        $signature = maskCompani($url)."_".$id_campaign;
        /* создание уникального имени проекта */


        /* статичные данные */
        $password = 'htnfhutn';
        $body = codeBody($id_campaign);
        $RedirectUrl = "https://rpt.reffection.com/?idClient=$"."IDCLIENT&idCampaign=$"."IDCAMPAIGN&number=$"."NUMBER&userData=$"."USERDATA";
        /* статичные данные */


        /* запись в таблицы компании */

         $campaing->id_client = '15';
         $campaing->id_campaign = $id_campaign;
         $campaing->password = $password;
         $campaing->signature = $signature;
         $campaing->sig = hash('sha1',$id_campaign.$signature.$password.$url);
         $campaing->url = $url;
         $campaing->tm_id = $tm_id;

         $campaing->save();

        /* запись в таблицы компании */


        /* Запись в бд лидслаб */
          //  $sql = DB::connection('sqlsrv2')->select("exec [InsertCustomer] '".$signature."', 16, '".$id_campaign."', 'htnfhutn', '".$url."', '".$RedirectUrl."' , null");
        /* Запись в бд лидслаб */


        /* запись в таблицы код */

        $entity = new Entities();
        $entity->tm_id = $tm_id;
        $entity->body = $body;

        $entity->save();



        //unset($data);
        /* запись в таблицы код */



        $hash_code = hash('sha1',$id_campaign.$signature.$password.$url);


     return response()->json(['hash_code' => $hash_code,  'signature' => $signature, 'data' => $campaing]);

    }


    public function update(Request $request, $id)
    {
        $campaign = Campaigns::find($id);
        $campaign->update([
            'id_client' => $request->input('id_client'),
            'id_campaign' => $request->input('id_campaign'),
            'password' => $request->input('password'),
            'signature' => $request->input('signature'),
            'sig' => $request->input('sig'),
            'url' => $request->input('url'),
            'tm_id' => $request->input('tm_id'),

        ]);

        return response()->json(['message' => 'compaing updated successful']);
    }


    public function destroy($id)
    {
        Campaigns::destroy($id);
        return response()->json(['message' => 'Pixel deleted successfully']);
    }
}
