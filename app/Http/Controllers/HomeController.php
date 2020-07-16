<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->email=="admin@gmail.com") {
            return view('pages.admin');
        } elseif (Auth::user()->email=="manager@gmail.com") {
            return view('pages.manager');
        } else {
            return view('home');
        }
    }
}
