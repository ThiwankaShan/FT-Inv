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

                    <label for="location_name">Location Name</label>
                    <input type="text" class="form-control form-custom" id="location_name">
                    
                    <span class="" role="alert" style="display:none; margin-bottom:5px" id="location_name_error">
                        <small style="color:red"><strong id="location_name_msg"></strong></small>
                    </span>
                   
                    <label for="location_name">Location Code</label>
                    <input type="text" class="form-control form-custom" id="location_code">
                    <span id="live_location_code" style="disply:none; color:red; font-size:10px; font-weight:bold"></span>

                    <span class="" role="alert" style="display:none; margin-bottom:5px" id="location_code_error">
                            <small style="color:red"><strong id="location_code_msg"></strong></small>
                    </span>

                    <div class="text-center row justify-content-center">
                        <button type="button" class="btn btn-primary form-card-header-custom text-light mt-4 mr-2" id="saveLocation">Create</button>
                        <button class="btn btn-secondary cancel_modal text-light  mt-4 mr-5" type="button" >Cancel</button>
                    </div>

                 </form>
               </div>

            </div>
        </div>
    </div>
  </div>
</div>
