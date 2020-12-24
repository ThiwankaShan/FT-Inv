@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('grn.show',1) }}">Back</a>
</div>
<hr>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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

                <form  class="form-align-custom" id="Grn_form">
                    @csrf

                    <div class="form-group form-custom">
                        <label for="GRN_no">GRN No.</label>
                        <input type="text" class="form-control form-custom" id="GRN_number" name="GRN_number" value="{{$suggest_grnNo}}">

                    </div>

                    <div class="form-group form-custom">
                        <label for="GRN_date">GRN Date</label>
                        <input type="date" class="form-control" name="GRN_date" id="GRN_date">

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="GRN_date_error">
                            <small style="color:red"><strong id="GRN_date_msg"></strong></small>
                        </span>
                   

                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="invoice_error">
                            <small style="color:red"><strong id="invoice_msg"></strong></small>
                        </span>

                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_date">Invoice Date.</label>
                        <input type="date" class="form-control" id="invoice_date" name="invoice_date">

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="invoice_date_error">
                            <small style="color:red"><strong id="invoice_date_msg"></strong></small>
                        </span>

                        <div class="form-group form-custom">
                            <label for="supplier_code">Supplier</label>
                            <select class="form-control" id="supplier_code" name="supplier_code">
                                @foreach($Suppliers as $Supplier)
                                <option value="{{$Supplier->supplier_code}}" class="form-custom">{{$Supplier->supplier_name}}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="text-center">
                            <button type="button" class="btn form-card-header-custom text-light" id="save_GRN">Create</button>
                           
                        </div>

                </form>
            </div>
        </div>

@endsection