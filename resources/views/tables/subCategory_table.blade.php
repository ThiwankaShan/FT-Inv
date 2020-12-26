<div class="container" id="subLocation_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('subcategory.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table table-striped table-bordered table-hover" id="subLocationTable">
      <thead>
        <tr>
        <th scope="col">Sub Category Code</th>
          <th scope="col">Sub Category Name</th>
          <th scope="col">Category Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($subCategories as $subCategory)
        @if($subCategory->category_code != -1)
        <tr>
          <td scope="row">{{$subCategory->subCategory_code}}</td>
          <td>{{$subCategory->subCategory_name}}</td>
          <td>{{$subCategory->category->category_name ?? 'Deleted'}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="/subCategory/edit/{{ $subCategory->subCategory_code }}/{{$subCategory->category_code }}">Edit</a>
            <a class="btn btn-danger delete-item text-light"  href="/subCategory/delete/{{ $subCategory->subCategory_code }}/{{ $subCategory->category_code }}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>
           

            @elseif(auth()->user()->role == 'manager')
            <a class="btn btn-primary text-light" href="">Edit</a>
            @endif
          </td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>