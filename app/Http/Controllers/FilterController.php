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
       
        
        $searchmap = array(
            'location_code'=>$request->loactionCode,
            'subLocation_code'=>$request->subLoactionCode,
            'category_code'=>$request->category_code,
            'subCategory_code'=>$request->subCategory_code,
            'type'=>$request->type,
            'procurement_id'=>$request->pid
        );

    
       //checking the conditions and get the sorted filtered  item object 
        $gadgets = Items::whereNested(function($query) use ($searchmap) {
            foreach ($searchmap as $key => $value)
                {
                    if($value != ''){
                        $query->where($key, '=', $value);
                    }
                }
        }, 'and')->orderBy($request->column,$request->order)->orderBy('item_code', 'ASC');

        $gadgets = $gadgets->get();



        return response()->json(['authType'=>Auth::user()->role,'records'=>$gadgets]);
          
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

    public function ShowItems($id){
        //requesting pagination nummber from dashboard and send items array as the pagination
  
          $locations = Location::all();
          $categories = Category::all();
          $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
           $items = Items::orderBy('created_at', 'DESC')->paginate($id);
          
          if (Auth::user()->role == "admin") { 
  
             return view('pages.admin', compact('items','locations','categories','proId'));
  
          }else if(Auth::user()->role == "manager"){
  
              return view('pages.manager', compact('items','locations','categories','proId'));
  
          }else if(Auth::user()->role == "user"){
  
              return view('pages.user', compact('items','locations','categories','proId'));
  
          }
     }

     public function SerialNumber(Request $request){
        
        $validatedata = Validator::make($request->all(),[
            'serial_number' => 'string|nullable|unique:items,serialNumber'
        ],[
            'serial_number.unique' => 'Serial Number is Already Taken.Use Another..'
        ]);
  
        if($validatedata->fails()){
           return response()->json(['errors'=>$validatedata->errors()->all()]);
        }

        $item = DB::table('items')
               ->where('item_code',$request->item_code)
              ->update([
                'serialNumber' => $request->serial_number,
              ]);

        return response()->json(['edit'=>"complete"]);      
     }
}
