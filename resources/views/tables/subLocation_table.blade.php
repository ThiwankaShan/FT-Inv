<div class="container" id="subLocation_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('subLocation.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table" id="subLocationTable">
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
        <tr>
          <td scope="row">{{$subLocation->subLocation_code}}</td>
          <td>{{$subLocation->subLocation_name}}</td>
          <td>{{$subLocation->locations->location_name ?? 'Deleted'}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="/subLocation/edit/{{$subLocation->subLocation_code}}/{{$subLocation->location_code}}">Edit</a>
            <a class="btn btn-danger delete-item text-light"  href="/subLocation/delete/{{$subLocation->subLocation_code}}/{{$subLocation->location_code}}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>
           

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