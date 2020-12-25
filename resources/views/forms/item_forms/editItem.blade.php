@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 ">

    <a class="btn btn-dark text-light" href="{{ $request_url }}">Back</a>
</div>
<hr>

<div class="card w-75  item-create mx-auto">
    <h5 class="card-header form-card-header-custom"><strong class="text-light"> Update Item Form</strong></h5>
    <div class="card-body">

        <form action="/item/update/{{$item->item_code}}" method="POST" id="create_item_form">
            @csrf
            <div class="card text-center" style="margin-bottom:30px;">
                <div class="card-header">
                 <h4 class="font-weight-bold">   {{$item->item_code}} </h4>
                </div>
            </div>
            <div class=" col-sm-9 row pl-0">
                <div class="col-sm-3">
                    <label for="item-name ">Type</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios1" value="Asset" {!! $item->type=='Asset'?"checked":'' !!}>
                        <label class="form-check-label" for="exampleRadios1">
                            Asset
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios2" value="Consumable" {!! $item->type=='Consumable'?"checked":'' !!}>
                        <label class="form-check-label" for="exampleRadios2">
                            Consumable
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">GRN No.</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <select class="form-control " id="GRN_number" name="GRN_number">
                            <option value="{{$item->GRN_number}}">{{ $item->GRN_number }}</option>
                            @foreach($grns as $grn)
                            <option value="{{$grn}}">{{ $grn }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">



                <a class="btn form-control button-style" href="" id="button_create_grn" data-toggle="modal"  data-target="#Add_new_GRN" class="button">Add New GRN</a>  

                </div>
            </div>


            <div class="form-group row ">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Brand Name</label>
                    </div>
                    <div class="col-sm-9 mb-1 ">
                        <input type="text" name="brandName" id="brandName" class="form-control {{ $errors->has('brandName') ? 'has_error' : ''}}" value="{{ old('brandName') ?? $item->brandName}}">
                        <span id="real_time_brandName" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                        @error('brandName')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                        
                    </div>
                </div>

            </div>

            <div class="form-group row ">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Model Number</label>
                    </div>
                    <div class="col-sm-9 mb-1 ">
                        <input type="text" name="model_number" id="model_number" class="form-control {{ $errors->has('model_number') ? 'has_error' : ''}}" value="{{ old('model_number') ?? $item->model_number}}">
                        <span id="real_time_model_number" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                        @error('model_number')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                       
                    </div>
                </div>

            </div>


            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Tax</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="tax" id="tax" class="form-control" value="{{$item->tax}}">
                        <span id="real_time_tax" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>

                        @error('tax')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                       
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="pro">Procurement ID (Optional)</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="procument_id" id="procument_id" class="form-control" value="{{$item->procurement_id}}">
                        <span id="real_time_procument_id" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
 
                        @error('procument_id')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                        
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="rate">Price/Item</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="gross_price" id="gross_price" class="form-control" value="{{$item->gross_price}}">
                        <span id="real_time_gross_price" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>

                        @error('gross_price')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                        
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="purchased_date">Purchased date</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="date" name="purchased_date" id="purchased_date" class="form-control" value="{{$item->purchased_date}}">
                        @error('purchased_date')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                       
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="purchased_date">Serial Number</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{$item->serial_number}}">
                        <span id="real_time_serial_number" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                        @error('serial_number')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                        
                    </div>
                </div>

            </div>

           

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong class="text-center">{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="text-center">

               <input type="hidden" name="back_to" value="{{  $request_url }}">
               
               {{ csrf_field() }}

                <button type="submit" class="btn form-card-header-custom text-light" id="btn_submit" type="button" name="action" value="save">Update Item Details</button>
                <button class="btn form-card-header-custom text-light "  style="display:none" id="preview" data-target="#itemCodes" type="button">show Item codes</button>
            </div>
        </form>

    </div>
</div>


<!-- Here is Add new GRN Form -->
<div class="modal fade bd-example-modal-lg" style="top:40px"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_GRN" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
  
            <div class='card w-100  item-create'>
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
                        <input type="text" class="form-control form-custom" id="grn_number" name="GRN_number" value="{{$suggest_grnNo}}">

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
                            <select class="form-control" id="supplier_name" name="supplier_code">
                                @foreach($Suppliers as $Supplier)

                                <option value="{{$Supplier->supplier_code}}" class="form-custom">{{$Supplier->supplier_name}}</option>
                                @endforeach
                            </select>

                        </div>
                       
        
                        <div class="text-center">
                            <button type="button" class="btn form-card-header-custom text-light" id="save_GRN">Create</button>
                            <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                        </div>

                </form>
            </div>
        </div>

   
    </div>
  </div>
</div>

<!-- Here is the js file that including ajax functions for add new GRN -->
<script src="{{ asset('js/add_new_parts.js') }}"> </script>
<script src="{{ asset('js/real_time_validation.js') }}"> </script>
@endsection
