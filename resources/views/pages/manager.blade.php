@extends('layouts.PageLayout')
@section('content')


<hr>
<div class="container-fluid">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Locaton Code</th>
                <th scope="col">Sub Location Code</th>
                <th scope="col">Category Code</th>
                <th scope="col">Sub Category Code</th>
                <th scope="col">Type</th>
                <th scope="col">GRN No</th>
                <th scope="col">Vat</th>
                <th scope="col">Vat Rate</th>
                <th scope="col">Procurement Id</th>
                <th scope="col">Rate</th>

            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <th scope="row">{{$item->item_code}}</th>
                <td>{{$item->location_code}}</td>
                <td>{{$item->subLocation_code}}</td>
                <td>{{$item->category_code}}</td>
                <td>{{$item->subCategory_code}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->GRN_no}}</td>
                <td>{{$item->vat}}</td>
                <td>{{$item->vat_rate_vat}}</td>
                <td>{{$item->procurement_id}}</td>
                <td>{{$item->rate}}</td>
                <td>
                    <form action="{{ route('item.destroy',$item->item_code) }}" class=" form-align-custom" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" btn btn-danger text-light">Delete</button>

                    </form>

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    @if (session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
    @endif
    {{$items->links()}}

</div>
@endsection
