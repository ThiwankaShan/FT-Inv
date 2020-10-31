@extends('layouts.PageLayout')
@section('content')

<hr>
<div class="card">
    <div class="card-header pr-0">
    <form action="" class="ml-0 mt-4 form-inline">
        <select class="form-control selector mr-2 mb-1" id="division" name="division" data-column="0">
            <option value="">Select Location</option>
            @foreach($div as $division)
            <option value="{{$division->location_code}}">{{$division->location_name}}</option>
            @endforeach
        </select>

        <select class="form-control selector mr-2 mb-1" id="subDivision" name="subDivision" data-column="1">
            <option value="">Select Sub Location</option>

        </select>

        <select class="form-control selector mr-2 mb-1" id="category" name="category" data-column="2">
            <option value="">Select Category</option>
            @foreach($cate as $category)
            <option value="{{$category->category_code}}">{{$category->category_name}}</option>
            @endforeach
        </select>

        <select class="form-control selector mr-2 mb-1" id="subCategory" name="subCategory" data-column="3">
            <option value="000">Select Sub Category</option>

        </select>

        <select class="form-control selector mr-2 mb-1" id="Type" name="subCategory" data-column="4">
            <option value="">Select Type</option>
            <option value="Asset">Asset</option>
            <option value="Consumable">Consumable</option>

        </select>

        <select class="form-control selector mr-2 mb-1" id="ProID" name="subCategory" data-column="5">
            <option value="">Select Procurement ID</option>
             @foreach($proId as $pId)
             <option value="{{$pId->procurement_id}}">{{$pId->procurement_id}}</option>
             @endforeach
        </select>

        <button class="btn btn-outline-success  px-1" id="filter" type='button'>Filter</button>

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
                
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    {{$items->links()}}

    </div>
 </div>
 </div>

 <!-- This is a warnnig that if did not select Location -->
 <button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subLocation" id="alertLocation">Small modal</button>
  <div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="subLocation">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header " style="background-color:#ffb3b3">
         <h2 class="text-center">Error!</h2>
      </div>
      <div class="modal-body">
        <p><strong>You Must Select Location First</strong> </p>
      </div>
    </div>
  </div>
</div>

<!-- This is a warnnig that if did not select Category -->
<button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subCate" id="alertCategory">Small modal</button>
  <div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="subCate">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header " style="background-color:#ffb3b3">
         <h2 class="text-center">Error!</h2>
      </div>
      <div class="modal-body">
        <p><strong> You Must Select Category First</strong></p>
      </div>
    </div>
  </div>
</div>
@endsection
