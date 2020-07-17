<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role=="admin") {
            return view('pages.admin');
        } elseif (Auth::user()->role=="manager") {
            return view('pages.manager');
        } elseif (Auth::user()->role=="user") {
            return view('pages.user');
        } else {
            return view('home');
        }
    }
}
