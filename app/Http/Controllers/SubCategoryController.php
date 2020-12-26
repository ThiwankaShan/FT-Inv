<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use Validator;
use URL;
use Illuminate\Validation\Rule;
use Log;
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
        $subCategories = SubCategory::all();
        return view('pages.subCategory', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('forms.subCategory_forms.createSubCategory',compact('categories'));
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
        $validatedata = $request->validate([
            'subCategory_name' => 'required|unique:sub_categories',
            'subCategory_code' => 'required|unique:sub_categories,subCategory_code,NULL,subCategory_code,category_code,',$request->Category_code,
            
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_code = $request->Category_code;
        $subCategory->subCategory_name = $request->subCategory_name;
        $subCategory->subCategory_code = $request->subCategory_code;

        
        $subCategory->save();

        if(URL::previous() == URL::route('subcategory.create')){
            $categories = Category::all();
            return back()->with('status','Sub LOcation Created Successfully!');   
        }

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
    public function edit($subCategory, $category)
    {
        $categories = Category::all();
        $subcategory = SubCategory::where('subCategory_code','=',$subCategory)->where('category_code','=',$category)->first();
       
        return view('forms.subCategory_forms.editSubCategory',compact('categories','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->SubCategory != $request->subCategory_code || $request->Category != $request->category_code){
            $validatedata = $request->validate([
                'category_code' =>'required|unique:sub_categories,category_code,NULL,category_code,subCategory_code,'.$request->subCategory_code,    
                'subCategory_name' => 'required|unique:sub_categories,subCategory_name,'.$request->subCategory_name.',subCategory_name',
                'subCategory_code' => 'required|unique:sub_categories,subCategory_code,NULL,subCategory_code,category_code,'.$request->category_code,              
                                   
             ]);
        }else{
            $validatedata = $request->validate([
                'category_code' =>'required',    
                'subCategory_name' => 'required|unique:sub_categories,subCategory_name,'.$request->subCategory_name.',subCategory_name',
                'subCategory_code' => 'required',              
                                   
             ]);
        }
        
        $subcategory = SubCategory::where('subCategory_code','=',$request->SubCategory)->where('category_code','=',$request->Category)->first();
        $subcategory->update($validatedata);

        session()->flash('updated_crud_row',$request->subCategory_code.'-'.$request->category_code);
        $subCategories = SubCategory::all();
       
      
        return view('pages.subCategory',compact('subCategories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subCategory, $category,Request $request)
    {
        if ($category == -1){
            return ;
        }
        $subcategory = SubCategory::where('subCategory_code','=',$subCategory)->where('category_code','=',$category)->first();
        if ($request->force=="True"){
            Log::info('came to force');
            $subcategory->forceDelete();
        }else{
            $subcategory->delete();
        }
        
    }
}
