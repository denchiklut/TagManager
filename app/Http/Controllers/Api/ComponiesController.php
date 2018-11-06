<?php

namespace App\Http\Controllers\Api;

use App\Campaigns;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComponyResource;

class ComponiesController extends Controller
{
    public function index()
    {
        return ComponyResource::collection(Campaigns::all());
    }

    public function store(Request $request)
    {
        $campaign = Campaigns::create($request->all());
        return response()->json(['data' => $campaign]);
    }


    public function update(Request $request, $id)
    {
        $campaign = Campaigns::find($id);
        $campaign->update([
            'id_client' => $request->input('id_client'),
            'id_campaign' => $request->input('id_campaign'),
            'password' => $request->input('password'),
            'signature' => $request->input('signature'),
            'sig' => $request->input('sig'),
            'url' => $request->input('url'),
            'tm_id' => $request->input('tm_id'),

        ]);

        return response()->json(['message' => 'compaing updated successful']);
    }


    public function destroy($id)
    {
        Campaigns::destroy($id);
        return response()->json(['message' => 'Pixel deleted successfully']);
    }

}
