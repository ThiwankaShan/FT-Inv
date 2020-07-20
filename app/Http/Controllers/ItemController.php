<?php

namespace App\Http\Controllers;

use App\Category;
use App\Division;
use App\Items;
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
        $dname = $div1->division_name;

        //select the subdivition
        $div2 = SubDivision::findOrFail($request->subdivision);
        $sdname = $div2->subDivision_shortName;

        //select the category
        $div3 = Category::findOrFail($request->category);
        $cname = $div3->code;

        //select the subcategory
        if ($request->subcategory !== "000") {
            $div4 = SubCategory::findOrFail($request->subcategory);
            $scname = $div4->subCategory_code;
            $subcate_id = $request->subcategory;
        } else {
            $scname = "000";
            $subcate_id = 0;
        }

        //get the quantity
        $count = $request->quantity;
        //  $i= Items::count();

        $item = Items::where('division_id', $request->division)
            ->where('subDivision_id', $request->subdivision)
            ->where('category_id', $request->category)
            ->where('subCategory_id', $request->subcategory_id)
            ->count();

        $i = (int) $item;

        for ($num = $i; $num < $count + $i; $num++) {
            $item = new Items();
            $item->quantity_name = $scname;
            $item->item_code = $dname . '/' . $sdname . '/' . $cname . '/' . $scname . '/' . ($num + 1);
            $item->division_id = $request->division;
            $item->subDivision_id = $request->subdivision;
            $item->category_id = $request->category;
            $item->subCategory_id = $request->subcategory;
            $item->save();
        }

        return view('pages.admin');
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
    public function edit(Items $itemQuantity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $itemQuantity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $itemQuantity)
    {
        //
    }
}
