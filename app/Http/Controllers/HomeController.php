<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;
use App\Items;
use App\Division;
use App\SubDivision;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

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
        $div = Division::all();
        $subdiv = SubDivision::all();
        $cate = Category::all();
        $subcate = SubCategory::all();

        if (Auth::user()->role=="admin") {
            return view('pages.admin');
        } elseif (Auth::user()->role=="manager") {
            return view('pages.manager');
        } elseif (Auth::user()->role=="user") {
            $items=Items::all();
            return view('pages.user', compact('items','div','cate','subcate','subdiv'));
        } else {
            return view('home');
        }
    }





}
