<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;

class GuestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the guest list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guests', [
            'guests' => Guest::withCount('rsvp')->orderBy('party_name', 'asc')->get()
        ]);
    }
}
