<?php

namespace App\Http\Controllers;
use App\subLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(){

        return view('pages.user');
    }
    //validation
    public function storeSubLocation(Request $request){
        $rules = [
			// 'location_code' => 'required|string|unique:locations',
			// 'location_name' => 'required|string',

		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('insert')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();

			try{
                $sublocation = new subLocation;
                $sublocation->Location_code = $data['Location_code'];
                $sublocation->subLocation_code = $data['sub_location_code'];
                $sublocation->subLocation_name = $data['sub_location_name'];

				$location->save();
				return redirect('insert')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
		}
    }
}
