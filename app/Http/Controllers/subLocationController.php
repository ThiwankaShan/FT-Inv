<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubLocation;
use App\Location;
use Validator;
use URL;
use Log;
use DB;

class subLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subLocations = SubLocation::all();
        Log::info($subLocations);
        return view('pages.subLocation', compact('subLocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();
        return view('forms.subLocation_forms.createSubLocation',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        //Getting subLocation_code , Name and The Location code that new sub location Belongs.
        // Send Updated Sublocations array of Selected Location OF Item Form
        // sub location code , Name and The location code that new sub location Belongs. Send Updated sub locations array  of Selected location OF Item Form
        
        $validatedData = $request->validate([
            'location_code' => 'required',
            'subLocation_name' => 'required|unique:sub_locations',
            'subLocation_code' => 'required|unique:sub_locations,subLocation_code,NULL,subLocation_code,location_code,'.$request->location_code,
        ]);

        
        $subLocation = new SubLocation;
        $subLocation->Location_code = $request->location_code;
        $subLocation->subLocation_name = $request->subLocation_name;
        $subLocation->subLocation_code = $request->subLocation_code;

        
        $subLocation->save();

        if(URL::previous()==URL::route('subLocation.create')){
            return back()->with('status','Sub Location created sucessfully');
        }

        $sublocations = SubLocation::where('Location_code', $request->location_code_form)->get();

        return response()->json(['status'=>'success','records'=>$sublocations]);  //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subLocation,$location)
    {
        $locations = Location::all();
        $subLocation = SubLocation::where('subLocation_code','=',$subLocation)->where('location_code','=',$location)->first();
        return view('forms.subLocation_forms.editSubLocation',compact('locations','subLocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
           
        if($request->subLocation != $request->subLocation_code || $request->location != $request->location_code){

            $validatedata = $request->validate([
                'location_code' =>'required|string|unique:sub_locations,location_code,NULL,location_code,subLocation_code,'.$request->subLocation_code,
                'subLocation_name' => 'required|unique:sub_locations,subLocation_name,'.$request->subLocation_name.',subLocation_name',
                'subLocation_code' => 'required|unique:sub_locations,subLocation_code,NULL,subLocation_code,location_code,'.$request->location_code,
            ],[
                'location_code.unique' => 'This location Allready have this Sub location code',
                'subLocation_code.unique' => 'This Sub location Allready have taken for selected location'
            ]);

        }else{
            $validatedata = $request->validate([
                'location_code' =>'required|string',
                'subLocation_name' => 'required|unique:sub_locations,subLocation_name,'.$request->subLocation_name.',subLocation_name',
                'subLocation_code' => 'required',
            ]);
        }

        
        
        
        //$subLocation = SubLocation::where('subLocation_code','=',$request->subLocation)->where('location_code','=',$request->location)->first();
        //$subLocation->update($validatedata);

        DB::table('sub_locations')
              ->where('subLocation_code', $request->subLocation)
              ->where('location_code',$request->location)
              ->update($validatedata);

        $subLocations = SubLocation::all();
        session()->flash('updated_crud_row',$request->subLocation_code.'-'.$request->location_code);
        
        return view('pages.subLocation',compact('subLocations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($subLocation,$location,Request $request)
    {
        $subLocation = DB::table('sub_locations')->where('subLocation_code','=',$subLocation)->where('location_code','=',$location); 
        
        if ($request->force=="True"){
            $subLocation->delete();
        }else{
            $subLocation->update(['deleted_at'=>date('Y-m-d')]);
        }
        
       
        return 1; 
    }
}
