@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('grn.show',1) }}">Back</a>
</div>
<hr>

@if (session('status'))
    <div class="alert alert-success text-center">
       <strong> {{ session('status') }}</strong>
    </div>
@endif

<div class='card w-75  item-create mb-0 mx-auto'>
            <h5 class="form-card-header-custom text-white p-3">Add New GRN</h5>

            <div class="card-body">

                         <div class="alert alert-success text-center" role="alert" style="display:none" id="valid_grn">
                                <strong>New GRN Created Successfully!!</strong>
                        </div>

                        <div class="alert alert-danger  " id="invalid_grn" style="display:none">
                            <ul ></ul>
                        </div>

             <form  class="form-align-custom" id="" action="{{ route('grn.store') }}"  method="post">
                    @csrf
                   
                    <div class="form-group form-custom">
                        <label for="GRN_no">GRN No.</label>
                        <input type="text" class="form-control form-custom {{ $errors->has('GRN_number') ? 'has_error' : '' }}" id="GRN_number" name="GRN_number" value="{{$suggest_grnNo}}">

                        @error('GRN_number')
                            <span class="" role="alert">
                                <small style="color:red"><strong>{{ $message }}</strong></small>
                            </span>

                        @enderror

                    </div>

                    <div class="form-group form-custom">
                        <label for="GRN_date">GRN Date</label>
                        <input type="date" class="form-control {{ $errors->has('GRN_date') ? 'has_error' : '' }}" name="GRN_date" id="GRN_date" >

                        @error('GRN_date')
                            <span class="" role="alert">
                                <small style="color:red"><strong>{{ $message }}</strong></small>
                            </span>

                        @enderror

                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" class="form-control {{ $errors->has('invoice_number') ? 'has_error' : '' }}" id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}">

                        @error('invoice_number')
                            <span class="" role="alert">
                                <small style="color:red"><strong>{{ $message }}</strong></small>
                            </span>

                        @enderror

                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_date">Invoice Date.</label>
                        <input type="date" class="form-control {{ $errors->has('invoice_date') ? 'has_error' : '' }}" id="invoice_date" name="invoice_date" >

                        @error('invoice_date')
                            <span class="" role="alert">
                                <small style="color:red"><strong>{{ $message }}</strong></small>
                            </span>

                        @enderror


                        <div class="form-group form-custom">
                            <label for="supplier_code">Supplier</label>
                            <select class="form-control {{ $errors->has('supplier_code') ? 'has_error' : '' }}" id="supplier_code" name="supplier_code">
                                @foreach($Suppliers as $Supplier)
                                <option value="{{$Supplier->supplier_code}}" class="form-custom">{{$Supplier->supplier_name}}</option>
                                @endforeach
                            </select>

                            @error('supplier_code')
                            <span class="" role="alert">
                                <small style="color:red"><strong>{{ $message }}</strong></small>
                            </span>

                        @enderror

                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn form-card-header-custom text-light" id="">Create</button>
                          
                        </div>

               
            </div>
        </div>

@endsection