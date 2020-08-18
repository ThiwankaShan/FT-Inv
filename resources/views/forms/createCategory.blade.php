
@extends('layouts.app')
@section('content')
<div class='container'>
<form action="{{ route('category.store') }}" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  <div class="form-group">
    <label for="category_name">Category Name</label>
    <input type="text" class="form-control" id="category_name" name="category_name">
  
    @error('category_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Category Code</label>
    <input type="text" class="form-control" name="category_code" aria-describedby="emailHelp">
    @error('category_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>

 

  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>

@endsection