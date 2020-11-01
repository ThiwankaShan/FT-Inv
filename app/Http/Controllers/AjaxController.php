<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Romans\Filter\IntToRoman;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubLocation(Request $request)
    {
        $data = SubLocation::where('Location_code', $request->locationId)->get();

        return response()->json($data);
    }

    public function getSubCategory(Request $request)
    {
        $data = SubCategory::where('category_code', $request->categoryid)->get();

        return response()->json($data);
    }

    public function getFilter(Request $request)
    {
         $div = $request->div;
         $subDiv = $request->subdiv;
         $cate = $request->cate;
         $subcate = $request ->subcate;
         $type = $request->type;
         $pid = $request->pid;   
         
      
       
           $data = DB::table('items')       
               ->orwhere('location_code',$request->div )
               ->orwhere('subLocation_code',$request->subdiv)
               ->orwhere('category_code', $request->cate)
               ->orwhere('subCategory_code',$request->subcate)
               ->orwhere('type',$request->type)
               ->orwhere('procurement_id',$request->pid)
               ->get();

        return response()->json(['authType'=>Auth::user()->role,'records'=>$data]);
    }

    public function getRomanNumber(Request $request)
    {

        $sub = $request->no_of_sub;
        $data = array();
        for ($i = 1; $i <= $sub; $i++) {
            $filter = new IntToRoman();
            $result = $filter->filter($i);
            $data[] = $result;
        }

        return response()->json([$data]);
    }
}
