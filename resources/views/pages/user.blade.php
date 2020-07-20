@extends('layouts.PageLayout')
@section('content')

<div class="container-fluid">

 <a class="btn btn-warning" href="{{ route('item.create') }}">Create Items</a>
 
</div>
<hr>
<div class="container-fluid">
@include('inc.filter')
</div>
@endsection
