<?php

namespace App\Http\Controllers;

use App\Category;
use App\Division;
use App\ItemQuantity;
use App\SubCategory;
use App\SubDivision;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //data
        $div = Division::all();
        $subdiv = SubDivision::all();
        $cate = Category::all();
        $subcate = SubCategory::all();

        return view('item.create', compact('div', 'subdiv', 'cate', 'subcate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //select the divition
        $div1 = Division::findOrFail($request->division);
        $dname = $div1->ds_name;

        //select the subdivition
        $div2 = SubDivision::findOrFail($request->subdivision);
        $sdname = $div2->sd_short_name;

        //select the category
        $div3 = Category::findOrFail($request->category);
        $cname = $div3->code;

        //select the subcategory
        if ($request->subcategory !== "000") {
            $div4 = SubCategory::findOrFail($request->subcategory);
            $scname = $div4->sc_code;
            $subcate_id = $request->subcategory;
        } else {
            $scname = "000";
            $subcate_id = 0;
        }

        //get the quantity
        $count = $request->quantity;
        //  $i= ItemQuantity::count();

        $item = ItemQuantity::where('d_id', $request->division)
            ->where('sd_id', $request->subdivision)
            ->where('c_id', $request->category)
            ->where('sc_id', $subcate_id)
            ->count();

        $i = (int) $item;

        for ($num = $i; $num < $count + $i; $num++) {
            $item = new ItemQuantity();
            $item->q_name = $div2->sd_name;
            $item->item_code = $dname . '/' . $sdname . '/' . $cname . '/' . $scname . '/' . ($num + 1);
            $item->d_id = $request->division;
            $item->sd_id = $request->subdivision;
            $item->c_id = $request->category;
            $item->sc_id = $subcate_id;
            $item->save();
        }

        return view('pages.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function show(ItemQuantity $itemQuantity)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemQuantity $itemQuantity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemQuantity $itemQuantity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemQuantity $itemQuantity)
    {
        //
    }
}
