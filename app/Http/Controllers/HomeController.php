<?php

namespace App\Http\Controllers;

use DB;
use App\Category;
use App\Location;
use App\Items;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   // return user to different views base on their role
        // return data - items,location,categories,proID arrays

        $locations = Location::all();
        $categories = Category::all();
        $proId = DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
        $items = Items::orderBy('created_at', 'DESC')->paginate(20);
        
        //*If you want check relation please use this code insert with related info
        //$locations=Location::with('subLocations')->get();
        //dd($locations);
        if (Auth::user()->role == "admin") {

            return view('pages.admin', compact('items', 'locations', 'categories', 'proId'));
        } elseif (Auth::user()->role == "manager") {

            return view('pages.manager', compact('items', 'locations', 'categories', 'proId'));
        } elseif (Auth::user()->role == "user") {

            return view('pages.user', compact('items', 'locations', 'categories', 'proId'));
        } else {

            return view('home');
        }
    }
}
