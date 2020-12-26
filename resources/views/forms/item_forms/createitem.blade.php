@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 ">
    <a class="btn btn-dark text-light" href="/home">Back</a>
</div>
<hr>

<div class="card w-75  item-create mx-auto">
    <h5 class="card-header form-card-header-custom"><strong class="text-light"> Add Item Form</strong></h5>
    <div class="card-body">

        <form action="{{ route('item.store') }}" method="POST" id="create_item_form">
            @csrf

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Location</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <select class="form-control {{ $errors->has('location_code') ? 'has_error' : ''}} " id="location" name="location_code" >
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                            <option value="{{$location->location_code}}" {{ $location->location_code === old('location_code') ? 'selected' : ''}}>{{$location->location_name}}</option>
                            @endforeach
                        </select>

                        @error('location_code')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>
                        @enderror
                    </div> 
                </div>
                <div class="col-3">
                    <a class="btn form-control button-style" href="" id="buttonCreateLocation" data-toggle="modal"  data-target="#Add_new_Location" class="button">Add New Location</a>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Sub Location</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <select class="form-control {{ $errors->has('subLocation_code') ? 'has_error' : ''}}" id="sublocation" name="subLocation_code">
                            <option value="">Select Sub Location</option>
                            @foreach($subLocations as $subLocation)
                            <option value="{{$subLocation->subLocation_code}}" {{ $subLocation->subLocation_code === old('subLocation_code') ? 'selected' : ''}}>{{$subLocation->subLocation_name}}</option>
                            @endforeach
                        </select>

                        @error('subLocation_code')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="col-3">
                <a class="btn form-control button-style" href="" id="buttonCreateSubLoaction" data-toggle="modal"  data-target="#Add_new_subLocation" class="button">Add New Sub Location</a>                </div>
            </div>
            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Category</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <select class="form-control {{ $errors->has('category_code') ? 'has_error' : ''}}" id="category" name="category_code">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->category_code}}" {{ $category->category_code === old('category_code') ? 'selected' : '' }}>{{$category->category_name}}</option>
                            @endforeach
                        </select>

                        @error('category_code')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                    </div>
                </div>
                <div class="col-3">
                <a class="btn form-control button-style" href="" id="button_create_category" data-toggle="modal"  data-target="#Add_new_category" class="button">Add New Category</a>  
                </div>
            </div>


            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Sub Category</label>
                    </div>
                    <div class="col-sm-9">
                        <select class="form-control " id="subCategory" name="subCategory_code">
                            <option value="000" class="default_option">Select Sub Category</option>
                            @foreach($subCategories as $subcategory)
                            <option value="{{$subcategory->subCategory_code}}" {{$subcategory->subCategory_code === old('subCategory') ? 'selected' : ''}}>{{$subcategory->subCategory_name}}</option>
                            @endforeach
                        </select>
                       
                    </div>
                </div>
                <div class="col-3">
                <a class="btn form-control button-style" href="" id="button_create_subCategory" data-toggle="modal"  data-target="#Add_new_subCategory" class="button">Add New Sub Category</a>  
                </div>
            </div>

            <div class="form-row col-sm-9 pl-0">
                <div class="form-group col-sm-6">
                    <label for="quantiy">No. Of Items</label>
                    <input type="number" class="form-control {{ $errors->has('Quantity') ? 'has_error' : ''}}" id="noItems" placeholder="" name="Quantity" value="{{ old('Quantity') }}">
                    @error('Quantity')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                    <span class="" role="alert">
                        <small style="color:red" id="quantityError"></small>
                    </span>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="quantiy">No. Of Sub Items </label>
                    <input type="number" class="form-control" value="0" id="NoSub" placeholder="" name="sub_item" value="{{ old('sub_item') }}">
                </div>
            </div>
            <div class=" col-sm-9 row pl-0">
                <div class="col-sm-3">
                    <label for="item-name ">Type</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios1" value="Asset" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Asset
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios2" value="Consumable" checked>
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
                        <select class="form-control " id="grn_number" name="GRN_number">
                            @foreach($grn as $grns)
                            <option value="{{$grns->GRN_number}}">{{ $grns->GRN_number }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-3">

                <a class="btn form-control button-style" href="" id="button_create_grn" data-toggle="modal"  data-target="#Add_new_GRN" class="button">Add New GRN</a>  

                </div>
            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Purchase date</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <div class="form-group form-custom">
                            <input type="date" class="form-control {{ $errors->has('purchased_date') ? 'has_error' : ''}}" name="purchased_date" id="purchased_date" value="{{ old('purchased_date') }}"> 
                            @error('purchased_date')
                                <span class="" role="alert">
                                    <small style="color:red"><strong>{{ $message }}</strong></small>
                                </span>

                           @enderror 
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row ">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Brand Name</label>
                    </div>
                    <div class="col-sm-9 mb-1 ">
                        <input type="text" name="brandName" id="brandName" class="form-control {{ $errors->has('brandName') ? 'has_error' : ''}}" value="{{ old('brandName')}}">
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
                        <input type="text" name="model_number" id="model_number" class="form-control {{ $errors->has('Vat') ? 'has_error' : ''}}" value="{{ old('model_number')}}">
                        <span id="real_time_model_number" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                        @error('model_number')
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
                        <label for="item-name ">Tax</label>
                    </div>
                    <div class="col-sm-9 mb-1 ">
                        <input type="text" name="tax" id="tax" class="form-control {{ $errors->has('tax') ? 'has_error' : ''}}" value="{{ old('tax')}}">
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
                        <input type="text" name="procument_id" id="procument_id" class="form-control" value="{{ old('procument_id') }}">
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
                        <input type="text" name="gross_price" id="gross_price" class="form-control {{ $errors->has('gross_price') ? 'has_error' : ''}}" value="{{ old('gross_price') }}">
                        <span id="real_time_gross_price" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>

                        @error('gross_price')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                        @enderror
                       
                    </div>
                </div>

            </div>

           


            <div class="text-center">


                {{ csrf_field() }}

                <button type="submit" class="btn form-card-header-custom text-light" id="btn_submit" type="button" name="action" value="save">Save Item Details</button>
                <button class="btn form-card-header-custom text-light" id="preview" data-target="#itemCodes" type="button">show Item codes</button>
            </div>
        </form>

    </div>
</div>

<div class="container-fluid pt-2 pl-4">
    <div class="modal fade  ml-5" style="top:10%" id="itemCodes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="text-white">Item Codes</h1>
                </div>
                <div class="modal-body">
                    <table class="w-100">


                        <tboday id="itemCode" class="w-100 p-3">

                        </tboday>

                        <ul id="itemCode" class="w-100 p-3">
                        </ul>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@include('forms.location_forms.createLocation_modal')
@include('forms.subLocation_forms.createSubLocation_modal')
@include('forms.category_forms.createCategory_modal')
@include('forms.subCategory_forms.createSubCategory_modal')
@include('forms.grn_forms.createGRN_modal')

<script src="{{ asset('js/add_new_parts.js') }}"> </script>
<script src="{{ asset('js/real_time_validation.js') }}"> </script>


@endsection