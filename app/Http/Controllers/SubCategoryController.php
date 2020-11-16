<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use Validator;
class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories = Category::all();
        return view('forms.createSubCategory', compact('Categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function store(Request $request)
    {
        // sub category code , Name and The category code that new sub category Belongs. Send Updated sub categories array  of Selected category OF Item Form 
        $validatedata = Validator::make($request->all(),[
            'subCategory_name' => 'required|unique:sub_categories',
            'subCategory_code' => 'required|unique:sub_categories',
        ]);

        //if fails that send all errors
        if($validatedata->fails()){
             
            return response()->json(['errors'=>$validatedata->errors()->all()]);
        }

        $subCategory = new SubCategory();
        $subCategory->category_code = $request->Category_code;
        $subCategory->subCategory_name = $request->subCategory_name;
        $subCategory->subCategory_code = $request->subCategory_code;

        
        $subCategory->save();

        $subCategories = SubCategory::where('category_code',$request->category_code_form)->get();
        return response()->json(['status'=>'success','records'=>$subCategories]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
