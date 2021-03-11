<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::all();

        return view('home', [
            'meetings' => $meetings,
            'auth_user' => auth()->user(),
        ]);
    }
}
