@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/location/index">Back</a>
</div>
<hr>

@if (!empty($status))
    <div class="alert alert-success text-center">
       <strong>{{ $status }}</strong> 
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Edit Location</strong></h5>
        <h6 class="text-center form-card-header-custom"><strong class="text-light">{{$location->location_name}}</strong></h6>
    </div>
    <div class="card-body">
        <form action="/location/update/{{$location->location_code}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="LocationName" class="col-sm-2 col-form-label">Location Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('location_name') ? 'has_error' : '' }}" id="location_name" placeholder="Enter Supplier Code" name="location_name" value="{{ old('location_name') ?? $location->location_name }} ">
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
                    <input type="text" class="form-control {{ $errors->has('location_code') ? 'has_error' : '' }}" id="location_code" placeholder="Enter Supplier Code" name="location_code" value="{{ old('location_code') ?? $location->location_code}}">
                    <span id="live_location_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('location_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>

                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom mx-auto" type="submit" id="saveLocation">Update Location</button>
            </div>
          
        </form>
    </div>
</div>
<script src="{{ asset('js/real_time_validation.js') }}"> </script>
@endsection
