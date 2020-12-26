
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
                    <div class="form-group ">
                        <label for="subLocation_name">Sub Location Name</label>
                        <input type="text" class="form-control form-custom" id="subLocation_name" name="subLocation_name"  placeholder="Enter Sub Location Name">

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="subLocation_name_error">
                            <small style="color:red"><strong id="subLocation_name_msg"></strong></small>
                        </span>

                    </div>

                    <div class="form-group ">
                        <label for="subLocarion_code ">Sub Location Code</label>
                        <input type="text" class="form-control form-custom" name="subLocation_code"  id ="subLocation_code" aria-describedby="emailHelp" placeholder="Enter Sub Location Code">
                        <span id="live_subLocation_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>
                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="subLocation_code_error">
                            <small style="color:red"><strong id="subLocation_code_msg"></strong></small>
                        </span>

                    </div>


                    <div class=" text-center row justify-content-center">
                        <button type="button" class="btn form-card-header-custom text-light mr-2 " id="saveSubLocation">Create</button>
                        <button class="btn btn-secondary cancel_modal text-light  " type="button" >Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>