<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;
use Session;

class HomeController extends Controller
{
    // Create a new controller instance

    // @return void
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
        $value = Session::get('key');
        if (Auth::user()->role == "admin") {
            return view('pages.admin');
        } elseif (Auth::user()->role == "manager") {
            return view('pages.manager');
        } elseif (Auth::user()->role == "user") {
            return view('pages.user', ['data' => $value]);
        } else {
            return view('home');
        }
    }
}
