<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
      @media (min-width: 1500px) {


}
.report-table table tr
{
    font-size: 15px;
    padding: 20px;
}

.report-table table tr td
{
    padding: 5px;
}

.report-table table tr th{
    padding: 10px;
    border-bottom: 2px black solid;
    text-align: center;
}

    </style>
</head>


<body>
<div class="report-table container-fluid">

<h4 style="text-align:center">Faculty of Technology – Sabaragamuwa University of Sri Lanka <br>Fixed Assets Register As At {{ date('Y-m-d') }}.</h4>

<table border="1px" cellpadding="15px" cellspacing="10px">
  <thead class="thead-dark">
    <tr class="bg-info" >
        <th scope="col">Item Code</th>
        <th scope="col">Location Code</th>
        <th scope="col">Type</th>
        <th scope="col">Purchased date</th>
        <th scope="col">Supplier name</th>
        <th scope="col">Serial number</th>
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
        <td scope="row">{{$item->item_code}}</td>
        <td>{{$item->location_code}}</td>
        <td>{{$item->type}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->supplier_name}}</td>
        <td>{{$item->serialNumber}}</td>
        <td>{{$item->GRN_no}}</td>
        <td>{{$item->vat}}</td>
        <td>{{$item->vat_rate_vat}}</td>
        <td>{{$item->procurement_id}}</td>
        <td>{{$item->rate}}</td>
    </tr>
    @endforeach
    <tr>
        <td scope="row"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Grand total</td>
        <td>{{ $grandTotal}}</td>
    </tr>

  </tbody>
</table>
</div>
</body>
</html>
