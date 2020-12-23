<div class="row ">
  <div class="col-sm-5 d-flex flex-row">
    <h6 style="font-size:16px; font-weight:bold" class="mt-2 mr-2">Sort By</h6>


    <select class="form-control selector mr-2 mb-1 text-dark" id="column"
      style="outline:0px; width:200px; border-color:#C21E56; border-width:1.5px" data-column="0">
      <option value="location_code">Location</option>
      <option value="type">Type</option>
      <option value="purchased_date">Purchased date</option>
      <option value="supplier_name">Supplier name</option>
      <option value="GRN_no">GRN number</option>
      <option value="procurement_id">Procurement ID</option>
      <option value="created_at">Created time</option>
    </select>


    <select class="form-control selector mr-2 mb-1 text-dark" id="order"
      style="outline:0px; width:100px; border-color:#C21E56; border-width:1.5px">
      <option value="ASC">Ascending</option>
      <option value="DESC">Descending</option>
    </select>

    <button class="btn btn-outline-success ml-2" style="height:40px;" id="sort" type='button'>Sort</button>

  </div>
  <div class="col-sm-4 d-flex flex-row">
    <h6 style="font-size:16px; font-weight:bold" class="mt-2 mr-2">Show</h6>
    <a href="/dashboard/show/15" class="btn  mr-2 dashboard-button text-dark  "
      style="border: 2px solid #C21E56; background-color:#f2f2f2;">15</a>
    <a href="/dashboard/show/30" class="btn  mr-2 dashboard-button text-dark "
      style="border: 2px solid #C21E56; background-color:#f2f2f2;">30</a>
    <a href="/dashboard/show/75" class="btn  mr-2 dashboard-button text-dark "
      style="border: 2px solid #C21E56; background-color:#f2f2f2;">75</a>
    <a href="/dashboard/show/500000000" class="btn  mr-2 dashboard-button text-dark "
      style="border: 2px solid #C21E56; background-color:#f2f2f2;">All</a>

  </div>
  <div class="col-sm-3 d-flex flex-row">

    <h6 style="font-size:16px; font-weight:bold" class="mt-2 mr-2">Pages</h6>
    <div calss="ml-auto">{{$items->links()}}</div>
  </div>
</div>
<hr>
<div>
  <form action="" class="  form-inline">
    <select class="form-control selector  mb-1 diseble2 diseble3 diseble4 bg-light mr-2"
      style="outline:0px; width:200px; font-weight:bold; border:none; " id="location" data-column="0">

      <option value=""> Location</option>
      @foreach($locations as $location)
      <option value="{{$location->location_code}}">{{$location->location_name}}</option>
      @endforeach
    </select>

    <select class="form-control selector  mb-1 diseble2 diseble3 diseble4 bg-light mr-2"
      style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="sublocation" data-column="1">
      <option value=""> Sub Location</option>

    </select>

    <select class="form-control selector  mb-1 diseble1 diseble3 diseble4 bg-light mr-2"
      style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="category" data-column="2">
      <option value=""> Category</option>
      @foreach($categories as $category)
      <option value="{{$category->category_code}}">{{$category->category_name}}</option>
      @endforeach
    </select>

    <select class="form-control selector  mb-1 diseble1 diseble3 diseble4 bg-light mr-2"
      style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="subCategory" data-column="3">

      <option value="" class="default_option"> Sub Category</option>
      <option value="000" class="default_option"> 000</option>
    </select>

    <select class="form-control selector  mb-1 diseble1 diseble2 diseble4 bg-light mr-2"
      style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="Type" data-column="4">
      <option value=""> Type</option>
      <option value="Asset">Asset</option>
      <option value="Consumable">Consumable</option>

    </select>

    <select class="form-control selector  mb-1 diseble1 diseble2 diseble3 bg-light mr-3"
      style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="ProID" data-column="5">
      <option value=""> Procurement ID</option>
      @foreach($proId as $pId)
      <option value="{{$pId->procurement_id}}">{{$pId->procurement_id}}</option>
      @endforeach
    </select>


    <button class="btn btn-outline-success ml-auto  mr-2" id="filter" type='button'>Filter</button>
    <button class="btn btn-outline-primary" id="filter1" type='submit'>Reset</button>
  </form>

</div>
<!-- This is a warnnig that if did not select Location -->
<button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subLoca"
  id="alertLocation">Small modal</button>
<div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
  aria-hidden="true" id="subLoca">
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
<button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subCate"
  id="alertCategory">Small modal</button>
<div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
  aria-hidden="true" id="subCate">
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

@if(Session::has('updated_row'))
<input type="hidden" name="" id="highlighted_row" value="{{ Session::get('updated_row') }}">

@endif
