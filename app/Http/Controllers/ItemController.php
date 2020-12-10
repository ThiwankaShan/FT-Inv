<?php

namespace App\Http\Controllers;

use Validator;
use DB;
use App\Grn;
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use App\Supplier;
use Session;
use Auth;

use Romans\Filter\IntToRoman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        //data get from Location, SubLocation, Category, SubCategory
        //and return those to createitem form
        $locations = Location::all();
        $subLocations = SubLocation::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $Suppliers = Supplier::all();
        $grn = Grn::all();
        $itemCodes = Session::get('itemCodes');
        session()->flash('grnMsg', 'hello');
        session()->flash('backUrl', "item/create");

        //For The Auto Incrementing Grn Number
        $last_grnNo = Grn::latest('GRN_no')->first();
        
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_no + 1);
        }

        return view('forms.createitem', compact('locations', 'subLocations', 'categories', 'subCategories', 'grn', 'itemCodes','suggest_grnNo','Suppliers'));

    }

    public function store(Request $request)
    {
        //Request data -> Location, SubLocation, Sub_item, procument_id, Quantity, Vat, Rate, Category, purchase_date
        //store data in items table
        //return to create item form
        $this->validate($request, [
            'Location' => 'required|string',
            'subLocation' => 'required|string',
            'sub_item' => 'integer|nullable',
            'procument_id' => 'string|nullable',
            'Quantity' => 'required|integer',
            'Vat' => 'required',
            'Rate' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'category' => 'required|string',
            'purchased_date' => 'required',
            'subCategory' => 'string|nullable'

        ]);
       
        // supplier name fetched via grn relation
        $grn_no = $request->grn_no;
        $grn = GRN::find(1)->where('GRN_no', $grn_no)->first();
        
        $data = [
            'location'=>$request->Location,
            'subLocation' => $request->subLocation,
            'category' => $request->category,
            'subCategory' => $request->subCategory,
            'vat' => str_replace(',',"",$request->Vat),
            'rate' => $request->Rate,
            'subItem' => $request->sub_item,
            'purchased_date' => $request->purchased_date,
            'grn_no' => $request->grn_no,
            'count' => $request->Quantity,
            'type'=>$request->types,
            'procument_id' => $request->procument_id,
            'supplier_name' => $grn->supplier->supplier_name,
            ];
        
        if ($request->action == 'show') {
            $itemCodes = $this->generateCode($data);
            return json_encode($itemCodes);
        }
        //Input data store in the database.
        else {
            $itemCodes = $this->generateCode($data);
            foreach($itemCodes as $itemCode) {
                $item = new Items();
                $item->item_code = $itemCode;
                $item->location_code = $data['location'];
                $item->subLocation_code = $data['subLocation'];
                $item->category_code = $data['category'];
                $item->subCategory_code = $data['subCategory'];
                $item->type = $data['type'];

                $item->GRN_no = $data['grn_no'];
                $item->vat = (($data['vat'] * $data['rate']) / 100);
                $item->procurement_id = $data['procument_id'];
                $item->rate = $data['rate'];
                $item->vat_rate_vat = $data['rate']+(($data['vat'] * $data['rate']) / 100);
                $item->purchased_date = $data['purchased_date'];
                $item->supplier_name = $data['supplier_name'];
                $item->save();
            }
        
            session()->flash('items',$itemCodes);
            return view('forms.add_serial_number')->with('success', 'Items Saved Successfuly!');
        }
    }

    public function generateCode($data){
        // input all item data
        // return generated item code array

        $itemCodes = [];

        //get the last item code to generate next codes
        $item = Items::where('location_code', $data['location'])
            ->where('subLocation_code', $data['subLocation'])
            ->where('category_code', $data['category'])
            ->where('subCategory_code', $data['subCategory'])
            ->orderBy('created_at', 'asc')->get();
        
        if (count($item) > 0) {
            $latestItemNum =  preg_split("#/#", $item->last()->item_code);
            $i = (int)$latestItemNum[5];
        } else {
            $i = 0;
        }
        
        for ($num = $i + 1; $num < $data['count'] + $i + 1; $num++) {
            
            $mainItemNumber = sprintf('%03d', $num);
            $main_itemCode = 'FT' . '/' . $data['location'] . '/' . $data['subLocation'] . '/' . $data['category'] . '/' . $data['subCategory'] . '/' . $mainItemNumber;   
            
            for ($j = 1; $j <= $data['subItem']; $j++) {
                
                $filter = new IntToRoman();
                $subItemNumber = $filter->filter($j);
                $sub_itemCode = $main_itemCode. '/' . $subItemNumber;
                array_push($itemCodes,$sub_itemCode);
                
            }  
            array_push($itemCodes,$main_itemCode);
        }

        return $itemCodes;
        
    }

    public function edit(Items $item,Request $request)
    {
        //get the input from grn
        //auto increment functionality
        //return to edit item form

        //previous url
        $request_url = (string)($request->server('HTTP_REFERER'));
       
        $grns = Grn::all()->pluck('GRN_no');
        $grn_array = [];
        
        for ($i = 0; $i < sizeof($grns); $i++) {

            if ($grns[$i] != $item->GRN_no) {
                array_push($grn_array, $grns[$i]);
            }
        }

        //For The Auto Incrementing Grn Number in the add new GRN modal
        $last_grnNo = Grn::latest('GRN_no')->first();
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_no + 1);
        }
        $Suppliers = Supplier::all();

        return view('forms.editItem', compact('grn_array', 'item','Suppliers', 'suggest_grnNo','request_url'));

    }


    public function update(Request $request)
    {
        //validation
        //geting current serial number
        //if current serial numebr  not equal to new input serial number there will be validation
        //request items->item, Vat, rate, grn_no, types, procument_id
        //store the updates in items table
        //return to the current page on dashbord
        
        $url = $request->back_to; //current page url in dashbord
      
        $this->validate($request, [
            
            'procument_id' => 'string|nullable',
            'Vat' => 'required',
            'Rate' => 'required',
            'purchased_date' => 'required',
            
        ]);

        
       $current_serial_number = Items::select('serialNumber')
       ->where('item_code',$request->item)
       ->get()->first(); 

       if($current_serial_number['serialNumber'] != $request->serial_number){
           $this ->validate($request,[
              'serial_number' => 'string|nullable|unique:items,serialNumber'
           ],[
               'serial_number.unique' => 'Serial Number Already Taken!Plase Use Another..'
           ]);
       }

       
        $item = $request->item;
        $new_rate = $request->Rate;
        $new_vat = ((str_replace(',',"",$request->Vat) * $new_rate) / 100);
        $new_vat_rate = $new_rate+str_replace(',',"",$request->Vat);
        $new_grn = $request->grn_no;
        $new_type = $request->types;
        $new_procumentID = $request->procument_id;
        $new_purchased_date = $request->purchased_date;
        $new_serial_number = $request->serial_number;

        //supplier name fetched via grn relation
        $grn = GRN::find(1)->where('GRN_no', $new_grn)->first();
        $new_supplier_name = $grn->supplier->supplier_name;

        DB::table('items')
            ->where('item_code', $request->item)
            ->update([
                'rate' => $new_rate,
                "vat_rate_vat" => $new_vat_rate,
                'vat' => $new_vat,
                'type' => $new_type,
                'GRN_no' => $new_grn,
                'procurement_id' => $new_procumentID,
                'supplier_name' => $new_supplier_name,
                'purchased_date' => $new_purchased_date,
                'serialNumber' => $new_serial_number,
            ]);

            session()->flash('updated_row',$request->item);
            return Redirect($url);
        // return redirect()->route('item.editForm', ['item' => $item, 'request_url'=>$request_url])->with('success', 'Items updated Successfuly!');
        
    }


    public function destroy(Items $item)
    {
        //delete item permanently
        //return to home

        $item->delete();
        return redirect()->route('home')
            ->with('success', 'item deleted successfully');
    }

    public function ShowItems($id){
        //requesting pagination nummber from dashboard and send items array as the pagination
  
          $locations = Location::all();
          $categories = Category::all();
          $proId =DB::table('items')->select('procurement_id')->groupBy('procurement_id')->get();
          $items = Items::orderBy('created_at', 'DESC')->simplePaginate($id);
          
          if (Auth::user()->role == "admin") { 
  
             return view('pages.admin', compact('items','locations','categories','proId'));
  
          }else if(Auth::user()->role == "manager"){
  
              return view('pages.manager', compact('items','locations','categories','proId'));
  
          }else if(Auth::user()->role == "user"){
  
              return view('pages.user', compact('items','locations','categories','proId'));
  
          }
     }

     public function SerialNumber(Request $request){
      
        //validate data
       //update the serial number
      //return the completed msg

           $current_serial_number = Items::select('serialNumber')
           ->where('item_code',$request->item_code)
           ->get()->first(); 

          

          if($current_serial_number['serialNumber'] != $request->serial_number){
               $validatedata = Validator::make($request->all(),[
                   'serial_number' => 'string|nullable|unique:items,serialNumber'
               ],[
                   'serial_number.unique' => 'Serial Number is Already Taken.Use Another..'
               ]);

               if($validatedata->fails()){
                   return response()->json(['errors'=>$validatedata->errors()->all()]);
                }
          }

          
       $item = DB::table('items')
              ->where('item_code',$request->item_code)
             ->update([
               'serialNumber' => $request->serial_number,
             ]);

       return response()->json(['edit'=>"complete"]);      
    }
}
