@extends('layouts.PageLayout')
@section('content')

<div class="card mt-0 px-0 " id="">

<div class="card-body px-0">
  @include('tables.grn_table')
</div>

</div>

<script src="{{ asset('js/delete.js') }}"></script>
<script src="{{ asset('js/filter_sort.js') }}"> </script>

@endsection