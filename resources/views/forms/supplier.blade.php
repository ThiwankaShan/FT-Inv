@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/home">Back</a>
</div>
<hr>

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Supplier</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('supplier.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="SupplierCode" class="col-sm-2 col-form-label">Supplier Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('SupplierCode') ? 'has_error' : '' }}" id="SupplierCode" placeholder="Enter Supplier Code" name="SupplierCode" value="{{ old('SupplierCode') }}">
                    @error('SupplierCode')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="SupplierName" class="col-sm-2 col-form-label">Supplier Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('SupplierName') ? 'has_error' : ''}}" id="SupplierName" placeholder="Enter Supplier Name" name="SupplierName" value="{{ old('SupplierName') }}">
                    @error('SupplierName')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="SupplierAddress" class="col-sm-2 col-form-label">Supplier Address(Optional)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('SupplieAddress') ? 'has_error' : '' }}" id="SupplierAddress" placeholder="Enter Supplier Address" name="SupplierAddress" value="{{ old('SupplierAddress') }}">
                    @error('SupplieAddress')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="teleNo" class="col-sm-2 col-form-label">Telephone No. (Optional) </label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control {{ $errors->has('TelephoneNo') ? 'has_error' : '' }}" id="teleNo" placeholder="Enter Telephone No" name="TelephoneNo" value="{{ old('TelephoneNo') }}">
                    @error('TelephoneNo')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="Email" class="col-sm-2 col-form-label">Email Address (Optional)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Email" placeholder="Enter Supplier Address" name="Email" value="{{ old('Email') }}">
                    @error('Email')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="vat" class="col-sm-2 col-form-label">VAT Registration No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('VatRegistration') ? 'has_error' : '' }}" id="vat" placeholder="Enter Supplier Address" name="VatRegistration" value="{{ old('VatRegistration') }}"> 
                    @error('VatRegistration')
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
                <button href="" class="btn form-tab-custom bg-color-custom text-light form-card-header-custom " type="submit">Save Supplier Details</button>
            </div>

        </form>
    </div>
</div>

@endsection
