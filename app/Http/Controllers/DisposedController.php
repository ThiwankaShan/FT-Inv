<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Location;
use App\Category;
use DB;
use Session;
class DisposedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {

        $locations = Location::all();
        $categories = Category::all();
        $proId = Items::select('procurement_id')->groupBy('procurement_id')->get();


       $disposed_items = DB::table('items')
                              ->whereNotNull('deleted_at')
                              ->paginate(15);        
    //    session()->flash('dispose', 'Task was successful!');
       return view('pages.dispose',compact('disposed_items','locations','categories','proId'));
    }

    public function restore ($item, Request $request) {
     
        Items::withTrashed()->where('item_code', $item)->restore();
        session()->flash('updated_row',$item);

        return response()->json(['id' => $item]);
    }
}
