

@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2">
    <button class="btn btn-danger mr-3">Delete Items</button>
    <button class="btn btn-info mr-3">View Logs</button>
    <a class="btn btn-warning" href="/home">Back</a>
</div>
<hr>

    <div class="card w-75  item-create">
          <h1 class="card-header bg-primary"><strong class="text-light"> Add Item Form</strong></h1>
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
                    @foreach($div as $location)
                    <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-outline-success" type="button">Add New Location</button>
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
                    </select>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-outline-success" type="button">Add New Sub Location</button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="item-name ">Category</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <select class="form-control " id="category" name="category">
                    
                    @foreach($cate as $category)
                    <option value="{{$category->category_code}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-outline-success" type="button">Add New Category</button>
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
                   
                    </select>
             </div>   
           </div>
           <div class="col-3">
                <button class="btn btn-outline-success" type="button">Add New Sub Category</button>
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
            </div>
            <div class="form-group col-sm-6 ">
                <label for="quantiy">No. Of Sub Items </label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="sub_item">
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
                <button class="btn btn-outline-success" type="button">Add New GRN</button>
            </div>
        </div> 

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="item-name " >Vat/Item (Percentage)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="Vat" id="item-name " class="form-control">
                   @error('Vat')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>
                    
                 @enderror
                </div>
            </div>
           
        </div> 

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="pro">Procurement ID (Optional)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="procument_id" id="pro" class="form-control">
                   @error('procument_id')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>
                    
                    @enderror
                </div>
            </div>
           
        </div> 

        <div class="form-group row">
            <div class="col-9 row">
                <div class="col-sm-3">
                   <label for="rate" >Rate(Price/Item)</label>
                </div>
                <div class="col-sm-9 mb-1">
                   <input type="text" name="Rate" id="rate" class="form-control">
                   @error('Rate')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
                        </span>
                    
                    @enderror
                </div>
            </div>
           
        </div> 

        <button  class="btn btn-outline-success" id="preview" data-toggle="modal" data-target="#itemCodes" type="button">Display List of Item Codes Created</button>
        <button type="submit" class="btn btn-outline-success" type="button">Save Item Details</button>

    </form>
    {{ csrf_field() }}
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
                           </table>
                        </div>
                        </div>
                    </div>
                </div>
    </div>


@endsection
