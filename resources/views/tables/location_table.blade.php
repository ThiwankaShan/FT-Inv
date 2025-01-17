<div class="container" id="location_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('location.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table table-striped table-bordered table-hover" id="Table">
      <thead>
        <tr>
          <th scope="col">Location Code</th>
          <th scope="col">Location Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($locations as $location)
        <tr id="{{$location->location_code}}">
          <td scope="row">{{$location->location_code}}</td>
          <td>{{$location->location_name}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="/location/edit/{{$location->location_code}}">Edit</a>
            <a class="btn btn-danger not-disposal-delete-item text-light"  href="/location/delete/{{$location->location_code}}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>

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
