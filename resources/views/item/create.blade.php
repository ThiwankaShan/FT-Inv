

@extends('layouts.PageLayout')
@section('content')

<div class="container">
    <div class="card">
          <h1 class="card-header bg-primary"><strong class="text-light"> Add Item Form</strong></h1>
    <div class="card-body">
    <form action="{{ route('item.store') }}" method="POST">
    @csrf
        <div class="form-group ">
            <label for="item-name ">Division</label>
            <select class="form-control " id="exampleFormControlSelect1" name="division">
            @foreach($div as $division)
             <option value="{{$division->d_id}}">{{$division->d_name}}</option>
            @endforeach           
            </select>
            
        </div>

        <div class="form-group ">
            <label for="item-name ">Sub Division</label>
            <select class="form-control " id="exampleFormControlSelect1" name="subdivision">
            @foreach($subdiv as $subdivision)
             <option value="{{$subdivision->sd_id}}">{{$subdivision->sd_name}}</option>
            @endforeach           
            </select>
            
        </div>
        <div class="form-group ">
            <label for="item-name ">Category</label>
            <select class="form-control " id="exampleFormControlSelect1" name="category">
            @foreach($cate as $category)
             <option value="{{$category->c_id}}">{{$category->c_name}}</option>
            @endforeach           
            </select>
            
        </div>

        <div class="form-group ">
            <label for="item-name ">Sub Category</label>
            <select class="form-control " id="exampleFormControlSelect1" name="subcategory">
            <option value="000">None</option>
            @foreach($subcate as $subcategory)
             <option value="{{$subcategory->sc_id}}">{{$subcategory->sc_name}}</option>
            @endforeach           
            </select>
            
        </div>

        <div class="form-group">
            <label for="quantiy">Quantity</label>
            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="quantity">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>

</div>

@endsection