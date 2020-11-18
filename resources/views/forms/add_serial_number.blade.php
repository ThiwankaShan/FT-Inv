@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 ">
    <a class="btn btn-dark text-light" href="/home">Cancel</a>
</div>
<hr>

<div class="card w-75  item-create mx-auto">
    <h5 class="card-header form-card-header-custom"><strong class="text-light"> Add Item Form</strong></h5>
    <div class="card-body">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Serial Code(Optional)</th>
                <th scope="col">Action</th>
            </tr>
                
            
        </thead>
        <tbody id="">
            @foreach($items as $item)
            <tr>
                <th scope="row">{{$item}}</th>
                        <td><input type="text" class="form-control" style="width:200px"  id="{{$item}}" placeholder="" ></td>
                        <td><button class="btn form-card-header-custom text-light"   type="button">Save</button></td>
                        
                    </tr>
            @endforeach        
        </tbody> 
</table> 
    </div>
</div>
@endsection