<?php

namespace App\Http\Controllers;

use App\Category;

use URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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

        $categories = Category::all();
        return view('pages.category', compact('categories'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.category_forms.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {

       // category code and name of new Category Sending the Updated Categories array


        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories',
            'category_code' => 'required|unique:categories',
        ]);
 
       
         
          //if validation fails send all errors to the modal    
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_code = $request->category_code;
        $category->save();
 
        
        $categories = Category::all();

        if(URL::previous() == URL::route('category.create')){
            return back()->with('status',"Category Created Successfully!");
        }

        return response()->json(['status'=>'success','records'=>$categories]);
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
        $category = Category::find($id);
        return view('forms.category_forms.editCategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $validateData = $request->validate([
            'category_code' => 'required|string|unique:categories,category_code,'.$request->category_code.',category_code',
            'category_name' => 'required|string|unique:categories,category_name,'.$request->category_name.',category_name',

        ]);

        Category::find($category)->update($validateData);
        $categories = Category::all();
        session()->flash('updated_crud_row',$request->category_code);

        return view('pages.category',compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category,Request $request)
    {
        if ($request->force){
            Category::find($category)->forceDelete();
        }else{
            Category::find($category)->delete();
        }
        
    }
}
