<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use App\Division;
use App\Items;
use App\SubCategory;
use App\SubDivision;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubDivision(Request $request){
         $data=SubDivision::where('division_id',$request->divisionid)->get();

         return response()->json($data);
    }

    public function getSubCategory(Request $request){
        $data=SubCategory::where('category_id',$request->categoryid)->get();

        return response()->json($data);
   }

   public function getFilter(Request $request){
    
      $data=DB::table('items')
                  ->where('division_id',$request->div)
                  ->where('subDivision_id',$request->subdiv)
                  ->where('category_id',$request->cate)
                  ->where('subCategory_id',$request->subcate)
                  ->get();
         
           return response()->json($data);
  }
}
