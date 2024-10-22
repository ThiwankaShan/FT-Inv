<div class="container-fluid" id="dataTable">
  <table class="table table-striped table-bordered table-hover">
    <thead class="thead text-white" style="background-color:#691330">
      <tr class="text-center">
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
        <th scope="col">Deleted At</th>

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <th scope="col" class="text-center">Action</th>
        @endif
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($disposed_items as $item)

      <tr id="{{ str_replace('/', '', $item->item_code) }}">
        <th scope="row">{{$item->item_code}}</th>
        <td>{{$item->locations->location_code ?? 'Deleted'}}</td>
        <td>{{$item->type}}</td>
        <td>{{$item->GRN_number}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->GRN->supplier->supplier_name ?? 'Deleted'}}</td>
        <td>{{$item->serial_number}}</td>
        <td>{{$item->model_number}}</td>
        <td>{{$item->brandName}}</td>
        <td class="text-right">{{number_format($item->gross_price,2)}}</td>
        <td class="text-right">{{number_format($item->tax,2)}}</td>
        <td class="text-right">{{number_format($item->net_price,2)}}</td>
        <td class="text-right">{{$item->deleted_at}}</td>
        <td class="">
          @if(auth()->user()->role == 'admin')

          <a id="actionButton" class="btn btn-primary mr-1 text-light highlight_row restore_item" href="{{ route('dispose.restore',$item->item_code) }}">Restore</a>
         
          @endif
        </td>


      </tr>
      @endforeach

    </tbody>
  </table>


</div>

<div >