@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid">

 <a class="btn btn-warning" href="{{ route('item.create') }}">Create Items</a>



</div>

<hr>
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
    <form method="post" action="/create">
    @csrf
<label for="location_code">Location Code</label>
    <input type="text" class="form-control" name="location_code" required>
                                @error('Location_code')
                                    <span class="invalid-feedback" role="alert" >
                                    {{ session('failed') }}
                                    </span>
                                @enderror
    <label for="location_name">Location Name</label>
    <input type="text" class="form-control" name="location_name" required>
<button type="submit" class="btn btn-primary form-card-header-custom text-light mt-4">Save Location Details</button>

    </form>

  </div>
</div>
<!-- <div class="card mt-3">
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
  <h5 class="card-header">Add New Sub Location</h5>
  <div class="card-body">
    <form method="post" action="/create">
    @csrf
<label for="location_code">Location Code</label>
<select name="location_code">

	</select>
                                @error('Location_code')
                                    <span class="invalid-feedback" role="alert" >
                                    {{ session('failed') }}
                                    </span>
                                @enderror
                                <br>
    <label for="sub_location_code">Sub Location Code</label>
    <input type="text" class="form-control" name="sub_location_code" required>
    <label for="sub_location_name">Sub Location Name</label>
    <input type="text" class="form-control" name="sub_location_name" required>

<button type="submit" class="btn btn-primary form-card-header-custom text-light mt-4">Save Sub Location Details</button>

    </form>

  </div>
</div> -->
</div>


@endsection
