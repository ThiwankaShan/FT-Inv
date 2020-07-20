@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid">
 <button class="btn btn-danger mr-3">Delete Items</button>
 <button class="btn btn-info mr-3">View Logs</button>
 <a class="btn btn-warning" href="{{ route('item.create') }}">Create Items</a>
</div>
<hr>

@endsection
