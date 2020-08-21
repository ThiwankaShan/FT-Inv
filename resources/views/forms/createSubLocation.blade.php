
@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">
    <a class="btn btn-dark text-white" href="/item/create">Back</a>
</div>

<div class='container'>
<h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Sub Location</strong></h5>
<form action="{{ route('sublocation.store') }} " class="form-align-custom" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group">

    <label for="item-name ">Location</label>
    <select class="form-control form-custom" id="exampleFormControlSelect1" name="Location_code">
            @foreach($Locations as $Location)

    <option value="{{$Location->location_code}}">{{$Location->location_name}}</option>
            @endforeach
    </select>

</div>
  <div class="form-group  form-custom">
    <label for="subLocation_name">Sub Location Name</label>
    <input type="text" class="form-control" id="subLocation_name" name="subLocation_name">

    @error('subLocation_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>
  <div class="form-group form-custom">
    <label for="subLocarion_code">Sub Location Code</label>
    <input type="text" class="form-control" name="subLocation_code" aria-describedby="emailHelp">
    @error('subLocation_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>


<div class=" text-center">
  <button type="submit" class="btn form-card-header-custom text-light">Create</button>
  </div>
</form>
</div>

@endsection
