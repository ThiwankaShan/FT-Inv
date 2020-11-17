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
        error_log($last_grnNo);
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
            'sub_item' => 'integer',
            'procument_id' => 'string|nullable',
            'Quantity' => 'required|integer',
            'Vat' => 'required',
            'Rate' => 'required',
            'category' => 'required|string',
            'purchased_date' => 'required'
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
        
        /*
        // this block get the supplier from grn no
        $grn_no = $request->grn_no;
        $grn = GRN::find(1)->where('GRN_no', $grn_no)->first();
        error_log('below here');    
        error_log($grn->supplier->supplier_name);

        */


        //get the quantity
        $count = $request->Quantity;
        //  $i= ItemQuantity::count();

        //items information request from the item model
        $item = Items::where('location_code', $request->Location)
            ->where('subLocation_code', $request->SubLocation)
            ->where('category_code', $request->Category)
            ->where('subCategory_code', $request->SubCategory)
            ->orderBy('created_at', 'asc')->get();

        //Item code creation start
        if (count($item) > 0) {
            $latestItemNum =  preg_split("#/#", $item->last()->item_code);
            $i = (int)$latestItemNum[5];
        } else {
            $i = 0;
        }

        $itemCodes = [];
        //If action=show this part is processing
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

                        $item->item_code = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode . '/' . $subItemCode;
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
                        $item->save();
                    }
                }
            }
            //If sub item hasn't sub item this part work
            else if ($subItem == 0) {

                for ($num = $i + 1; $num < $count + $i + 1; $num++) {
                    $item = new Items();
                    $mainItemCode = sprintf('%03d', $num);

                    $item->item_code = 'FT' . '/' . $locationCode . '/' . $subLocationCode . '/' . $categoryCode . '/' . $subCategoryCode . '/' . $mainItemCode;
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
                    $item->save();
                }
            }
            return back()->with('success', 'Items Saved Successfuly!');
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
        error_log('here');
        error_log(gettype($grns[0]));
        error_log(sizeof($grns));
        for ($i = 0; $i < sizeof($grns); $i++) {

            if ($grns[$i] != $item->GRN_no) {
                array_push($grn_array, $grns[$i]);
            }
        }

        //For The Auto Incrementing Grn Number in the add new GRN modal
        $last_grnNo = Grn::latest('GRN_no')->first();
        error_log($last_grnNo);
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
        //request items->item, Vat, rate, grn_no, types, procument_id
        //store the updates in items table
        //return to item edit form
        $item = $request->item;
        $new_vat_rate = $request->Vat;
        $new_rate = $request->Rate;
        $new_vat = (($new_vat_rate * $new_rate) / 100);
        $new_grn = $request->grn_no;
        $new_type = $request->types;
        $new_procumentID = $request->procument_id;

        DB::table('items')
            ->where('item_code', $request->item)
            ->update([
                'rate' => $new_rate,
                "vat_rate_vat" => $new_vat_rate,
                'vat' => $new_vat,
                'type' => $new_type,
                'GRN_no' => $new_grn,
                'procurement_id' => $new_procumentID,
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
}
