
@extends('layouts.app')
@section('content')
<div class='container'>
<form action="{{ route('sublocation.store') }}" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group ">
    <label for="item-name ">Location</label>
    <select class="form-control " id="exampleFormControlSelect1" name="Location_code">
            @foreach($Locations as $Location)
           
    <option value="{{$Location->location_code}}">{{$Location->location_name}}</option>
            @endforeach
    </select>

</div>
  <div class="form-group">
    <label for="subLocation_name">Sub Location Name</label>
    <input type="text" class="form-control" id="subLocation_name" name="subLocation_name">
  
    @error('subLocation_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>
  <div class="form-group">
    <label for="subLocarion_code">Sub Location Code</label>
    <input type="text" class="form-control" name="subLocation_code" aria-describedby="emailHelp">
    @error('subLocation_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>

 

  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>

@endsection