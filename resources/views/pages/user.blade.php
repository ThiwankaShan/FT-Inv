@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid">

 <a class="btn btn-warning" href="{{ route('item.create') }}">Create Items</a>
    

 <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Code</th>
    </tr>
  </thead>
  <tbody>
  @isset($data)
  @foreach($data as $item)
    <tr>
      <td>{{$item['item_id']}}</td>
      <td>{{$item['item_name']}}</td>
      <td>{{$item['item_code']}}</td>
    </tr> 
    @endforeach
  @endisset
  </tbody>
</table>
</div>
<hr>

@endsection
