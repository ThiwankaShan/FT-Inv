<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Grn;
use Validator;
use URL;
class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $last_grnNo = Grn::latest('GRN_number')->first();
        // error_log($last_grnNo);
        // if ($last_grnNo == '') {
        //     $suggest_grnNo = '01';
        // } else {
        //     $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_number + 1);
        // }


        // $Suppliers = Supplier::all();
        // return view('forms.grn_forms.createGRN', compact('Suppliers', 'suggest_grnNo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_grnNo = Grn::latest('GRN_number')->first();
        error_log($last_grnNo);
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_number + 1);
        }


        $Suppliers = Supplier::all();
        return view('forms.grn_forms.createGRN',compact('Suppliers','suggest_grnNo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    
    public function store(Request $request)
    {

        //New Grn no,date,invoice no,invoice date,and supplier code 
        //send updated grn numbers array to item create form and send suppliers array to grn create modal  
        
        $validatedata = $request->validate([
            'GRN_number' => 'required|numeric|unique:grns',
            'GRN_date' => 'required',
            'invoice_number' => 'required|unique:grns',
            'invoice_date' => 'required',
            'supplier_code' => 'required',
        ]);
        
        $grn = new Grn();
        $grn->GRN_number = $request->GRN_number;
        $grn->GRN_date = $request->GRN_date;
        $grn->invoice_number = $request->invoice_number;
        $grn->invoice_date = $request->invoice_date;
        $grn->supplier_code = $request->supplier_code;

    
        $grn->save();
       
        $grn_numbers = Grn::select('GRN_number')
        ->orderBy('GRN_number', 'desc')
        ->get();  

        $Suppliers = Supplier::all();  

        if(URL::previous() == URL::route('grn.create')){
            return back()->with('status',"GRN Created Succesfully!");
        }

        return response()->json(['status'=>"Success", 'records'=>$grn_numbers , 'supplier'=>$Suppliers]);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $grns=Grn::all();
         return view('pages.GRN',compact('grns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($grn_number)
    {
        $Suppliers = Supplier::all();
        $grn = Grn::find($grn_number);
        return view('forms.grn_forms.editGRN',compact('grn','Suppliers'));
         
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
        $validatedata = $request->validate([
            'GRN_number' => 'required|numeric|unique:grns,GRN_number,'.$id.',GRN_number',
            'GRN_date' => 'required',
            'invoice_number' => 'required|unique:grns,invoice_number,'.$request->invoice_number.',invoice_number',
            'invoice_date' => 'required',
            'supplier_code' => 'required',
        ]);

         $grn_details = Grn::find($id);
         $grn_details -> update($validatedata);

         session()->flash('updated_crud_row',$id);
         $grns = Grn::all();
        
         return view('pages.GRN',compact('grns'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($grn_number, Request $request)
    {
        if ($request->force){
            Grn::find($grn_number)->forceDelete();
        }else{
            Grn::find($grn_number)->delete();
        }
        
    }
}
