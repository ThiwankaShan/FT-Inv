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
use Session;

use Romans\Filter\IntToRoman;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //data get from models and return those to createitem form
        $locations = Location::all();
        $subLocations = SubLocation::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $grn = Grn::all();
        $itemCodes = Session::get('itemCodes');
        session()->flash('grnMsg', 'hello');
        session()->flash('backUrl', "item/create");

        return view('forms.createitem', compact('locations', 'subLocations', 'categories', 'subCategories', 'grn', 'itemCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //Store values validate in here

        $this->validate($request, [
            'Location' => 'required|string',
            'subLocation' => 'required|string',
            'sub_item' => 'integer',
            'procument_id' => 'string|nullable',
            'Quantity' => 'required|integer',
            'Vat' => 'required',
            'Rate' => 'required',
            'category' => 'required|string'
        ]);

        //This variables are use for create item code
        $locationCode = $request->Location;
        $subLocationCode = $request->subLocation;
        $categoryCode = $request->category;
        $subCategoryCode = $request->subCategory;
        $vat = $request->Vat;
        $rate = $request->Rate;
        $subItem = $request->sub_item;



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
                    $item->save();
                }
            }
            return back()->with('success', 'Items Saved Successfuly!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function show(Items $itemQuantity)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $item)
    {
        //get the input from grn and create auto increment functionality
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
        session()->flash('egrnMsg', 'edit');
        session()->flash('editId', $item->item_code);

        return view('forms.editItem', compact('grn_array', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Get the exist items and store the updates in items table then return to item edit form
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $item)
    {
        $item->delete();
        return redirect()->route('home')
            ->with('success', 'item deleted successfully');
    }
}
