@extends('layouts.PageLayout')
@section('content')


<hr>
<div class="card">
    <div class="card-header pr-0">
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
            <option value="000">Select Sub Category</option>

        </select>

        <button class="btn btn-outline-success  px-5" id="filter" type='button'>Filter</button>

    </form>

    </div>
<div class="card-body">
<div class="container-fluid">
    <table class="table" id="dataTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Locaton Code</th>
                <th scope="col">Sub Location Code</th>
                <th scope="col">Category Code</th>
                <th scope="col">Sub Category Code</th>
                <th scope="col">Type</th>
                <th scope="col">GRN No</th>
                <th scope="col">Vat</th>
                <th scope="col">Vat Rate</th>
                <th scope="col">Procurement Id</th>
                <th scope="col">Rate</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody id="dataBody">
            @foreach($items as $item)
            <tr>
                <th scope="row">{{$item->item_code}}</th>
                <td>{{$item->location_code}}</td>
                <td>{{$item->subLocation_code}}</td>
                <td>{{$item->category_code}}</td>
                <td>{{$item->subCategory_code}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->GRN_no}}</td>
                <td>{{$item->vat}}</td>
                <td>{{$item->vat_rate_vat}}</td>
                <td>{{$item->procurement_id}}</td>
                <td>{{$item->rate}}</td>
                <td class="d-flex flex-row"><a href="" class="btn btn-primary mr-1">View</a>
                <a href="" class="btn btn-success mr-1">Edit</a>
                <a href="" class="btn btn-success">Delete</a>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    {{$items->links()}}

    </div>
 </div>
 </div>
@endsection
