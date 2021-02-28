@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('category.index') }}">Back</a>
</div>
<hr>

@if (!empty($status) )
    <div class="alert alert-success text-center">
      <strong>{{ $status}}</strong>    
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h3 class="text-center form-card-header-custom"><strong class="text-light">Edit Category</strong></h3>
        <h6 class="text-center form-card-header-custom"><strong class="text-light">{{ $category->category_name }}</strong></h6>
    </div>
    <div class="card-body">
        <form action="{{ route('category.update', $category->category_code) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('category_name') ? 'has_error' : '' }}" id="category_name" placeholder="Enter Category Name" name="category_name" value="{{ $category->category_name }}">
                    @error('category_name')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category_code" class="col-sm-2 col-form-label">Category Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('category_code') ? 'has_error' : '' }}" id="category_code" placeholder="Enter Category Code" name="category_code" value="{{ str_pad($category->category_code,'3',0, STR_PAD_LEFT ) }}">
                    <span id="live_category_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('category_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom mx-auto" type="submit" id="saveCategory">Update Category</button>
            </div>
          
        </form>
    </div>
</div>

<script src="{{ asset('js/validation.js') }}"> </script>
@endsection
