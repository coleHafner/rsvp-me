<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rsvp;

class GuestRsvpsController extends Controller
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
        return view('guest-rsvps', [
            'rsvps' => Rsvp::orderBy('guest_name', 'asc')->get()
        ]);
    }
}
