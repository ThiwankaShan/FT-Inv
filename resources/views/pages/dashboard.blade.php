@extends('layouts.PageLayout')
@section('content')

  <div class="card mt-0 px-0" id="con">

  <div class="card-header ">
    @include('tables.filter_sort')
  </div>

  <div class="card-body px-0" id="items_table">
    @include('tables.item_table')
  </div>
  
</div>

<script src="{{ asset('js/delete.js') }}"></script>
<script src="{{ asset('js/filter_sort.js') }}"> </script>
@endsection
