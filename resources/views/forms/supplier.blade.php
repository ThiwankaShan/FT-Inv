@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2">

    <a href="" class="btn btn-outline-warning mr-2 ">Add New Supplier</a>
    <a class="btn btn-dark text-white" href="/home">Back</a>
</div>
<hr>

<div class="card w-75 ml-5">
  <div class="card-header form-card-header-custom">
    <h1 class="text-center text-white">Add New Supplier</h1>
  </div>
  <form action="{{route('supplier.store')}}" method="post">
      @csrf
  <div class="card-body">
    <div class="form-group row">
        <label for="SupplierCode" class="col-sm-2 col-form-label">Supplier Code</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="SupplierCode" placeholder="Enter Supplier Code" name="SupplierCode">
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
        <input type="text" class="form-control" id="SupplierName" placeholder="Enter Supplier Name" name="SupplierName">
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
        <input type="text" class="form-control" id="SupplierAddress" placeholder="Enter Supplier Address" name="SupplierAddress">
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
        <input type="tel" class="form-control" id="teleNo" placeholder="Enter Telephone No" name="TelephoneNo">
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
        <input type="text" class="form-control" id="Email" placeholder="Enter Supplier Address" name="Email">
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
        <input type="text" class="form-control" id="vat" placeholder="Enter Supplier Address" name="VatRegistration">
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
    <button href="" class="btn form-tab-custom bg-color-custom text-light form-card-header-custom" type="submit">Save Supplier Details</button>
  </div>
  </form>
</div>

@endsection
