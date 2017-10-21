<?php

namespace App\Http\Controllers;

use App\Rsvp;
use App\Guest;
use Illuminate\Http\Request;

class RsvpsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Rsvp::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partyName = $request->input('partyName');
        $guest = Guest::where('party_name', $partyName)->first();

        if (!$guest) {
            return response('Guest with party name "' . $partyName . '" not found.', 500);
        }

        $rsvp = Rsvp::where('guest_id', $guest->id)->first();
        if (!$rsvp) {
            $rsvp = new Rsvp;
            $rsvp->guest_id = $guest->id;
        }

        $rsvp->total_adults = $request->input('totalAdults');
        $rsvp->total_children = $request->input('totalChildren');
        $rsvp->save();
        return response()->json($rsvp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function show(Rsvp $rsvp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function edit(Rsvp $rsvp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rsvp $rsvp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rsvp $rsvp)
    {
        //
    }
}
