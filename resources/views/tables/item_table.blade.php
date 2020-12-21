<!-- here is the filter form -->


<div class="container-fluid" id="dataTable">
  <table class="table">
    <thead class="thead text-white" style="background-color:#691330">
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

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <th scope="col" class="text-center">Action</th>
        @endif
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($items as $item)

      <tr id="{{ str_replace('/', '', $item->item_code) }}">
        <th scope="row">{{$item->item_code}}</th>
        <td>{{$item->location_code}}</td>
        <td>{{$item->type}}</td>
        <td>{{$item->GRN_number}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->supplier_name}}</td>
        <td>{{$item->serial_number}}</td>
        <td>{{$item->model_number}}</td>
        <td>{{$item->brandName}}</td>
        <td>{{$item->gross_price}}</td>
        <td>{{$item->tax}}</td>
        <td>{{$item->net_price}}</td>

        <td class="d-flex flex-row">
          @if(auth()->user()->role == 'admin')

          <a class="btn btn-primary mr-1 text-light highlight_row" href="/item/edit/{{$item->item_code}}">Edit</a>
          <a href="/item/delete/{{$item->item_code}}" data-method="post" class="btn btn-danger delete-item text-light"
            token='{!! csrf_token() !!}'>Delete</a>

          @elseif(auth()->user()->role == 'manager')
          <a class="btn btn-primary mr-1 text-light" href="/item/edit/{{$item->item_code}}">Edit</a>
          @endif
        </td>


      </tr>
      @endforeach

    </tbody>
  </table>


</div>

<div >