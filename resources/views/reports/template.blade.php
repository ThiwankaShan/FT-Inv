<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="utf-8">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
      @media (min-width: 1500px) {
  .Section1 {
    max-width: 1500px;
  }
}
    </style>
</head>
</head>
<body>
<div class="Section1">
<table class="table">
  <thead class="thead-dark">
    <tr>
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
    <th scope="row">{{$item->item_code}}</th>
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
  </tbody>
</table>
</div>
</body>
</html>