@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/supplier">Back</a>
</div>
<hr>

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Supplier</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('supplier.store')}}" method="post" id="supplier_form">
            @csrf

            <div class="form-group row">
                <label for="SupplierCode" class="col-sm-2 col-form-label">Supplier Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('supplier_code') ? 'has_error' : '' }}" id="supplier_code" placeholder="Enter Supplier Code" name="supplier_code" value="{{ old('supplier_code') }}">
                    <span id="live_supplier_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('supplier_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="SupplierName" class="col-sm-2 col-form-label">Supplier Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('supplier_name') ? 'has_error' : ''}}" id="supplier_name" placeholder="Enter Supplier Name" name="supplier_name" value="{{ old('supplier_name') }}">
                    @error('supplier_name')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="SupplierAddress" class="col-sm-2 col-form-label">Supplier Address(Optional)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('supplier_address') ? 'has_error' : '' }}" id="supplier_address" placeholder="Enter Supplier Address" name="supplier_address" value="{{ old('supplier_address') }}">
                    @error('supplier_address')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="teleNo" class="col-sm-2 col-form-label">Telephone No. (Optional) </label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control {{ $errors->has('telephone_number') ? 'has_error' : '' }}" id="telephone_number" placeholder="Enter Telephone No" name="telephone_number" value="{{ old('telephone_number') }}">
                    @error('telephone_number')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="Email" class="col-sm-2 col-form-label">Email Address (Optional)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Enter Supplier Address" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="vat" class="col-sm-2 col-form-label">VAT Registration No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('vat_register_no') ? 'has_error' : '' }}" id="vat_register_no" placeholder="Enter Supplier Address" name="vat_register_no" value="{{ old('vat_register_no') }}"> 
                    <span id="live_vat_register_no" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('vat_register_no')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="text-center">{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom " id="saveSupplier" type="submit">Save Supplier Details</button>
            </div>

        </form>
    </div>
</div>

<script src="{{ asset('js/real_time_validation.js') }}"> </script>
@endsection
