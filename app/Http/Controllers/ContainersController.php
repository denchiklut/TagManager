<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triggers;
use App\Models\Companies;
use App\Http\Resources\TriggerResource;

class ContainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TriggerResource::collection(Triggers::orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $trigger = new Triggers();

        $trigger->trigger = $request->trigger;
        $trigger->id_campaign = $request->id_campaign;
        $trigger->new_campaign = $request->new_campaign;

        $trigger->save();

        $compaing = Companies::where('id_campaign', $request->id_campaign);

        $compaing->update([
            'trigger' => '1',
        ]);



        return response()->json(['data' => $trigger]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show($id)
    {
        return TriggerResource::collection(Triggers::where('id_campaign', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trigger = Triggers::find($id);

        $trigger->update([
            'trigger' => $request->input('trigger'),
            'new_campaign' => $request->input('new_campaign'),
        ]);

        return response()->json(['message' => 'trigger updated successful']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Triggers::destroy($id);
        return response()->json(['data'=> 'Filter deleted successfully']);
    }
}
