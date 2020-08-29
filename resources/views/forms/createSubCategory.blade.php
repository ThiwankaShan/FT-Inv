@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ">
    <a class="btn btn-dark text-white" href="/item/create">Back</a>
</div>

<div class='container'>
<h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Sub Category</strong></h5>
<form action="{{ route('subcategory.store') }}" class=" form-align-custom" method="POST">
@csrf
@if (session('success'))
<div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
    <div class="form-group ">
    <label for="item-name ">Categories</label>
    <select class="form-control form-custom" id="exampleFormControlSelect1" name="Category_code">
            @foreach($Categories as $Category)

    <option value="{{$Category->category_code}}">{{$Category->category_name}}</option>
            @endforeach
    </select>


</div>


  <div class="form-group">

    <label for="subCategory_name">Sub Category Name</label>
    <input type="text" class="form-control form-custom" id="subCategory_name" name="subCategory_name">


    @error('subCategory_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>
  <div class="form-group form-custom">
    <label for="subLocarion_code">Sub Category Code</label>
    <input type="text" class="form-control" name="subCategory_code" >
    @error('subCategory_code')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  </div>


<div class="text-center">
  <button type="submit" class="btn form-card-header-custom text-light ">Create</button>
</div>
</form>
</div>




@endsection
