<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AddPixel extends Controller
{
    public function __construct()
    {
    }

    public function index($Request)
    {
         $url = $Request->compaigns_url;

         maskCompani();
        return view('pixel.index', compact( 'result_op'));
    }
}
