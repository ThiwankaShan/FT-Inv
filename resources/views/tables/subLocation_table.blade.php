<div class="container" id="subLocation_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('subLocation.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table table-striped table-bordered table-hover" id="subLocationTable">
      <thead>
        <tr>
        <th scope="col">Sub Location Code</th>
          <th scope="col">Sub Location Name</th>
          <th scope="col">Location Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($subLocations as $subLocation)
        <tr id="{{ str_pad( $subLocation->subLocation_code,'3',0, STR_PAD_LEFT )}}-{{$subLocation->location_code}}">
          <td scope="row">{{ str_pad( $subLocation->subLocation_code,'3',0, STR_PAD_LEFT )}}</td>
          <td>{{$subLocation->subLocation_name}}</td>
          <td>{{$subLocation->locations->location_name ?? 'Deleted'}}</td>
          <td class="d-flex flex-row justify-content-center">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row mr-1" href="/subLocation/edit/{{$subLocation->subLocation_code}}/{{$subLocation->location_code}}">Edit</a>
            <a class="btn btn-danger not-disposal-delete-item text-light"  href="/subLocation/delete/{{$subLocation->subLocation_code}}/{{$subLocation->location_code}}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>


            @elseif(auth()->user()->role == 'manager')
            <a class="btn btn-primary text-light" href="/subLocation/edit/{{$subLocation->subLocation_code}}/{{$subLocation->location_code}}">Edit</a>
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
