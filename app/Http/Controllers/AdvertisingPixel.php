<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaigns;
use App\Entities;
use App\Trigers;

class AdvertisingPixel extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        return view('pixel.test');
    }
}
