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

use URL;
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
        $locations = Location::all() ;
        return view('pages.location', compact('locations'));
        
    }

    public function create()
    {
        return view('forms.location_forms.createLocation');
        
    }

    public function delete($location_code)
    { 
        Location::destroy($location_code);
    }

    public function edit($location_code)
    { 
        $location = Location::find($location_code);
        return view('forms.location_forms.editLocation',compact('location'));
    }

    public function update(Request $request,$location)
    { 
        $validatedata = $request->validate([
            'location_code' => 'required|string|unique:locations,location_code,'.$request->location_code.',location_code',
            'location_name' => 'required|string|unique:locations,location_name,'.$request->location_name.',location_name',

        ]);

        Location::find($location)->update($validatedata);
        $location = Location::find($validatedata['location_code']);

        return view('forms.location_forms.editLocation',compact('location'))->with('status','Location edited sucessfully');
    }
   
    public function storeLocation(Request $request)
    {
         //Getting location_code and location_name of new Loaction,Save New Loaction and Sending the Updated Locations
         //send the  updated Location list array

        
        
            $validatedata = $request->validate([
                'location_code' => 'required|string|unique:locations',
                'location_name' => 'required|string|unique:locations',
    
            ]);
            
            $location = new Location;
            $location->location_code = $request->location_code;
            $location->location_name = $request->location_name;
             
            $location->save();
            $locations = Location::all();


            if(URL::previous()==URL::route('location.create')){
                return back()->with('status','Location created sucessfully');
            }
            
            return response()->json(['status'=>'success','records'=>$locations]);
      
    }
}
