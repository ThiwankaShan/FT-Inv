@extends('layouts.PageLayout')
@section('content')
  <h4 hidden>{{$grand_total=0}} {{$tax_total=0}} {{$gross_total=0}} {{$no=1}}</h4>
  <p hidden> 
      {{ $data['purchased_date'][0] ?? '' }}  {{ $data['purchased_date'][1] ?? '' }}
      {{ $data['created_at'][0] ?? '' }}  {{ $data['created_at'][1] ?? '' }} {{ $data['location_code'] ?? '' }}
  </p>

  <div class="card mt-0 px-0 " id="locationCard">

  <a class="btn mt-2 mr-5 btn-primary align-self-end" href="download">Download</a>

  <h4 class="text-center">Faculty of Technology – Sabaragamuwa University of Sri Lanka</h4>

  @if(isset($data['purchased_date']))
  <h5 class="text-center">Purchases during the Period of : {{ $data['purchased_date'][0] }} - {{ $data['purchased_date'][1] }}</h5>
  @endif

  @if(isset($data['created_at']))
  <h5 class="text-center">Fixed Assets during the Period of : {{ $data['created_at'][0] }} - {{ $data['created_at'][1] }}</h5>
  @endif

  @if(isset($data['created_at_specific']))
  <h5 class="text-center">Fixed Assets Register As At : {{ $data['created_at_specific'] }}</h5>
  @endif

  @if(isset($data['supplier']))
  <h6 class="ml-3 text-left">Supplier Name : {{ $data['supplier'] }}</h6>
  @endif

  @if(isset($data['department']))
  <h6 class="ml-3 text-left">Department : {{ $data['department'] }}</h6>
  @endif

  @if(isset($data['unit']))
  <h6 class="ml-3 text-left">Unit : {{ $data['unit'] }}</h6>
  @endif

  <div class="card-body px-0">
  <div class="container-fluid" id="dataTable">

  @if(isset($data['supplier']))
  <table class="table table-striped table-bordered">
    <thead class="thead text-white" style="background-color:#691330">
      <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col" class="text-center">Asset Code</th>
        <th scope="col" class="text-center">Asset Name</th>
        <th scope="col" class="text-center">GRN No</th>
        <th scope="col" class="text-center">Purchase Order No</th>
        <th scope="col" class="text-center">Purchased date</th>
        <th scope="col" class="text-center">Serial No</th>
        <th scope="col" class="text-center">Model No</th>
        <th scope="col" class="text-center">Brand Name</th>
        <th scope="col" class="text-center">Unit Price</th>
        <th scope="col" class="text-center">Tax</th>
        <th scope="col" class="text-center">Total</th>
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($items as $item)

      <tr id="{{ str_replace('/', '', $item->item_code) }}">
        <td>{{$no}}</td>
        <th scope="row">{{$item->item_code}}</th>
        <td>{{$item->subCategory->subCategory_name}}</td>
        <td>{{$item->GRN_number}}</td>
        <td>{{$item->procurement_id}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->serial_number}}</td>
        <td>{{$item->model_number}}</td>
        <td >{{$item->brandName}}</td>
        <td class="text-right">{{ number_format($item->gross_price,2)}}</td>
        <td class="text-right">{{ number_format($item->tax,2) }}</td>
        <td class="text-right">{{ number_format($item->net_price,2) }}</td>

        <h4 hidden>{{$grand_total += $item->net_price }}</h4>
        <h4 hidden>{{$tax_total += $item->tax }}</h4>
        <h4 hidden>{{$gross_total += $item->gross_price}}</h4>
        <h4 hidden>{{$no += 1}}</h4>
      </tr>
      @endforeach
      <tr>
      <td colspan="9">Grand Total</td>
      <td class="text-right">{{ number_format($gross_total,2)}}</td>
      <td class="text-right">{{ number_format($tax_total,2)}}</td>
      <td class="text-right">{{ number_format($grand_total,2)}}</td>
      </tr>

    </tbody>
  </table>
  @else

  <table class="table table-striped table-bordered">
    <thead class="thead text-white" style="background-color:#691330">
      <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col" class="text-center">Asset Code</th>
        <th scope="col" class="text-center">Location</th>
        <th scope="col" class="text-center">Type</th>
        <th scope="col" class="text-center">GRN No</th>
        <th scope="col" class="text-center">Purchased date</th>
        <th scope="col" class="text-center">Supplier</th>
        <th scope="col" class="text-center">Serial No</th>
        <th scope="col" class="text-center">Model No</th>
        <th scope="col" class="text-center">Brand Name</th>
        <th scope="col" class="text-center">Rate</th>
        <th scope="col" class="text-center">Tax</th>
        <th scope="col" class="text-center">Total</th>
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($items as $item)

      <tr id="{{ str_replace('/', '', $item->item_code) }}">
        <td>{{$no}}</td>
        <th scope="row">{{$item->item_code}}</th>
        <td>{{$item->location_code}}</td>
        <td>{{$item->type}}</td>
        <td>{{$item->GRN_number}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->GRN->supplier->supplier_name}}</td>
        <td>{{$item->serial_number}}</td>
        <td>{{$item->model_number}}</td>
        <td >{{$item->brandName}}</td>
        <td class="text-right">{{ number_format($item->gross_price,2)}}</td>
        <td class="text-right">{{ number_format($item->tax,2) }}</td>
        <td class="text-right">{{ number_format($item->net_price,2) }}</td>

        <h4 hidden>{{$no += 1}}</h4>
        <h4 hidden>{{$grand_total += $item->net_price }}</h4>
        <h4 hidden>{{$tax_total += $item->tax }}</h4>
        <h4 hidden>{{$gross_total += $item->gross_price}}</h4>
      </tr>
      @endforeach
      <tr>
      <td colspan="10">Grand Total</td>
      <td class="text-right">{{ number_format($gross_total,2)}}</td>
      <td class="text-right">{{ number_format($tax_total,2)}}</td>
      <td class="text-right">{{ number_format($grand_total,2)}}</td>
      </tr>

    </tbody>
  </table>
  @endif


</div>

<div >
  </div>
  
</div>

<script src="{{ asset('js/delete.js') }}"></script>
<script src="{{ asset('js/filter_sort.js') }}"> </script>
@endsection