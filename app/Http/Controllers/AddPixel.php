<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AddPixel extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $Request)
    {
        $url  = $Request->url_pixel ? $Request->url_pixel: exit;    //сохраняем url

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
         $data[] =[
             'id_client' => '16',
             'id_campaign' => $id_campaign,
             'password' => $password,
             'signature' => $signature,
             'sig' => hash('sha1',$id_campaign.$signature.$password.$url),
             'url' => $url,
             'tm_id' => $tm_id,
             'created_at' => Carbon::now()
             ];

            Campaigns::insert($data);
            unset($data);
        /* запись в таблицы компании */


        /* Запись в бд лидслаб */
            $sql = DB::connection('sqlsrv2')->select("exec [InsertCustomer] '".$signature."', 16, '".$id_campaign."', 'htnfhutn', '".$url."', '".$RedirectUrl."' , null");
        /* Запись в бд лидслаб */


        /* запись в таблицы код */
        $data[] =[
            'tm_id' => $tm_id,
            'body' => $body,
            'created_at' => Carbon::now()
        ];

        Entities::insert($data);
        unset($data);
        /* запись в таблицы код */



            $hash_code = hash('sha1',$id_campaign.$signature.$password.$url);


        return response()->json(['hash_code' => $hash_code,  'signature' => $signature]);

    }
}
