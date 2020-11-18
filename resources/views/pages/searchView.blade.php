<!-- here is the filter form -->

<div class="card ">
    <div class="card-header ">
    <div class="row ">
          <div class="col-sm-5 d-flex flex-row">
             <p style="font-size:16px; font-weight:bold" class="mt-1 mr-2">Sort By</p>
           
                 <select class="form-control selector mr-2   text-dark " style="outline:none; width:200px; border-color:#C21E56; border-width:1.5px"  id="location_sort"  data-column="0">
                    <option value=""> Select</option>
                        @foreach($locations as $location)
                        <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                        @endforeach
                 </select>

                 <select name="" id="" class="form-control  text-dark" style="outline:none; width:100px; border-color:#C21E56; border-width:1.5px">
                     <option value="ASC">ASC</option>
                     <option value="DESC">DESC</option>
                </select>

                <button class="btn btn-outline-success py-0 ml-2"  type='button'>Sort</button>
             
          </div><!-- /.col -->
          <div class="col-sm-4 d-flex flex-row">
              <p style="font-size:16px; font-weight:bold" class="mt-2 mr-2">Show</p>
                <a href="/dashboard/show/15" class="btn  mr-2 dashboard-button text-dark pt-2 " style="border: 2px solid #C21E56; background-color:##f2f2f2;">15</a>
                <a href="/dashboard/show/30" class="btn  mr-2 dashboard-button text-dark pt-2" style="border: 2px solid #C21E56; background-color:##f2f2f2;">30</a>
                <a href="/dashboard/show/75" class="btn  mr-2 dashboard-button text-dark pt-2" style="border: 2px solid #C21E56; background-color:##f2f2f2;">75</a>
                <a href="/dashboard/show/500000000" class="btn  mr-2 dashboard-button text-dark pt-2" style="border: 2px solid #C21E56; background-color:##f2f2f2;">All</a>

          </div><!-- /.col -->
          <div class="col-sm-3 d-flex flex-row">
              <p style="font-size:16px; font-weight:bold" class="mt-2 mr-2">Pages</p>
              {{$items->links()}}
          </div>
     </div>
     <hr>
    <div>
    <form action="" class="ml-0  form-inline">
        <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4 bg-light mr-4 "  style="outline:none; color:#C21E56; font-weight:bold; border:none; " id="location"  data-column="0">
            
            <option value=""> Location</option>
            @foreach($locations as $location)
            <option value="{{$location->location_code}}">{{$location->location_name}}</option>
            @endforeach
        </select>

        <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4 bg-light mr-4" style="color:#C21E56; font-weight:bold; border:none; background-color:#f2f2f2 " id="sublocation"  data-column="1">
            <option value=""> Sub Location</option>

        </select>

        <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4 bg-light mr-4" style="color:#C21E56; font-weight:bold; border:none; background-color:#f2f2f2 " id="category"  data-column="2">
            <option value=""> Category</option>
            @foreach($categories as $category)
            <option value="{{$category->category_code}}">{{$category->category_name}}</option>
            @endforeach
        </select>

        <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4 bg-light mr-4" style="color:#C21E56; font-weight:bold; border:none; background-color:#f2f2f2 " id="subCategory"  data-column="3">

            <option value=""> Sub Category</option>

        </select>

        <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble4 bg-light mr-4" style="color:#C21E56; font-weight:bold; border:none; background-color:#f2f2f2 " id="Type"  data-column="4">
            <option value=""> Type</option>
            <option value="Asset">Asset</option>
            <option value="Consumable">Consumable</option>

        </select>

        <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble3 bg-light " style="color:#C21E56; font-weight:bold; border:none; background-color:#f2f2f2 " id="ProID"  data-column="5">
            <option value=""> Procurement ID</option>
             @foreach($proId as $pId)
             <option value="{{$pId->procurement_id}}">{{$pId->procurement_id}}</option>
             @endforeach
        </select>

        
        <button class="btn btn-outline-success px-2  ml-auto" id="filter" type='button'>Filter</button>
        <button class="btn btn-outline-primary px-2  ml-2" id="filter1" type='submit'>Reset</button>
    </form>

    </div>
    </div>

    <!-- here is the table  -->

<div class="card-body px-0"> 
<div class="container-fluid" id="dataTable">
    <table class="table" >
        <thead class="thead text-white" style="background-color:#691330">
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
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
                <th scope="col" class="text-center">Action</th>
                @endif
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
                <td class="d-flex flex-row">
                    @if(auth()->user()->role == 'admin')
                        <a class="btn btn-primary mr-1 text-light" href="/item/edit/{{$item->item_code}}">Edit</a> 
                        <a href="/item/delete/{{$item->item_code}}" data-method="post" class="btn btn-danger delete-item text-light" token='{!! csrf_token() !!}'>Delete</a>
                    @elseif(auth()->user()->role == 'manager')
                        <a class="btn btn-primary mr-1 text-light" href="/item/edit/{{$item->item_code}}">Edit</a> 
                    @endif
                </td>
                

            </tr>
            @endforeach
            
        </tbody>
    </table>
    

    </div>
 </div>
 </div>

 <!-- This is a warnnig that if did not select Location -->
 <button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subLoca" id="alertLocation">Small modal</button>
  <div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="subLoca">
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