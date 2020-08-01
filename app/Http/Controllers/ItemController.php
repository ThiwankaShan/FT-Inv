<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use App\Division;
use App\Items;
use App\SubCategory;
use App\SubDivision;
use Illuminate\Http\Request;
use DataTables;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
          $dname=$request->division;
          $sdname=$request->subdivision;

          //select the category
         $div3=Category::where('category_id',$request->category)->firstOrFail();
         $cname=$request->category;

         //select the subcategory
         if($request->subcategory !== "000"){
            $div4=SubCategory::where('subCategory_id',$request->subcategory)->firstOrFail();
            $scname=$request->subcategory;
            $subcate_name=$div4->subCategory_name;
         }else{
            $scname="000";
            $subcate_name=$div3->category_name;
         }


         //get the quantity
         $count=$request->quantity;
        //  $i= ItemQuantity::count();

          $item=Items::where('division_id',$request->division)
                            ->where('subdivision_id',$request->subdivision)
                            ->where('category_id',$request->category)
                            ->where('subcategory_id',$scname)
                            ->count();

            $i= (int)$item;

          for($num=$i;$num<$count+$i;$num++){
           $item=new Items();
           $item->item_name=$subcate_name;
           $item->item_code=$dname.'/'.$sdname.'/'.$cname.'/'.$scname.'/'.($num+1);
           $item->division_id=$request->division;
           $item->subdivision_id=$request->subdivision;
           $item->category_id=$request->category;
           $item->subcategory_id=$scname;
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
