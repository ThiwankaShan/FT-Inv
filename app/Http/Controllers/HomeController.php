<?php

namespace App\Http\Controllers;

use App\Category;
use App\Location;
use App\Items;
use App\SubLocation;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {   // return user to different views base on their role
        // return data - items,location,categories,proID arrays
    
        $locations = Location::all();
        $categories = Category::all();
        $proId = Items::select('procurement_id')->groupBy('procurement_id')->get();


        if($request->restore === 'true'){

            $items = Items::orderBy('location_code', 'ASC')->orderBy('item_code', 'ASC')->simplePaginate(7000000000); 
        }else{
            
            $items = Items::orderBy('location_code', 'ASC')->orderBy('item_code', 'ASC')->simplePaginate(15);
        }

       
        if (Auth::check()) {
            return view('pages.dashboard', compact('items', 'locations', 'categories', 'proId'));
        } else {
            return view('home');
        }
    }

    
}
