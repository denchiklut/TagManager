<?php

namespace App\Http\Controllers\Api;

use App\Campaigns;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComponyResource;

class ComponiesController extends Controller
{
    public function index()
    {
        return ComponyResource::collection(Campaigns::all());
    }
}