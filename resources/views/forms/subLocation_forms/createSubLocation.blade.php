@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/subLocation">Back</a>
</div>
<hr>

@if (session('status'))
    <div class="alert alert-success text-center">
       <strong> {{ session('status') }}</strong>
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Add New Sub Location</strong></h5>
    </div>
    <div class="card-body">
        <form action="{{route('subLocation.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="item-name " class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                <select class="form-control " id="location" name="location_code">
                    @foreach($locations as $location)
                        <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                    @endforeach
                </select>
                @error('location_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="LocationName" class="col-sm-2 col-form-label">Sub Location Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('SubLocation_name') ? 'has_error' : '' }}" id="subLocation_name" placeholder="Enter Sub Location Name" name="subLocation_name" value="{{ old('subLocation_name') }}">
                    @error('subLocation_name')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="LocationCode" class="col-sm-2 col-form-label">Sub Location Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('subLocation_code') ? 'has_error' : '' }}" id="subLocation_code" placeholder="Enter Sub Location Code" name="subLocation_code" value="{{ old('subLocation_code') }}">
                    <span id="live_subLocation_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('subLocation_code')
                    <span class="" role="alert">
                        <small style="color:red"><strong>{{ $message }}</strong></small>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom mx-auto " type="submit" id="saveSubLocation">Save Sub Location</button>
            </div>
          
        </form>
    </div>
</div>


<script src="{{ asset('js/validation.js') }}"> </script>
@endsection
