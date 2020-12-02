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


class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $locations = Location::all();
        // $categories = Category::all();
        // $items = Items::paginate(10);

        // return view('layouts.view', compact('locations', 'items', 'categories'));
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
            'Vat' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'Rate' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'category' => 'required|string',
            'purchased_date' => 'required',
            'subCategory' => 'string|nullable'

        ]);

        //This variables are use for create item code
        $locationCode = $request->Location;
        $subLocationCode = $request->subLocation;
        $categoryCode = $request->category;
        $subCategoryCode = $request->subCategory;
        $vat = $request->Vat;
        $rate = $request->Rate;
        $subItem = $request->sub_item;
        $purchased_date = $request->purchased_date;
        $grn_no = $request->grn_no;

        // supplier name fetched via grn relation
        $grn = GRN::find(1)->where('GRN_no', $grn_no)->first();
        $supplier_name = $grn->supplier->supplier_name;
       


        //get the quantity
        $count = $request->Quantity;
        

        //get the last item code to generate next codes
        $item = Items::where('location_code', $request->Location)
            ->where('subLocation_code', $request->subLocation)
            ->where('category_code', $request->category)
            ->where('subCategory_code', $request->subCategory)
            ->orderBy('created_at', 'asc')->get();

        if (count($item) > 0) {
            $latestItemNum =  preg_split("#/#", $item->last()->item_code);
            $i = (int)$latestItemNum[5];
            error_log('last item item number');
            error_log($i);
        } else {
            $i = 0;
        }

        $itemCodes = [];
        $itemCodes_for_serial =[];
        
        if ($request->action == 'show') {

            for ($num = $i + 1; $num < $count + $i + 1; $num++) {
                if ($subItem != 0) {
                    for ($j = 1; $j <= $subItem; $j++) {
                        $filter = new IntToRoman();
                        $subItemCode = $filter->filter($j);

                        $mainItemCode = sprintf('%03d', $num);
                        $itemCode = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode . '/' . $subItemCode;
                        
                        array_push($itemCodes, $itemCode);

                    }
                } else {
                    $mainItemCode = sprintf('%03d', $num);
                    $itemCode = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode;
                    array_push($itemCodes, $itemCode);
                }
            }
           
          
            return json_encode($itemCodes);
        }
        //Input data store in the database.
        else {

            //If item has sub items this part work
            if ($subItem != 0) {
                for ($num = $i + 1; $num < $count + $i + 1; $num++) {
                    for ($j = 1; $j <= $subItem; $j++) {
                        $item = new Items();

                        $filter = new IntToRoman();
                        $subItemCode = $filter->filter($j);


                        $mainItemCode = sprintf('%03d', $num); //main item->sub items

                        $itemCode = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode . '/' . $subItemCode;   
                        array_push($itemCodes_for_serial,$itemCode); 


                        $item->item_code = $itemCode;
                        $item->location_code = $locationCode;
                        $item->subLocation_code = $subLocationCode;
                        $item->category_code = $categoryCode;
                        $item->subCategory_code = $subCategoryCode;
                        $item->type = $request->types;

                        $item->GRN_no = $request->grn_no;
                        $item->vat = (($vat * $rate) / 100);
                        $item->procurement_id = $request->procument_id;
                        $item->rate = $request->Rate;
                        $item->vat_rate_vat = $vat;
                        $item->purchased_date = $purchased_date;
                        $item->supplier_name = $supplier_name;
                        $item->save();
                    }
                }
                session()->flash('items',$itemCodes_for_serial);
            }
            //If sub item hasn't sub item this part work
            else if ($subItem == 0) {

                for ($num = $i + 1; $num < $count + $i + 1; $num++) {
                    $item = new Items();
                    $mainItemCode = sprintf('%03d', $num);


                    $itemCode = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode;
                    array_push($itemCodes_for_serial,$itemCode); 

                    $item->item_code = $itemCode;
                    $item->location_code = $locationCode;
                    $item->subLocation_code = $subLocationCode;
                    $item->category_code = $categoryCode;
                    $item->subCategory_code = $subCategoryCode;
                    $item->type = $request->types;

                    $item->GRN_no = $request->grn_no;
                    $item->vat = (($vat * $rate) / 100);
                    $item->procurement_id = $request->procument_id;
                    $item->rate = $request->Rate;
                    $item->vat_rate_vat = $vat;
                    $item->purchased_date = $purchased_date;
                    $item->supplier_name = $supplier_name;
                    $item->save();
                }
                session()->flash('items',$itemCodes_for_serial);
            }
           
            return view('forms.add_serial_number')->with('success', 'Items Saved Successfuly!');
        }
    }


    public function show(Items $itemQuantity)
    {
    }


    public function edit(Items $item)
    {
        //get the input from grn
        //auto increment functionality
        //return to edit item form
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

        return view('forms.editItem', compact('grn_array', 'item','Suppliers', 'suggest_grnNo'));

    }


    public function update(Request $request)
    {
        //validation
        //geting current serial number
        //if current serial numebr  not equal to new input serial number there will be validation
        //request items->item, Vat, rate, grn_no, types, procument_id
        //store the updates in items table
        //return to item edit form
        

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
        $new_vat_rate = $request->Vat;
        $new_rate = $request->Rate;
        $new_vat = (($new_vat_rate * $new_rate) / 100);
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
        return redirect()->route('item.editForm', ['item' => $item])->with('success', 'Items updated Successfuly!');
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
