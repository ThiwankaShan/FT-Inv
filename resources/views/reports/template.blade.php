<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="{{public_path('css/report.css')}}">
</head>

<body>

  <h4 id="title">Faculty of Technology – Sabaragamuwa University of Sri Lanka</h4>

  @if(isset($data['purchased_date']))
  <h5 id="subTitle">Purchases during the Period of : {{ $data['purchased_date'][0] }} - {{ $data['purchased_date'][1] }}
  </h5>
  @endif

  @if(isset($data['created_at_specific']))
  <h5 id="subTitle">Fixed Assets Register As At : {{ $data['created_at_specific'] }}</h5>
  @endif

  @if(isset($data['created_at']))
  <h5 id="subTitle">Fixed Assets during the Period of : {{ $data['created_at'][0] }} - {{ $data['created_at'][1] }}</h5>
  @endif

  @if(isset($data['supplier']))
  <h6 id="heading">Supplier Name : {{ $data['supplier'] }}</h6>
  @endif

  @if(isset($data['department']))
  <h6 id="heading">Department : {{ $data['department'] }}</h6>
  @endif

  @if(isset($data['unit']))
  <h6 id="heading">Unit : {{ $data['unit'] }}</h6>
  @endif

  @if(isset($data['supplier']))
  <table>
    <thead>
      <tr>
        <th scope="col">Asset Code</th>
        <th scope="col">Asset Name</th>
        <th scope="col">GRN No</th>
        <th scope="col">Purchase Order No</th>
        <th scope="col">Purchased date</th>
        <th scope="col">Serial No</th>
        <th scope="col">Model No</th>
        <th scope="col">Brand Name</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Tax</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($items as $item)
      <tr>
      <th scope="row" id="itemCode">{{$item->item_code}}</th>
      <td>{{$item->subCategory->subCategory_name}}</td>
      <td>{{$item->GRN_number}}</td>
      <td>{{$item->procurement_id}}</td>
      <td>{{$item->purchased_date}}</td>
      <td>{{$item->serial_number}}</td>
      <td>{{$item->model_number}}</td>
      <td>{{$item->brandName}}</td>
      <td id="price" >{{ number_format($item->gross_price,2)}}</td>
      <td id="price" >{{ number_format($item->tax,2) }}</td>
      <td id="price" >{{ number_format($item->net_price,2) }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="8">Grand Total</td>
        <td id="price">{{ number_format($gross_total,2)}}</td>
        <td id="price">{{ number_format($tax_total,2)}}</td>
        <td id="price">{{ number_format($grand_total,2)}}</td>
      </tr>

    </tbody>
  </table>
  @else

  <table>
    <thead>
      <tr>
        <th scope="col">Asset Code</th>
        <th scope="col">Location</th>
        <th scope="col">Type</th>
        <th scope="col">GRN No</th>
        <th scope="col">Purchased date</th>
        <th scope="col">Supplier</th>
        <th scope="col">Serial No</th>
        <th scope="col">Model No</th>
        <th scope="col">Brand Name</th>
        <th scope="col">Rate</th>
        <th scope="col">Tax</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody id="dataBody">
      
      @foreach($items as $item)
      <tr>
      <th scope="row" id="itemCode">{{$item->item_code}}</th>
      <td>{{$item->location_code}}</td>
      <td>{{$item->type}}</td>
      <td>{{$item->GRN_number}}</td>
      <td>{{$item->purchased_date}}</td>
      <td>{{$item->GRN->supplier->supplier_name}}</td>
      <td>{{$item->serial_number}}</td>
      <td>{{$item->model_number}}</td>
      <td>{{$item->brandName}}</td>
      <td id="price">{{ number_format($item->gross_price,2) }}</td>
      <td id="price">{{ number_format($item->tax,2) }}</td>
      <td id="price">{{ number_format($item->net_price,2) }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="9">Grand Total</td>
        <td id="price">{{ number_format($gross_total,2) }}</td>
        <td id="price">{{ number_format($tax_total,2) }}</td>
        <td id="price">{{ number_format($grand_total,2) }}</td>
      </tr>

    </tbody>
  </table>
  @endif

</body>

</html>