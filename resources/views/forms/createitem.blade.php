@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 ">
    
    <a class="btn btn-dark text-light"  href="/home">Back</a>
</div>
<hr>

    <div class="card w-75  item-create">
          <h5 class="card-header form-card-header-custom"><strong class="text-light"> Add Item Form</strong></h5>
    <div class="card-body">
    <form action="{{ route('item.store') }}" method="POST">
    @csrf

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                  <label for="item-name ">Location</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <select class="form-control " id="location" name="Location">
                    <option value="">Select Location</option>
                    @foreach($div as $location)
                    <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                    @endforeach
                    </select>

                    @error('Location')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                   @enderror
                </div>
            </div>
            <div class="col-3">
                <a class="btn btn-warning text-danger form-control"  href="{{route('location.insert')}}" class="button">Add New Location</a>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                  <label for="item-name ">Sub Location</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <select class="form-control " id="subLocation" name="subLocation">
                       <option value = "000">Select Sub Location</option>
                       @foreach($subloc as $subLocation)
                    <option value="{{$subLocation->subLocation_code}}">{{$subLocation->subLocation_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <a class="btn btn-warning text-danger form-control"  href="{{route('sublocation.index')}}" class="button">Add New Sub Location</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="item-name ">Category</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <select class="form-control " id="category" name="category">
                    <option value="">Select Category</option>
                    @foreach($cate as $category)
                    <option value="{{$category->category_code}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>

                    @error('category')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                   @enderror
                </div>
            </div>
            <div class="col-3">
                <a class="btn btn-warning text-danger form-control"  href="{{route('category.index')}}" class="button">Add New Category</a>
            </div>
        </div>


        <div class="form-group row">
           <div class="col-9 row">
             <div class="col-sm-3">
                <label for="item-name ">Sub Category</label>
             </div>
             <div class="col-sm-9">
                <select class="form-control " id="subcategory" name="subCategory">
                <option value = "000">Select Sub Category</option>
                @foreach($subcate as $subcategory)
                    <option value="{{$subcategory->subCategory_code}}">{{$subcategory->subCategory_name}}</option>
                    @endforeach
                </select>
             </div>
           </div>
           <div class="col-3">
                <a class="btn btn-warning text-danger form-control"  href="{{route('subcategory.index')}}" class="button">Add New Sub Category</a>
            </div>
        </div>

        <div class="form-row col-sm-9 pl-0">
            <div class="form-group col-sm-6">
                <label for="quantiy">No. Of Items</label>
                <input type="number" class="form-control" id="noItems" placeholder="" name="Quantity">
                @error('Quantity')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                 @enderror
                <span class="" role="alert">
                    <small style="color:red" id="quantityError"></small>
                </span>
            </div>
            <div class="form-group col-sm-6 ">
                <label for="quantiy">No. Of Sub Items </label>
<<<<<<< HEAD
                <input type="number" class="form-control" value="0" id="exampleInputPassword1" placeholder="" name="sub_item">
=======
                <input type="number" class="form-control" id="NoSub" placeholder="" name="sub_item">
>>>>>>> development
            </div>
        </div>
        <div class=" col-sm-9 row pl-0">
            <div class="col-sm-3">
                <label for="item-name ">Type</label>
            </div>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="types" id="exampleRadios1" value="Asset" checked>
                    <label class="form-check-label" for="exampleRadios1">
                       Asset
                     </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="types" id="exampleRadios2" value="Consumable" checked>
                    <label class="form-check-label" for="exampleRadios2">
                       Consumable
                     </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="item-name ">GRN No.</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <select class="form-control " id="exampleFormControlSelect1" name="grn_no">
                     @foreach($grn as $grns)
                      <option value="{{$grns->GRN_no}}">{{ $grns->GRN_no }}</option>
                     @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">

<<<<<<< HEAD
                

                <a class="btn btn-warning text-danger form-control" href="{{route('grn.index')}}" class="button">Add New GRN</a>
=======
                <a class="btn btn-warning text-danger form-control" href="{{route('grn.index')}}" >Add New GRN</a>
>>>>>>> development

            </div>
        </div>

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="item-name " >Vat/Item (Percentage)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="Vat" id="Vat" class="form-control">
                   @error('Vat')
                        <span class="" role="alert">
                            <small style="color:red" ><strong>{{ $message }}</strong></small>
                        </span>

                 @enderror
                 <span class="" role="alert">
                        <small style="color:red" id="vatError"></small>
                </span>
                </div>
            </div>

        </div>

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="pro">Procurement ID (Optional)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="procument_id" id="procument_id" class="form-control">
                   @error('procument_id')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                    @enderror
                    <span class="" role="alert">
                        <small style="color:red" id="procumentIdError"></small>
                    </span>
                </div>
            </div>

        </div>

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="rate" >Rate(Price/Item)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="Rate" id="Rate" class="form-control">
                   @error('Rate')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>

                    @enderror
                    <span class="" role="alert">
                        <small style="color:red" id="rateError"></small>
                    </span>
                </div>
            </div>

        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong class="text-center">{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
        <div class="text-center">
    
    
    {{ csrf_field() }}
        
        <button type="submit" class="btn form-card-header-custom text-light" type="button" name="action" value="save">Save Item Details</button>
        <button class="btn form-card-header-custom text-light" id="preview" data-target="#itemCodes" type="button">show Item Details</button>
        </div>
    </form>
 
    </div>
    </div>
    
    <div class="container-fluid pt-2 pl-4">
            <div class="modal fade  ml-5" style="top:10%" id="itemCodes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                       <div class="modal-header bg-dark text-white">
                        <h1 class="text-white">Item Codes</h1>
                       </div>
                        <div class="modal-body">
                           <table class="w-100">
                                
       
                           <tboday id="itemCode" class="w-100 p-3">

                            </tboday>

                            <ul id="itemCode" class="w-100 p-3">    
                            </ul>

                           </table>
                        </div>
                        </div>
                    </div>
                </div>
    </div>
    


@endsection
