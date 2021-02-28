@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="{{ route('category.index') }}">Back</a>
</div>
<hr>

@if (session('status'))
    <div class="alert alert-success text-center">
      <strong>  {{ session('status') }}</strong>
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Category</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('category.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('category_name') ? 'has_error' : '' }}" id="category_name" placeholder="Enter Category Name" name="category_name" value="{{ old('category_name') }}">
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
                    <input type="text" class="form-control {{ $errors->has('category_code') ? 'has_error' : '' }}" id="category_code" placeholder="Enter Category Code" name="category_code" value="{{ old('category_code') }}">
                    <span id="live_category_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('category_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom mx-auto" type="submit" id="saveCategory">Save Category</button>
            </div>
          
        </form>
    </div>
</div>

<script src="{{ asset('js/validation.js') }}"> </script>
@endsection
