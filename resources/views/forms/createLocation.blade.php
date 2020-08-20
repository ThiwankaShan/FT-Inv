@extends('layouts.app')
@section('content')


<div class="container-fluid">
<div class="card">
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
  <h5 class="card-header">Add New Location</h5>
  <div class="card-body">
    <form method="post" action="{{route('location.store')}}">
    @csrf
<label for="location_code">Location Code</label>
    <input type="text" class="form-control" name="location_code" required>
                                @error('location_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
    <label for="location_name">Location Name</label>
    <input type="text" class="form-control" name="location_name" required>
                                @error('location_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
<button type="submit" class="btn btn-primary form-card-header-custom text-light mt-4">Save Location Details</button>

    </form>

  </div>
</div>




@endsection