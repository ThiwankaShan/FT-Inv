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

    public function index(){

        return view('forms.createLocation');
    }
    //validation
    public function storeLocation(Request $request){
        $validatedata = $request->validate([
			'location_code' => 'required|string|unique:locations',
			'location_name' => 'required|string|unique:locations',

		]);
		
		
        $data = $request->input();

		try{
			$location = new Location;
            $location->location_code = $data['location_code'];
            $location->location_name = $data['location_name'];

			$location->save();
			return redirect('location')->with('status',"Insert successfully");
		}
		catch(Exception $e){
			return redirect('location')->with('failed',"operation failed");
		}
		
    }
}
