<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubLocation(Request $request){
         $data=SubLocation::where('Location_code',$request->Locationcode)->get();

         return response()->json($data);
    }

    public function getSubCategory(Request $request){
        $data=SubCategory::where('category_code',$request->categorycode)->get();

        return response()->json($data);
   }

   public function getFilter(Request $request){

      $data=DB::table('items')
                  ->where('Location_code',$request->div)
                  ->where('subLocation_code',$request->subdiv)
                  ->where('category_code',$request->cate)
                  ->where('subCategory_code',$request->subcate)
                  ->get();

           return response()->json($data);
  }
}
