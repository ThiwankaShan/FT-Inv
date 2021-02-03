<div class="container" id="location_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('category.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table table-striped table-bordered table-hover" id="Table">
      <thead>
        <tr>
          <th scope="col">Category Code</th>
          <th scope="col">Category Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($categories as $category)
        <tr id="{{ str_pad($category->category_code,'3',0, STR_PAD_LEFT ) }}">
          <td scope="row">{{ str_pad($category->category_code,'3',0, STR_PAD_LEFT ) }}</td>
          <td>{{$category->category_name}}</td>
          <td class="">
            @if(auth()->user()->role == 'admin')

            <a class="btn btn-primary text-light highlight_row" href="{{ route('category.edit', $category->category_code) }}">Edit</a>
            <a class="btn btn-danger delete-item text-light"  href="category/delete/{{ $category->category_code }}" data-method="POST" token='{!! csrf_token() !!}'>Delete</a>
           

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