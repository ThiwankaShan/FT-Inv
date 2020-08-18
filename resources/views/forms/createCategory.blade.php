
@extends('layouts.app')
@section('content')
<div class='container'>
<form action="{{ route('category.store') }}" method="POST">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control" name="category_name" aria-describedby="emailHelp" >
    @error('category_code')
    <span class="invalid-feedback" role="alert" >
    {{ session('failed') }}
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Category Code</label>
    <input type="text" class="form-control" name="category_code" aria-describedby="emailHelp">
  
  </div>

 

  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>

@endsection