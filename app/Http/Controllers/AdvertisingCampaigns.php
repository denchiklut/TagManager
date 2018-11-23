<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Companies;
use App\Models\Triggers;
use App\Models\Templates;


class AdvertisingCampaigns extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param $hash_advertisings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($hash_advertisings)
    {


        //информация по по рк.
        $compains = Companies::where('sig', $hash_advertisings)
            ->crossJoin('templates')->where('default',1)
            ->first();



        $Analitics = new AnaliticsController();

        $data =[
          "url" => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: $_SERVER['REQUEST_URI'],
          "hach" => $hash_advertisings,
        ];

        $Analitics->store($data);



        //если есть тригер
        if(isset($compains->trigger))
        {
            //выбираем все тригеры
            $triggers = Triggers::where('id_campaign', $compains->id_campaign)->get();

            foreach ($triggers as $trigger)
            {
                if($trigger)
                {
                    if (strpos($_SERVER['HTTP_REFERER'], $trigger->trigger) !== false )
                    {
                        $script = templateCode($triggers->new_campaign, $triggers->templates );

                        return view('pixel.index', compact( 'script'));
                    }
                }
            }
        }

        $set = '';

        isset($compains->templates) ? $set = $compains->templates : $set = $compains->name;

        $script = templateCode($compains->id_campaign, $set);

        return view('pixel.index', compact( 'script'));
    }
}
