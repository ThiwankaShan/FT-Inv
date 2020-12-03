<!-- Here is Add new Location Form -->
<div class="modal fade bd-example-modal-lg" style="top:15%"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_Location" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">

        <div class="card w-100  item-create mb-0">

            <h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Location</strong></h5>
            <div class="card-body">

                <div class="alert alert-success text-center" role="alert" style="display:none" id="validLocation">
                    <strong>New Location Created Successfully!!</strong>
                </div>

                <div class="alert alert-danger print-error-msg " id="invalid_location" style="display:none">
                    <ul ></ul>
                </div>

                <form method="" action="" class="form-align-custom" id="Location_form">

                    <label for="location_code">Location Name</label>
                    <input type="text" class="form-control form-custom" id="location_name">
                    @error('location_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="location_name">Location Code</label>
                    <input type="text" class="form-control form-custom" id="location_code">
                    @error('location_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="text-center ">
                        <button type="button" class="btn btn-primary form-card-header-custom text-light mt-4 " id="saveLocation">Create</button>
                        <button class="btn btn-secondary cancel_modal text-light  mt-4 mr-5" type="button" >Cancel</button>
                    </div>

                 </form>
               </div>

            </div>
        </div>
    </div>
  </div>
</div>

<!-- Here is Add new Sub Location Form -->
<div class="modal fade bd-example-modal-lg" style="top:15%"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_subLocation" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">

        <div class="card w-100  item-create mb-0">
        <h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Sub Location</strong></h5>
            <div class="card-body">

                <div class="alert alert-success text-center" role="alert" style="display:none" id="validSubLocation">
                        <strong>New Sub Location Created Successfully!!</strong>
                 </div>

                <div class="alert alert-danger  " id="invalidSubLocation" style="display:none">
                    <ul ></ul>
                </div>

                <form action=" " class="form-align-custom" method="POST" id="subLocation_form">
                    <div class="form-group">

                        <label for="item-name ">Location</label>
                        <select class="form-control form-custom" id="selectedLoaction" name="Location_code">
                                @foreach($locations as $location)
                                    <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                                @endforeach
                        </select>

                    </div>
                    <div class="form-group  form-custom">
                        <label for="subLocation_name">Sub Location Name</label>

                        <input type="text" class="form-control form-custom" id="subLocation_name" name="subLocation_name">

                    </div>

                    <div class="form-group ">
                        <label for="subLocarion_code ">Sub Location Code</label>
                        <input type="text" class="form-control form-custom" name="subLocation_code"  id ="subLocation_code" aria-describedby="emailHelp">
                        @error('subLocation_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class=" text-center">
                        <button type="button" class="btn form-card-header-custom text-light" id="saveSubLocation">Create</button>
                        <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Here is Add new category Form -->
<div class="modal fade bd-example-modal-lg" style="top:15%"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_category" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">

    <div class='card w-100  item-create mb-0'>

            <h5 class="form-card-header-custom text-white p-3">Add New Category</h5>
            <div class="card-body">

                  <div class="alert alert-success text-center" role="alert" style="display:none" id="valid_category">
                        <strong>New Category Created Successfully!!</strong>
                 </div>

                <div class="alert alert-danger  " id="invalid_category" style="display:none">
                    <ul ></ul>
                </div>

                <form action="" class="form-align-custom"  id="category_form">
                   @csrf
                    <div class="form-group form-custom">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name">

                    </div>
                    <div class="form-group form-custom">
                        <label for="exampleInputEmail1">Category Code</label>
                        <input type="text" class="form-control" id="category_id" name="category_code" aria-describedby="emailHelp">
                        @error('category_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="text-center">
                        <button type="button" class="btn form-card-header-custom text-light" id="saveCategory">Create</button>
                        <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                    </div>
                </form>
            </div>
            </div>

    </div>
  </div>
</div>


<!-- Here is Add new sub category Form -->
<div class="modal fade bd-example-modal-lg" style="top:15%"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_subCategory" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">

                <div class="card w-100  item-create mb-0">

                    <h5 class="form-card-header-custom text-white p-3"><strong class="text-light">Add New Sub Category</strong></h5>
                    <div class="card-body">

                        <div class="alert alert-success text-center" role="alert" style="display:none" id="valid_subCategory">
                                <strong>New Sub Category Created Successfully!!</strong>
                        </div>

                        <div class="alert alert-danger  " id="invalid_subCategory" style="display:none">
                            <ul ></ul>
                        </div>

                        <form  class=" form-align-custom" id="subCategory_form">
                            @csrf

                            <div class="form-group ">
                                <label for="item-name ">Categories</label>
                                <select class="form-control form-custom" id="categoryID" name="Category_code">
                                    @foreach($categories as $category)
                                       <option value="{{$category->category_code}}">{{$category->category_name}}</option>
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
                                <input type="text" class="form-control" name="subCategory_code" id="subCategory_code">


                            </div>


                            <div class="text-center">
                                <button  class="btn form-card-header-custom text-light " id="save_subCategory" type="button">Create</button>
                                <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                            </div>
                    </form>
                </div>
            </div>


    </div>
  </div>
</div>

<!-- Here is Add new GRN Form -->
<div class="modal fade bd-example-modal-lg" style="top:40px"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="Add_new_GRN" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">

            <div class='card w-100  item-create mb-0'>
            <h5 class="form-card-header-custom text-white p-3">Add New GRN</h5>

            <div class="card-body">

                         <div class="alert alert-success text-center" role="alert" style="display:none" id="valid_grn">
                                <strong>New GRN Created Successfully!!</strong>
                        </div>

                        <div class="alert alert-danger  " id="invalid_grn" style="display:none">
                            <ul ></ul>
                        </div>

                <form  class="form-align-custom" id="Grn_form">
                    @csrf

                    <div class="form-group form-custom">
                        <label for="GRN_no">GRN No.</label>
                        <input type="text" class="form-control form-custom" id="GRN_no" name="GRN_no" value="{{$suggest_grnNo}}">

                    </div>

                    <div class="form-group form-custom">
                        <label for="GRN_date">GRN Date</label>
                        <input type="date" class="form-control" name="GRN_date" id="GRN_date">

                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" class="form-control" id="invoice_no" name="invoice_no">


                    </div>

                    <div class="form-group form-custom">
                        <label for="invoice_date">Invoice Date.</label>
                        <input type="date" class="form-control" id="invoice_date" name="invoice_date">



                        <div class="form-group form-custom">
                            <label for="supplier_code">Supplier</label>
                            <select class="form-control" id="supplier_name" name="supplier_code">
                                @foreach($Suppliers as $Supplier)

                                <option value="{{$Supplier->supplier_code}}" class="form-custom">{{$Supplier->supplier_name}}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="text-center">
                            <button type="button" class="btn form-card-header-custom text-light" id="save_GRN">Create</button>
                            <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                        </div>

                </form>
            </div>
        </div>


    </div>
  </div>
</div>
