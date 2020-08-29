
@extends('layouts.PageLayout')
@section('content')
<div class="container-fluid ">
    <a class="btn btn-dark text-white" href="/item/create">Back</a>
</div>
<hr>
<div class='card w-75  item-create'>

<h5 class="form-card-header-custom text-white p-3">Add New Category</h5>
<div class="card-body">
<form action="{{ route('category.store') }} " class="form-align-custom" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  <div class="form-group form-custom">
    <label for="category_name">Category Name</label>
    <input type="text" class="form-control" id="category_name" name="category_name">

    @error('category_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>
  <div class="form-group form-custom">
    <label for="exampleInputEmail1">Category Code</label>
    <input type="text" class="form-control" name="category_code" aria-describedby="emailHelp">
    @error('category_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>


<div class="text-center">
  <button type="submit" class="btn form-card-header-custom text-light">Create</button>
  </div>
</form>
</div>
</div>

@endsection
