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

        $this->validate($request, [
            'SupplierCode' => 'required|string',
            'SupplierName' => 'required|string',
            'SupplierAddress' => 'string|nullable',
            'TelephoneNo' => 'nullable|numeric|min:10',
            'Email' => 'nullable|email',
            'VatRegistration' => 'required|string'
        ]);

        $supplier = new Supplier();

        $supplier->supplier_code = $request->SupplierCode;
        $supplier->supplier_name = $request->SupplierName;
        $supplier->supplier_address = $request->SupplierAddress;
        $supplier->telephone_number = $request->TelephoneNo;
        $supplier->email_address = $request->Email;
        $supplier->vat_register_no = $request->VatRegistration;

        $supplier->save();

        return back()->with('success', 'Supplier Details Saved Successfully!!');
    }
}
