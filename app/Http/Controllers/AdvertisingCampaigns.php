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
        $this->middleware('guest', ['except' =>[
            '/tags/{hash_advertisings}', '/tags/'
        ]]);
    }

    public function index($hash_advertisings)
    {
        $result = Campaigns::where('sig', $hash_advertisings)->first();



        $result_trigers = Trigers::where('entity_id', $result->tm_id)->first();


        if (isset($result_trigers->url))
        {
            if (strpos($_SERVER['SERVER_NAME'], $result_trigers->url) >=0)
            {
                $result_op = Entities::where('tm_id', $result->tm_id)->first();
                return view('pixel.index', compact( 'result_op'));
            }
        }
        else
        {

            $result_op = Entities::where('tm_id', $result->tm_id)->first();

            return view('pixel.index', compact( 'result_op'));
        }


        return view('pixel.index', compact( 'result_op'));
    }
}
