@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 d-flex flex-row">
    <a class="btn text-light" href="/home" style="background-color:#660000; height:38px">Leave</a>
        @if(session('items'))
            <div class="alert alert-success alert-dismissible fade show text-center mx-auto" role="alert">
                <strong class="text-center">Items Saved Successfuly!!  </strong>You Can Add Serial Numbers or Leave..
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
  
</div>
            <div class="alert alert-warning alert-dismissible fade show text-center mx-auto mt-3" id="invalid_serial_number" style="display:none" role="alert">
                <strong class="text-center" id="invalid_serial"></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<hr>

<div class="card w-75  item-create mx-auto">
    <h5 class="card-header form-card-header-custom"><strong class="text-light"> Add Serial Numbers</strong></h5>
    <div class="card-body">      

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Serial Code(Optional)</th>
                <th scope="col">Action/Status</th>
            </tr>
                
            
        </thead>
        <tbody id="">
            @if(Session::has('items'))
            @foreach(Session::get('items') as $item)
            <tr>
                <th scope="row">{{$item}}</th>
                        <td><input type="text" class="form-control real_time_input" style="width:200px"  id="{{ str_replace('/', '', $item) }}" placeholder="" >
                             <p  style="display:none; color:red; padding-top:0px; padding-left:0px; font-weight:bold; font-size:12px;"></p>   
                             <spam style="disply:none; color:red; font-size:10px; font-weight:bold" id="{{ str_replace('/', '_', $item) }}" ></spam>
                    </td>
                        <td class="{{ str_replace('/', '', $item) }}"><button class="btn form-card-header-custom text-light submit_serial " id="{{ str_replace('/', '2', $item) }}"  value="{{$item}}"  type="button">Save</button>
                        <span class="badge badge-success"  id="badge" style="display:none; max-width:60px">Success</span>
                    </td>

                        
                    </tr>
            @endforeach 
            @endif    
      
        </tbody> 
</table> 
    </div>
</div>

<script src="{{ asset('js/serial_number.js') }}"> </script>
<script src="{{ asset('js/real_time_validation.js') }}"> </script>
@endsection