@extends('layouts.app')

@section('content')


<div class='container'>
<form action="{{ route('category.store') }}" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  <div class="form-group">
    <label for="GRN_no">GRN No.</label>
    <input type="text" class="form-control" id="GRN_no" name="GRN_no" value="{{$suggest_grnNo}}">
  
    @error('GRN_no')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="GRN_date">GRN Date</label>
    <input type="date" class="form-control" name="GRN_date" >
    @error('GRN_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror  
  </div>

  <div class="form-group">
    <label for="invoice_no">Invoice No.</label>
    <input type="text" class="form-control" id="invoice_no" name="invoice_no">
  
    @error('invoice_no')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 
  </div>

  <div class="form-group">
    <label for="invoice_date">Invoice Date.</label>
    <input type="date" class="form-control" id="invoice_date" name="invoice_date">
  
    @error('invoice_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group ">
    <label for="supplier_code">Supplier</label>
    <select class="form-control " id="exampleFormControlSelect1" name="supplier_code">
            @foreach($Suppliers as $Supplier)
           
    <option value="{{$Supplier->supplier_code}}">{{$Supplier->supplier_name}}</option>
            @endforeach
    </select>

    </div>
    
   

  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>



@endsection