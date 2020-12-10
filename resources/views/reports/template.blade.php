<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Styles -->
    <link rel="stylesheet" href="{{public_path('css/report.css')}}">
</head>

<body>
    <div class="report-table container-fluid">

        @if ($start =='' and $end =='')
        <h4 style="text-align:center">Faculty of Technology – Sabaragamuwa University of Sri Lanka <br>Fixed Assets
            Register As At {{ date('Y-m-d') }}.</h4>

        @elseif($start==$end)
        <h4 style="text-align:center">Faculty of Technology – Sabaragamuwa University of Sri Lanka <br>Fixed Assets
            Purchased on {{$start}}.</h4>
        
        @else
        <h4 style="text-align:center">Faculty of Technology – Sabaragamuwa University of Sri Lanka <br>Fixed Assets
        Purchased during the Period of {{$start}} - {{$end}}.</h4>
        @endif

        <h6>{{$department}}</h6>
        <table class='table'>
            <thead class="thead ">
                <tr class="bg-info">
                    <th scope="col">Item Code</th>
                    <th scope="col">Asset Name</th>
                    <th scope="col">Location Code</th>
                    <th scope="col">Type</th>
                    <th scope="col">Purchased date</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Serial number</th>
                    <th scope="col">Model No</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Tax</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td scope="row">{{$item->item_code}}</td>
                    <td>asset name</td>
                    <td>{{$item->location_code}}</td>
                    <td>{{$item->type}}</td>
                    <td>{{$item->purchased_date}}</td>
                    <td>{{$item->supplier_name}}</td>
                    <td>{{$item->serialNumber}}</td>
                    <td>model no</td>
                    <td>brand name</td>
                    <td>{{$item->rate}}</td>
                    <td>tax</td>
                    <td>Total</td>
                </tr>
                @endforeach
                <tr>
                    <td scope="row"></td>
                    <td colspan="9">Grand total</td>
                    <td>{{ $grandTotal}}</td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>