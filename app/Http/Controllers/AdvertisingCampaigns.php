<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaigns;
use App\Entities;
use App\Trigers;

class AdvertisingCampaigns extends Controller
{
    public function __construct()
    {
    }

    public function index($hash_advertisings)
    {


        $result = Campaigns::where('sig', $hash_advertisings)->first();
        $result_ops = Entities::where('tm_id', $result->tm_id)->get();


        foreach ($result_ops as $result_op)
        {
            if ($result_op->entity_id)
            {
                $url = Trigers::where('entity_id', $result_op->entity_id)->first();
                $trigers = $url->url;

                if (strpos($_SERVER['SERVER_NAME'], $trigers) >=0)
                {
                    return view('pixel.index', compact( 'result_op'));
                }
            }

            return view('pixel.index', compact( 'result_op'));

        }
    }
}
