<?php
namespace App\Http\Controllers;
use DB;

use App\Location;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

=
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
>>>>>>> 9b4d5802558f7134135c38212e2feaecfff9b23d

class locationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(){

        return view('pages.user');
    }
    //validation
    public function storeLocation(Request $request){
        $rules = [
			'location_code' => 'required|string|unique:locations',
			'location_name' => 'required|string',

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
				$location = new Location;
                $location->location_code = $data['location_code'];
                $location->location_name = $data['location_name'];

				$location->save();
				return redirect('insert')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
		}
    }
}
