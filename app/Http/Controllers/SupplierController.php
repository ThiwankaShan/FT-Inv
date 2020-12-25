<?php

namespace App\Http\Controllers;

use Validator;
use App\Supplier;
use Illuminate\Http\Request;
use Log;
class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $suppliers = Supplier::all();
        return view('pages.supplier',compact('suppliers'));
    }

    public function edit($supplier)
    {
        $supplier = Supplier::find($supplier);
        return view('forms.supplier_forms.editSupplier',compact('supplier'));
    }


    public function update(Request $request)
    {
        $validatedata = $request->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'nullable',
            'telephone_number' => 'nullable|numeric',
            'email' => 'nullable|email',
            'vat_register_no' => 'required'
        ]);

        $supplier = Supplier::find($request->supplier_code);
        $supplier->update($validatedata);

        return view('forms.supplier_forms.editSupplier',compact('supplier'))->with('status','supplier details updated sucessfully');
    }

    public function delete($supplier)
    {
        $supplier = Supplier::find($supplier);
        $supplier->delete();
        
        $suppliers = Supplier::all();
        return view('pages.supplier',compact('suppliers'));
    }

    public function create()
    {
        return view('forms.supplier_forms.createSupplier');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'supplier_code' => 'required|unique:suppliers',
            'supplier_name' => 'required',
            'supplier_address' => 'nullable',
            'telephone_number' => 'nullable|numeric|unique:suppliers',
            'email' => 'nullable|email',
            'vat_register_no' => 'required|unique:suppliers'
        ]);
        
        $supplier = new Supplier();
        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->telephone_number = $request->telephone_number;
        $supplier->email = $request->email;
        $supplier->vat_register_no = $request->vat_register_no;

        $supplier->save();

        return back()->with('success', 'Supplier Details Saved Successfully!!');
    }
}
