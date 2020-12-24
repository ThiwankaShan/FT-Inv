@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('subcategory.index') }}">Back</a>
</div>
<hr>

@if (!empty($status))
    <div class="alert alert-success">
        {{ $status }}
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Sub Category</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('subcategory.store')}}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="item-name " class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                <select class="form-control " id="category" name="Category_code">
                    @foreach($categories as $category)
                        <option value="{{$category->category_code}}">{{$category->category_name}}</option>
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
                    <input type="text" class="form-control {{ $errors->has('subCategory_name') ? 'has_error' : '' }}" id="subCategory_name" placeholder="Enter Sub Category Name" name="subCategory_name" value="{{ old('subCategory_name') }}">
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
                    <input type="text" class="form-control {{ $errors->has('subCategory_code') ? 'has_error' : '' }}" id="subCategory_code" placeholder="Enter Sub Category Code" name="subCategory_code" value="{{ old('subCategory_code') }}">
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
