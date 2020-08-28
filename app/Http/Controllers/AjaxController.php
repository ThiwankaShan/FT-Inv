<?php

namespace App\Http\Controllers;
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
    public function getSubLocation(Request $request){
         $data=SubLocation::where('Location_code',$request->locationId)->get();

         return response()->json($data);
    }

    public function getSubCategory(Request $request){
        $data=SubCategory::where('category_code',$request->categoryid)->get();

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

  public function getRomanNumber(Request $request){
 
         $sub = $request->no_of_sub; 
         $data = array();
                for($i=1;$i<=$sub;$i++){
                    $filter = new IntToRoman();
                    $result = $filter->filter($i);
                    $data[] = $result;
                }

          return response()->json([$data]);
 }

}
