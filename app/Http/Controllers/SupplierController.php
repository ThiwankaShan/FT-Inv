<?php

namespace App\Http\Controllers;

use Validator;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('forms.supplier');
    }

    public function store(Request $request)
    {
        error_log('came to controller');
        $validateData = $request->validate([
            'supplier_code' => 'required|unique:suppliers',
            'supplier_name' => 'required',
            'supplier_address' => 'nullable',
            'telephone_number' => 'nullable|numeric|unique:suppliers',
            'email' => 'nullable|email',
            'vat_register_no' => 'required|unique:suppliers'
        ]);

        error_log("passed the validation");
        
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
