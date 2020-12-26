<div class="container" id="supplier_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('supplier.create') }}" >Create</a>
  </div>

  <div class="row mt-4">
    <table class="table table-striped table-bordered table-hover" id="supplierTable">
      <thead>
        <tr>
        <th scope="col">Supplier Code</th>
          <th scope="col">Supplier Name</th>
          <th scope="col">Supplier Address</th>
          <th scope="col">Telephone Number</th>
          <th scope="col">Email</th>
          <th scope="col">Vat Registration Number</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($suppliers as $supplier)
        <tr id="{{$supplier->supplier_code}}">
          <td scope="row">{{ str_pad( $supplier->supplier_code,'3',0, STR_PAD_LEFT )}}</td>
          <td>{{$supplier->supplier_name}}</td>
          <td>{{$supplier->supplier_address}}</td>
          <td>{{$supplier->telephone_number}}</td>
          <td>{{$supplier->email}}</td>
          <td>{{$supplier->vat_register_no}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="/supplier/edit/{{$supplier->supplier_code}}">Edit</a>
            <a class="btn btn-danger delete-item text-light"  href="/supplier/delete/{{$supplier->supplier_code}}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>
           

            @elseif(auth()->user()->role == 'manager')
            <a class="btn btn-primary text-light" href="/supplier/edit/{{$supplier->supplier_code}}">Edit</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@if(Session::has('updated_crud_row'))
<input type="hidden" name="" id="highlighted_row_crud" value="{{ Session::get('updated_crud_row') }}">

@endif