@extends('layouts.PageLayout')

@section('content')

<div class="container-fluid ">
    <a class="btn btn-dark text-white" href="/item/create">Back</a>
</div>
<div class='container'>
<<<<<<< HEAD
<h5 class="form-card-header-custom p-3"><strong class="text-light">Add New GRN </strong></h5>

<form class="form-align-custom" action="{{ route('grn.store') }}" method="POST">
=======
<h5 class="form-card-header-custom text-white p-3">Add New GRN</h5>
<form action="{{ route('grn.store') }}" method="POST" class="form-align-custom">
>>>>>>> development
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  <div class="form-group form-custom">
    <label for="GRN_no">GRN No.</label>
    <input type="text" class="form-control form-custom" id="GRN_no" name="GRN_no" value="{{$suggest_grnNo}}">

    @error('GRN_no')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group form-custom">
    <label for="GRN_date">GRN Date</label>
    <input type="date" class="form-control" name="GRN_date" >
    @error('GRN_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group form-custom">
    <label for="invoice_no">Invoice No.</label>
    <input type="text" class="form-control" id="invoice_no" name="invoice_no">

    @error('invoice_no')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group form-custom">
    <label for="invoice_date">Invoice Date.</label>
    <input type="date" class="form-control" id="invoice_date" name="invoice_date">

    @error('invoice_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
<<<<<<< HEAD
    
    <div class="form-group form-custom">
=======

    <div class="form-group">
>>>>>>> development
    <label for="supplier_code">Supplier</label>
    <select class="form-control" id="exampleFormControlSelect1" name="supplier_code">
            @foreach($Suppliers as $Supplier)

    <option value="{{$Supplier->supplier_code}}" class="form-custom">{{$Supplier->supplier_name}}</option>
            @endforeach
    </select>

    </div>


<div class="text-center">
  <button type="submit" class="btn form-card-header-custom text-light">Create</button>
</div>
</form>
</div>



@endsection
