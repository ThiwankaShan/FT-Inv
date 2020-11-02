@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid pt-2 ">

    <a class="btn btn-dark text-light" href="/home">Back</a>
</div>
<hr>

<div class="card w-75  item-create">
    <h5 class="card-header form-card-header-custom"><strong class="text-light"> Update Item Form</strong></h5>
    <div class="card-body">

        <form action="/item/update/{{$item->item_code}}" method="POST">
            @csrf

            <div class=" col-sm-9 row pl-0">
                <div class="col-sm-3">
                    <label for="item-name ">Type</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios1" value="Asset" {!! $item->type=='Asset'?"checked":'' !!}>
                        <label class="form-check-label" for="exampleRadios1">
                            Asset
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="types" id="exampleRadios2" value="Consumable" {!! $item->type=='Consumable'?"checked":'' !!}>
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



                    <a class="btn button-style form-control" href="{{route('grn.index')}}" class="button">Add New GRN</a>

                </div>
            </div>

            <div class="form-group row">
                <div class="col-9 row">
                    <div class="col-sm-3">
                        <label for="item-name ">Vat/Item (Percentage)</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="Vat" id="Vat" class="form-control" value="{{$item->vat_rate_vat}}">
                        @error('Vat')
                        <span class="" role="alert">
                            <small style="color:red"><strong>{{ $message }}</strong></small>
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
                        <input type="text" name="procument_id" id="procument_id" class="form-control" value="{{$item->procurement_id}}">
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
                        <label for="rate">Rate(Price/Item)</label>
                    </div>
                    <div class="col-sm-9 mb-1">
                        <input type="text" name="Rate" id="Rate" class="form-control" value="{{$item->rate}}">
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

                <button type="submit" class="btn form-card-header-custom text-light" type="button" name="action" value="save">Update Item Details</button>
               
            </div>
        </form>

    </div>
</div>

@endsection
