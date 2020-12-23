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


                                <span class="" role="alert" style="display:none; margin-bottom:5px" id="subCategory_name_error">
                                    <small style="color:red"><strong id="subCategory_name_msg"></strong></small>
                                </span>

                            </div>
                            <div class="form-group form-custom">
                                <label for="subLocarion_code">Sub Category Code</label>
                                <input type="text" class="form-control" name="subCategory_code" id="subCategory_code">

                                <span class="" role="alert" style="display:none; margin-bottom:5px" id="subCategory_code_error">
                                    <small style="color:red"><strong id="subCategory_code_msg"></strong></small>
                                </span>

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