<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Companies;
use App\Models\Triggers;
use App\Http\Controllers\AnaliticsController;

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
        $compains = Companies::where('sig', $hash_advertisings)->first();

        $Analitics = new AnaliticsController();



        $data =[
          "url" => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: $_SERVER['REQUEST_URI'],
          "hach" => $hash_advertisings,
        ];

        $Analitics->store($data);
        exit;

        //если есть тригер
        if($compains->trigger)
        {

            //выбираем все тригеры
            $triggers = Triggers::where('id_campaign', $compains->id_campaign)->get();

            foreach ($triggers as $trigger)
            {

                if($trigger)
                {
                    if ((strpos(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: $_SERVER['REQUEST_URI'], $trigger->trigger) !== false))
                    {
                        $script = templateCode($compains);
                        return view('pixel.index', compact( 'script'));
                    }
                }
            }

        }


        $script = templateCode($compains);
        return view('pixel.index', compact( 'script'));
    }
}
