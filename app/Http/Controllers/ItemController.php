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
        $last_grnNo = Grn::latest('GRN_number')->first();
        
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_number + 1);
        }

        return view('forms.item_forms.createitem', compact('locations', 'subLocations', 'categories', 'subCategories', 'grn', 'itemCodes','suggest_grnNo','Suppliers'));

    }

    public function store(Request $request)
    {
        //Request data -> Location, SubLocation, Sub_item, procument_id, Quantity, Vat, Rate, Category, purchase_date
        //store data in items table
        //return to create item form
        $validatedDdata = $request->validate([
            'location_code' => 'required',
            'subLocation_code' => 'required',
            'sub_item' => 'integer|nullable',
            'procument_id' => 'string|nullable',
            'Quantity' => 'required|integer',
            'tax' => 'required',
            'gross_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'category_code' => 'required',
            'purchased_date' => 'required|date',
            'subCategory_code' => 'string|nullable',
            'brandName' => 'nullable',
            'model_number' => 'nullable',

        ]);
        
        $data = [
            'location_code'=>$request->location_code,
            'subLocation_code' => $request->subLocation_code,
            'category_code' => $request->category_code,
            'subCategory_code' => $request->subCategory_code,
            'tax' => floatval(str_replace(',',"",$request->tax)),
            'gross_price' => $request->gross_price,
            'subItem' => $request->sub_item,
            'purchased_date' => $request->purchased_date,
            'GRN_number' => $request->GRN_number,
            'count' => $request->Quantity,
            'type'=>$request->types,
            'procument_id' => $request->procument_id,
            'brandName' => $request->brandName,
            'model_number' => $request->model_number ,
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
                $item->location_code = $data['location_code'];
                $item->subLocation_code = $data['subLocation_code'];
                $item->category_code = $data['category_code'];
                $item->subCategory_code = $data['subCategory_code'];
                $item->type = $data['type'];
                $item->GRN_number = $data['GRN_number'];
                $item->tax = $data['tax'];
                $item->procurement_id = $data['procument_id'];
                $item->gross_price = $data['gross_price'];
                $item->net_price = $data['tax'] + $data['gross_price'] ;
                $item->purchased_date = $data['purchased_date'];
                $item->brandName = $data['brandName'];
                $item->model_number = $data['model_number'];
                $item->save();
            }
        
            session()->flash('items',$itemCodes);
            return view('forms.item_forms.add_serial_number')->with('success', 'Items Saved Successfuly!');
        }
    }

    public function generateCode($data){
        // input all item data
        // return generated item code array

        $itemCodes = [];

        //get the last item code to generate next codes
        $item = Items::where('location_code', $data['location_code'])
            ->where('subLocation_code', $data['subLocation_code'])
            ->where('category_code', $data['category_code'])
            ->where('subCategory_code', $data['subCategory_code'])
            ->orderBy('created_at', 'asc')->get();
        
        if (count($item) > 0) {
            $latestItemNum =  preg_split("#/#", $item->last()->item_code);
            $i = (int)$latestItemNum[5];
        } else {
            $i = 0;
        }
        
        for ($num = $i + 1; $num < $data['count'] + $i + 1; $num++) {
            
            $mainItemNumber = sprintf('%03d', $num);
            $main_itemCode = 'FT' . '/' . $data['location_code'] . '/' . $data['subLocation_code'] . '/' . $data['category_code'] . '/' . $data['subCategory_code'] . '/' . $mainItemNumber;   
            
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
       
        $grns = Grn::all()->except($item->GRN_number)->pluck('GRN_number');
        

        //For The Auto Incrementing Grn Number in the add new GRN modal
        $last_grnNo = Grn::latest('GRN_number')->first();
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_number + 1);
        }
        $Suppliers = Supplier::all();

        return view('forms.item_forms.editItem', compact('grns', 'item','Suppliers', 'suggest_grnNo','request_url'));

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
            'tax' => 'required',
            'gross_price' => 'required',
            'purchased_date' => 'required',
            
        ]);

        
       $current_serial_number = Items::select('serial_number')
       ->where('item_code',$request->item)
       ->get()->first(); 

       if($current_serial_number['serial_number'] != $request->serial_number){
           $this ->validate($request,[
              'serial_number' => 'string|nullable|unique:items,serial_number'
           ],[
               'serial_number.unique' => 'Serial Number Already Taken!Plase Use Another..'
           ]);
       }

       
        $item = $request->item;
        $new_rate = $request->gross_price;
        $new_vat = ((str_replace(',',"",$request->tax) * $new_rate) / 100);
        $new_vat_rate = $new_rate+$new_vat;
        $new_grn = $request->GRN_number;
        $new_type = $request->types;
        $new_procumentID = $request->procument_id;
        $new_purchased_date = $request->purchased_date;
        $new_serial_number = $request->serial_number;

        //supplier name fetched via grn relation
       

        DB::table('items')
            ->where('item_code', $request->item)
            ->update([
                'gross_price' => $new_rate,
                "net_price" => $new_vat_rate,
                'tax' => $new_vat,
                'type' => $new_type,
                'GRN_number' => $new_grn,
                'procurement_id' => $new_procumentID,
                'purchased_date' => $new_purchased_date,
                'serial_number' => $new_serial_number,
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
          
          return view('pages.dashboard', compact('items','locations','categories','proId'));
  
     }

     public function SerialNumber(Request $request){
      
             //validate data
            //update the serial number
            //return the completed msg

           $current_serial_number = Items::select('serial_number')
           ->where('item_code',$request->item_code)
           ->get()->first(); 

          
          if($current_serial_number['serial_number'] != $request->serial_number){
               $validatedata = Validator::make($request->all(),[
                   'serial_number' => 'string|nullable|unique:items,serial_number'
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
               'serial_number' => $request->serial_number,
             ]);

       return response()->json(['edit'=>"complete"]);      
    }
}
