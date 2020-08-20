@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid ml-0 pb-3" style="border-bottom:3px solid  #c7528c">
   <form action="" class="ml-0 mt-4 form-inline">
            <select class="form-control selector mr-4 mb-1" id="division" name="division" data-column="0">
            <option value="">Select Location</option>
                @foreach($div as $division)
                    <option value="{{$division->location_code}}">{{$division->location_name}}</option>
                @endforeach
            </select>

            <select class="form-control selector mr-4 mb-1" id="subDivision" name="subDivision" data-column="1">
                <option value="">Select Sub Location</option>

            </select>

            <select class="form-control selector mr-4 mb-1" id="category" name="category" data-column="2">
                <option value="">Select Category</option>
                @foreach($cate as $category)
                    <option value="{{$category->category_code}}">{{$category->category_name}}</option>
                @endforeach
            </select>

            <select class="form-control selector mr-4 mb-1" id="subCategory" name="subCategory" data-column="3">
                <option value="000" >Select Sub Category</option>

            </select>

            <button class="btn btn-outline-success  px-5" id="filter" type='button'>Filter</button>
           
        </form>

</div>

<div class="container-fluid mt-4">

@include('layouts.filter');

</div>
@endsection
