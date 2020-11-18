<hr>



<div class="card">
    <div class="card-header pr-0">

        <!--Sort options section -->

        <form action="" class="ml-0 mt-4 form-inline">
         
            <select class="form-control selector mr-2 mb-1 " id="column" >
                <option value="location_code">Location</option>
                <option value="GRN_no">GRN number</option>
                <option value="rate">Rate</option>
            </select>

            <select class="form-control selector mr-2 mb-1 " id="order" >
                <option value="ASC">Asending</option>
                <option value="DESC">Decending</option>
            </select>

            <button class="btn btn-outline-success px-2 mb-1 mr-2" id="sort" type='button'>Sort</button>
        

        <!-- Sort section ends -->

        <!-- filter section -->
        
            <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4" id="location"  data-column="0">
            
                <option value=""> Location</option>
                @foreach($locations as $location)
                <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                @endforeach
            </select>

            <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4" id="sublocation"  data-column="1">
                <option value=""> Sub Location</option>

            </select>

            <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4" id="category"  data-column="2">
                <option value=""> Category</option>
                @foreach($categories as $category)
                <option value="{{$category->category_code}}">{{$category->category_name}}</option>
                @endforeach
            </select>

            <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4" id="subCategory"  data-column="3">

                <option value=""> Sub Category</option>

            </select>

            <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble4" id="Type"  data-column="4">
                <option value=""> Type</option>
                <option value="Asset">Asset</option>
                <option value="Consumable">Consumable</option>

            </select>

            <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble3" id="ProID"  data-column="5">
                <option value=""> Procurement ID</option>
                @foreach($proId as $pId)
                <option value="{{$pId->procurement_id}}">{{$pId->procurement_id}}</option>
                @endforeach
            </select>

            <button class="btn btn-outline-success px-2 mb-1 mr-2" id="filter" type='button'>Filter</button>
            <button class="btn btn-outline-primary px-2 mb-1 " id="filter1" type='submit'>Reset</button>
        </form>

    </div>
    <!-- filter section end -->
    
    <!-- here is the table  -->

<div class="card-body"> 
<div class="container-fluid" id="dataTable">
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Locaton Code</th>
                <th scope="col">Type</th>
                <th scope="col">Purchased date</th>
                <th scope="col">Supplier name</th>
                <th scope="col">Serial number</th>
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
                <td>{{$item->item_code}}</td>
                <td>{{$item->location_code}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->purchased_date}}</td>
                <td>{{$item->supplier_name}}</td>
                <td>Serial number</td>
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
    {{$items->links()}}

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