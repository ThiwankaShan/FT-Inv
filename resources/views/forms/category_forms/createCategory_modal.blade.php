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

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="category_name_error">
                           <small style="color:red"><strong id="category_name_msg"></strong></small>
                        </span>
 
                    </div>
                    <div class="form-group form-custom">
                        <label for="exampleInputEmail1">Category Code</label>
                        <input type="text" class="form-control" id="category_id" name="category_code" aria-describedby="emailHelp">

                        <span class="" role="alert" style="display:none; margin-bottom:5px" id="category_code_error">
                           <small style="color:red"><strong id="category_code_msg"></strong></small>
                        </span>


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
