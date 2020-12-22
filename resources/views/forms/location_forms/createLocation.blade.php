@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/location/index">Back</a>
</div>
<hr>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Location</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('location.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="LocationName" class="col-sm-2 col-form-label">Location Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('location_name') ? 'has_error' : '' }}" id="location_name" placeholder="Enter Supplier Code" name="location_name" value="{{ old('location_name') }}">
                    @error('location_name')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="LocationCode" class="col-sm-2 col-form-label">Location Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('location_code') ? 'has_error' : '' }}" id="location_code" placeholder="Enter Supplier Code" name="location_code" value="{{ old('location_code') }}">
                    @error('location_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom " type="submit">Save Location</button>
            </div>
          
        </form>
    </div>
</div>

@endsection