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
         $div = Location::all();
         $cate = Category::all();
         $items=Items::paginate(10);

         return view('layouts.view',compact('div','items','cate'));

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
        $subloc = SubLocation::all();
        $cate = Category::all();
        $subcate = SubCategory::all();
        $grn = Grn::all();
        $itemCodes=Session::get('itemCodes');
       
        return view('forms.createitem', compact('div', 'subloc', 'cate', 'subcate','grn','itemCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        
        
        $this->validate($request, [
            'Location'=>'required|string',
            'subLocation'=>'required|string',
            'sub_item' => 'integer|nullable',
            'procument_id' => 'string|nullable',
            'Quantity' => 'required|integer',
            'Vat' => 'required',
            'Rate' => 'required'
        ]);

            
         $lname=$request->Location;
         $slname=$request->subLocation;
         $cname=$request->category;
         $scname=$request->subCategory;
         $vat = $request->Vat;
         $rate = $request->Rate;

         

         //get the quantity
         $count=$request->Quantity;
        //  $i= ItemQuantity::count();

          $item=Items::where('location_code',$request->Location)
                            ->where('subLocation_code',$request->subLocation)
                            ->where('category_code',$request->category)
                            ->where('subCategory_code',$scname)
                            ->count();

            $i= (int)$item;

            $itemCodes=[];
            if($request->action=='show'){
                error_log('came here');
                for($num=$i+1;$num<$count+$i+1;$num++){
                    $fnumber=sprintf('%03d',$num);
                    $itemCode='FT'.'/'.$lname.'/'.$slname.'/'.$cname.'/'.$scname.'/'.$fnumber;
                    array_push($itemCodes,$itemCode);
                    
                }
                
                return json_encode($itemCodes);

            }else{
                

            for($num=$i+1;$num<$count+$i+1;$num++){
           $item=new Items();
            
           $fnumber=sprintf('%03d',$num);
           
           $item->item_code='FT'.'/'.$lname.'/'.$slname.'/'.$cname.'/'.$scname.'/'.$fnumber;
           $item->Location_code=$lname;
           $item->subLocation_code=$slname;
           $item->category_code=$cname;
           $item->subCategory_code=$scname;
           $item->type=$request->types;
           $item->num_of_sub_items=$request->sub_item;
           $item->GRN_no=$request->grn_no;
           $item->vat = $vat;
           $item->procurement_id = $request->procument_id;
           $item->rate = $request->Rate;
           $item->vat_rate_vat = ($vat*$rate);
           $item->save();
          }

          return redirect()->route('item.create');
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
