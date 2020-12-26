<div class="container" id="location_container">
  <div class="row justify-content-md-center">
    <a class="btn btn-primary text-light" href="{{ route('category.create') }}">Create</a>
  </div>

  <div class="row mt-4">
    <table class="table" id="Table">
      <thead>
        <tr>
          <th scope="col">Category Code</th>
          <th scope="col">Category Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="location_data">
        @foreach($categories as $category)
        <tr>
          <td scope="row">{{$category->category_code}}</td>
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