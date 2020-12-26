@extends('layouts.PageLayout')
@section('content')

  <div class="card mr-1 p-1" id="itemsCard" style="min-width: 1500px !important; ">

  <div class="card-header mr-1 p-1" style="min-width: 1250px;" >
    @include('tables.filter_sort')
  </div>

  <div class="card-body p-1" style="min-width: 1250px;" id="items_table">
    @include('tables.item_table')
  </div>
  
</div>

<script src="{{ asset('js/delete.js') }}"></script>
<script src="{{ asset('js/filter_sort.js') }}"> </script>
@endsection
