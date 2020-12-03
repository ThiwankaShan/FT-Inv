<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubLocation;
use App\Location;
use Validator;
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
        $Locations = Location::all();

        return view('forms.createSubLocation', compact('Locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedData = Validator::make($request->all(),[
            'subLocation_name' => 'required|unique:sub_locations',
            'subLocation_code' => 'required|unique:sub_locations,subLocation_code,NULL,subLocation_code,Location_code,'.$request->Location_code,
        ]);

        //if fails that send all errors
        if($validatedData->fails()){
            return response()->json(['errors'=>$validatedData->errors()->all()]);
        }

        $subLocation = new SubLocation;
        $subLocation->Location_code = $request->Location_code;
        $subLocation->subLocation_name = $request->subLocation_name;
        $subLocation->subLocation_code = $request->subLocation_code;


        $subLocation->save();

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
