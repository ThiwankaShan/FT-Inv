@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid">
 <button class="btn btn-danger mr-3">Request Delete Items</button>
 <button class="btn btn-info">Request new items</button>
 <a class="btn btn-warning" href="{{ route('item.create') }}">Create Items</a>
</div>
<hr>
<div class="container-fluid">

</div>
@endsection
