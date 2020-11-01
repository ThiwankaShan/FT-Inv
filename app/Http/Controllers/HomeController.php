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
    {

        $data = Session::get('key');

        if (Auth::user()->role == "admin") {

              $div = Location::all();
              $cate = Category::all();
              $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
              $items = Items::orderBy('created_at', 'DESC')->paginate(20);

            return view('pages.admin', compact('items','div','cate','proId'));
        } elseif (Auth::user()->role == "manager") {

            $div = Location::all();
            $cate = Category::all();
            $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
            $items = Items::orderBy('created_at', 'DESC')->paginate(20);

            return view('pages.manager', compact('items','div','cate','proId'));
        } elseif (Auth::user()->role == "user") {

             $div = Location::all();
             $cate = Category::all();
             $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
             $items=Items::paginate(10);

            return view('pages.user',compact('items','div','cate','proId'));
        } else {
            return view('home');
        }
    }
}
