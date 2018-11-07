<?php
/**
 * Created by PhpStorm.
 * User: Егор
 * Date: 19.10.2018
 * Time: 18:36
 */

function maskCompani($url)
{

    $list_domains= array('.ru','.RU','.com','.COM','.РФ','.рф','.net','.NET','.ORG','.org');

    $unique_name = trim($url);

    //проверка есть ли в строке последним символом слеш, если да то удаляем
    if (substr($unique_name, strlen($unique_name)-1) == "/") $unique_name = substr($unique_name,0,strlen($unique_name)-1);


    $unique_name = preg_replace('|http(.+)//|','',$unique_name);
    $unique_name = preg_replace('|-|','_',$unique_name);


    foreach ($list_domains as $list_domain)
    {
        if (str_replace($list_domain,'',$unique_name))
        {
            $unique_name = str_replace($list_domain,'',$unique_name);
            break;
        }
    }

    $flag = 0;
    while ($flag == 0)
    {
        $flag = 1;

        if(stripos($unique_name,'/') !=false)
        {
            $num = stripos($unique_name,'/');

            $unique_name = str_replace('/','',$unique_name);

            $unique_name = substr_replace($unique_name,mb_strtoupper($unique_name[$num]), $num,1);
            $flag = 0;
        }
    }

    $unique_name = str_replace('.','',$unique_name);


    return $unique_name;
}


function codeBody($id_campaign)
{
    $body = "<script> var script = document.createElement('script'); script.src = '//sonar.semantiqo.com/4e3ll/checking.js'; script.setAttribute('idCampaign', ". $id_campaign ."); script.setAttribute('idClient', 16); script.setAttribute('password', 'htnfhutn'); document.getElementsByTagName('head')[0].appendChild(script); </script>";

    return $body;
}