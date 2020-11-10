<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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
    {   // return user to different views base on their role
        // return items,location,categories,proID arrays

        $data = Session::get('key');
        $locations = Location::all();
        $categories = Category::all();
        $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
        $items = Items::orderBy('created_at', 'DESC')->paginate(20);

        if (Auth::user()->role == "admin") {

            return view('pages.admin', compact('items','locations','categories','proId'));

        } elseif (Auth::user()->role == "manager") {

            return view('pages.manager', compact('items','locations','categories','proId'));

        } elseif (Auth::user()->role == "user") {
           
            return view('pages.user',compact('items','locations','categories','proId'));

        } else {

            return view('home');

        }
    }
}
