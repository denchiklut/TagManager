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
            $url = Trigers::where('entity_id', $result_op->entity_id)->first();

            if (isset($url->url))
            {
                if (strpos($_SERVER['HTTP_REFERER'], $url->url) !== false )
                {
                    return view('pixel.index', compact( 'result_op'));
                }
            }
        }

        $result_op = $result_ops[0];

        return view('pixel.index', compact( 'result_op'));



    }
}
