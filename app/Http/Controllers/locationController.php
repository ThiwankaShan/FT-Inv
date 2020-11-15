<?php

namespace App\Http\Controllers;

use DB;

use App\Location;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Items;
use App\SubCategory;
use App\SubLocation;

use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
use Validator;

class locationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        
    }
    
   
    public function storeLocation(Request $request) // location_code and location_name of new Loaction,
    {
        
        //validation of the Inputs
            $validatedata = Validator::make($request->all(),[
                'location_code' => 'required|string|unique:locations',
                'location_name' => 'required|string|unique:locations',
    
            ]);
        
       //if validation fails send all errors to the modal      
      if($validatedata -> fails()){
      
        return response()->json(['errors'=>$validatedata->errors()->all()]);
      }

            $location = new Location;
            $location->location_code = $request->location_code;
            $location->location_name = $request->location_name;
             
           // Save New Loaction and Sending the Updated Locations
            $location->save();

            //get updated Location list
            $locations = Location::all();
          
            return response()->json(['status'=>'success','records'=>$locations]);
      
    }
}
