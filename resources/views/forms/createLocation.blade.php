@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">
    <a class="btn btn-dark text-white" href="/item/create">Back</a>
</div>
<div class="container">


@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('failed'))
                    <span class="invalid-feedback" role="alert">
                                    {{ session('failed') }}
                    </span>
                    @endif
  <h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Location</strong></h5>
  <div>
    <form method="post" action="{{route('location.store')}}" class="form-align-custom">
    @csrf
<label for="location_code">Location Code</label>
    <input type="text" class="form-control form-custom" name="location_code" >
                                @error('location_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
    <label for="location_name">Location Name</label>
    <input type="text" class="form-control form-custom" name="location_name" >
                                @error('location_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="text-center">
<button type="submit" class="btn btn-primary form-card-header-custom text-light mt-4">Create</button>
                                </div>
    </form>

  </div>
</div>




@endsection
