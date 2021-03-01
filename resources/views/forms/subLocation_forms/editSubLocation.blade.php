@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">

    <a class="btn btn-dark text-white" href="/subLocation">Back</a>
</div>
<hr>

@if (!empty($status))
    <div class="alert alert-success text-center">
      <strong>{{ $status }}</strong>  
    </div>
@endif

<div class="card w-75  item-create mx-auto">
    <div class="card-header form-card-header-custom">
        <h5 class="text-center form-card-header-custom"><strong class="text-light">Edit Sub Location</strong></h5>
        <h6 class="text-center form-card-header-custom"><strong class="text-light">{{$subLocation->subLocation_name}}</strong></h6>
    </div>
    <div class="card-body">
        <form action="/subLocation/update" method="POST">
            @csrf

            <input type="hidden" name="subLocation" value="{{$subLocation->subLocation_code}}">
            <input type="hidden" name="location" value="{{$subLocation->location_code}}">
            <input type="hidden" name="subLocationName" value="{{$subLocation->subLocation_name}}">

            <div class="form-group row">
                <label for="item-name " class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                <select class="form-control {{ $errors->has('location_code') ? 'has_error' : '' }}" name="location_code" >
                    @foreach($locations as $location)
                        <option value="{{$location->location_code}}" 
                      
                           {{ old('location_code') ?   (($location->location_code === old('location_code')) ? 'selected' : '')  :
                            (($subLocation->location_code === $location->location_code) ? 'selected' : '') }}>{{ $location->location_name }}

                        </option>
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
                    <input type="text" class="form-control {{ $errors->has('subLocation_name') ? 'has_error' : '' }}" id="subLocation_name" placeholder="Sub Location Name" name="subLocation_name" value="{{ old('subLocation_name') ?? $subLocation->subLocation_name }} ">
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
                    <input type="text" class="form-control {{ $errors->has('subLocation_code') ? 'has_error' : '' }}" id="subLocation_code" placeholder="Sub Location Code" name="subLocation_code" value="{{ str_pad(old('subLocation_code') ?? $subLocation->subLocation_code,'3',0, STR_PAD_LEFT )}}">
                    <span id="live_subLocation_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                    @error('subLocation_code')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button class="btn form-tab-custom bg-color-custom text-light form-card-header-custom mx-auto" type="submit" id="saveSubLocation">Update Sub Location</button>
            </div>
          
        </form>
    </div>
</div>

<script src="{{ asset('js/validation.js') }}"> </script>
@endsection
