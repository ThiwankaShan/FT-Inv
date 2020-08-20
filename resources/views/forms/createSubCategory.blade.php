@extends('layouts.app')
@section('content')

<div class='container'>
<form action="{{ route('subcategory.store') }}" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group ">
    <label for="item-name ">Categories</label>
    <select class="form-control " id="exampleFormControlSelect1" name="Category_code">
            @foreach($Categories as $Category)
           
    <option value="{{$Category->category_code}}">{{$Category->category_name}}</option>
            @endforeach
    </select>

</div>
  <div class="form-group">
    <label for="subCategory_name">Sub Category Name</label>
    <input type="text" class="form-control" id="subCategory_name" name="subCategory_name">
  
    @error('subCategory_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>
  <div class="form-group">
    <label for="subLocarion_code">Sub Category Code</label>
    <input type="text" class="form-control" name="subCategory_code" >
    @error('subCategory_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
  </div>

 

  <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>




@endsection