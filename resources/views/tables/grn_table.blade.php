<div class="container" id="grn_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('grn.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table" id="subLocationTable">
      <thead>
        <tr>
          <th scope="col">GRN Number</th>
          <th scope="col">GRN Date</th>
          <th scope="col">Invoice Number</th>
          <th scope="col">Invoice Date</th>
          <th scope="col">Supplier Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($grns as $grn)
        <tr id="{{ $grn->GRN_number }}">
          <td scope="row">{{$grn->GRN_number}}</td>
          <td>{{$grn->GRN_date}}</td>
          <td>{{$grn->invoice_number}}</td>
          <td>{{$grn->invoice_date}}</td>
          <td>{{$grn->supplier->supplier_name}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="{{ route('grn.edit',$grn->GRN_number) }}">Edit</a>
            <a class="btn btn-danger delete-item text-light"  href="{{ route('grn.delete', $grn->GRN_number) }}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>
           
            @elseif(auth()->user()->role == 'manager')
            <a class="btn btn-primary text-light" href="">Edit</a>
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