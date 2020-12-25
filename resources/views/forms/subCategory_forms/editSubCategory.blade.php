@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('subcategory.index') }}">Back</a>
</div>
<hr>

@if (!empty($status))
    <div class="alert alert-success text-center">
        <strong>{{ $status }}</strong> 
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h3 class="text-center form-card-header-custom"><strong class="text-light">Edit Sub Category</strong></h3>
        <h6 class="text-center form-card-header-custom"><strong class="text-light">{{ $subcategory->subCategory_name }}</strong></h6>
    </div>
    <div class="card-body">
        <form action="/subCategory/update" method="post">
            @csrf
           

            <input type="hidden" name="SubCategory" value="{{ $subcategory->subCategory_code}}">
            <input type="hidden" name="Category" value="{{$subcategory->category_code}}">

            <div class="form-group row">
                <label for="item-name " class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                <select class="form-control " id="category" name="category_code">
                    @foreach($categories as $category)
                         <option  value="{{$category->category_code}}" 
                             
                            {{ $subcategory->category_code == $category->category_code ? 'selected' : '' }}
                            {{ $category->category_code == old('category_code') ? 'selected' : '' }}> {{$category->category_name}} 
                         
                          </option>
                    @endforeach
                </select>
                @error('category_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="subCategory_name" class="col-sm-2 col-form-label">Sub Category Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('subCategory_name') ? 'has_error' : '' }}" id="subCategory_name" placeholder="Enter Sub Category Name" name="subCategory_name" value="{{ old('subCategory_name') ?? $subcategory->subCategory_name}}">
                    @error('subCategory_name')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="LocationCode" class="col-sm-2 col-form-label">Sub Category Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('subCategory_code') ? 'has_error' : '' }}" id="subCategory_code" placeholder="Enter Sub Category Code" name="subCategory_code" value="{{ old('subCategory_code') ?? $subcategory->subCategory_code }}">
                    @error('subCategory_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom " type="submit">Save Sub Category</button>
            </div>
          
        </form>
    </div>
</div>

@endsection
