<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Illuminate\Http\Request;
use DataTables;
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
         $div = Location::all();
         $cate = Category::all();
         $items=Items::paginate(10);

         return view('item.view',compact('div','items','cate'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //data
        $div = Location::all();
        $subdiv = SubLocation::all();
        $cate = Category::all();
        $subcate = SubCategory::all();

        return view('forms.createitem', compact('div', 'subdiv', 'cate', 'subcate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $dname=$request->Location;
          $sdname=$request->subLocation;

          //select the category
         $div3=Category::where('category_code',$request->category)->firstOrFail();
         $cname=$request->category;

         //select the subcategory
         if($request->subcategory !== "000"){
            $div4=SubCategory::where('subCategory_code',$request->subcategory)->firstOrFail();
            $scname=$request->subcategory;
            $subcate_name=$div4->subCategory_name;
         }else{
            $scname="000";
            $subcate_name=$div3->category_name;
         }


         //get the quantity
         $count=$request->quantity;
        //  $i= ItemQuantity::count();

          $item=Items::where('Location_code',$request->Location)
                            ->where('subLocation_code',$request->subLocation)
                            ->where('category_code',$request->category)
                            ->where('subcategory_code',$scname)
                            ->count();

            $i= (int)$item;

          for($num=$i;$num<$count+$i;$num++){
           $item=new Items();
           $item->item_name=$subcate_name;
           $item->item_code=$dname.'/'.$sdname.'/'.$cname.'/'.$scname.'/'.($num+1);
           $item->Location_code=$request->Location;
           $item->subLocation_code=$request->subLocation;
           $item->category_code=$request->category;
           $item->subcategory_code=$scname;
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
