<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Grn;
use Validator;

class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last_grnNo = Grn::latest('GRN_no')->first();
        error_log($last_grnNo);
        if ($last_grnNo == '') {
            $suggest_grnNo = '01';
        } else {
            $suggest_grnNo = sprintf('%02d', $last_grnNo->GRN_no + 1);
        }


        $Suppliers = Supplier::all();
        return view('forms.createGRN', compact('Suppliers', 'suggest_grnNo'));
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
        $validatedata = Validator::make($request->all(),[
            'GRN_no' => 'required|numeric|unique:grns',
            'GRN_date' => 'required',
            'invoice_no' => 'required|unique:grns',
            'invoice_date' => 'required',
            'supplier_code' => 'required',
        ]);

         if($validatedata->fails()){
            return response()->json(['errors'=>$validatedata->errors()->all()]);
         }

        $grn = new Grn();
        $grn->GRN_no = $request->GRN_no;
        $grn->GRN_date = $request->GRN_date;
        $grn->invoice_no = $request->invoice_no;
        $grn->invoice_date = $request->invoice_date;
        $grn->supplier_code = $request->supplier_code;

        $grn->save();
        $grn_numbers = Grn::all();  
        $Suppliers = Supplier::all();
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
