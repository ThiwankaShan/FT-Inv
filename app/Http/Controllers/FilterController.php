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

class FilterController extends Controller
{

  
    //requesting loaction_code and send  subLocations   
    public function getSubLocation(Request $request)
    {
        
        $data = SubLocation::where('location_code', $request->locationCode)->get();

        return response()->json($data);
    }

     //requesting category_code and send subCategories   
    public function getSubCategory(Request $request)
    {
        $data = SubCategory::where('category_code', $request->categoryCode)->get();

        return response()->json($data);
    }

     // taken location_code,sunLocation_code OR category, subCategory_code OR Type OR ProcurementID
    // and Return filtered  Items

    public function getFilter(Request $request)
    {
        
           if(!empty($request->loactionCode)){

                if(!empty($request->subLoactionCode)){
                    $data = DB::table('items')       
                    ->where('location_code',$request->loactionCode )
                    ->where('subLocation_code',$request->subLoactionCode)
                    ->get();

                }else{

                    $data = DB::table('items')       
                    ->where('location_code',$request->loactionCode )->get();

                }
            }else if(!empty($request->categoryCode)){

                  if(!empty($request->subCategoryCode)){
                    $data = DB::table('items')       
                    ->where('category_code', $request->categoryCode)
                    ->orwhere('subCategory_code',$request->subCategoryCode)
                    ->get();

                  }else{

                    $data = DB::table('items')       
                    ->where('category_code', $request->categoryCode)->get();

                  }
             
           }else if(!empty($request->type)){

                $data = DB::table('items')
                    ->where('type',$request->type)
                    ->get();

           }else if(!empty($request->pid)){

                $data = DB::table('items')
                    ->where('procurement_id',$request->pid)
                    ->get();
           }
           
      

        return response()->json(['authType'=>Auth::user()->role,'records'=>$data]);
    }


    //here is the function that convert the integer to roman numbers
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
