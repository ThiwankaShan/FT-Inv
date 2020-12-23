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
use Validator;
class FilterController extends Controller
{

  
    //requesting loaction_code and returning  subLocations  object 
    public function getSubLocation(Request $request)
    {
        
        $data = SubLocation::where('Location_code', $request->locationCode)->get();

        return response()->json($data);
    }

     //requesting category_code and returning subCategories object  
    public function getSubCategory(Request $request)
    {
        $data = SubCategory::where('category_code', $request->categoryCode)->get();

        return response()->json($data);
    }

     // taken location_code,sunLocation_code OR category, subCategory_code OR Type OR ProcurementID
    // and Return filtered  Items Object And UserType

    public function getFilter(Request $request)
    {
        // input locationCode,subLocationCode,category_code,subCategory_code,type,pid,column,order
        // get filtered items by given sort argument
        // output filterd and sorted value
        $start = $request->purchased_start;
        $end = $request->purchased_end;
        
        if ($start =='' or $end == ''){
            $date = '';
        }else{
            $date = [$start,$end];
        }
       
        $searchmap = array(
            'location_code'=>$request->loactionCode,
            'subLocation_code'=>$request->subLoactionCode,
            'category_code'=>$request->category_code,
            'subCategory_code'=>$request->subCategory_code,
            'type'=>$request->type,
            'procurement_id'=>$request->pid,
            'purchased_date'=>$date,
        );

    
       //checking the conditions and get the sorted filtered  item object 
        $gadgets = Items::whereNested(function($query) use ($searchmap) {
            foreach ($searchmap as $key => $value)
                {
                    if($key == 'purchased_date' and $value != ''){
                        $query->whereBetween($key, $value);
                    }

                    else if($value != ''){
                        $query->where($key, '=', $value);
                    }

                 
                }
        }, 'and')->orderBy($request->column,$request->order)->orderBy('item_code', 'ASC');

        $items = $gadgets->get();

        // for report generation
        // session(['items_download' => $gadgets,'sub_location'=>$request->subLoactionCode,'start'=>$start,'end'=>$end]);
        
        $html = view('tables.item_table')->with(compact('items'))->render();
        return response()->json(['authType'=>Auth::user()->role,'html'=>$html, 'success'=>true]);
          
    }


    //here is the function that convert the integer to roman numbers
    // returning converted numbers object
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
