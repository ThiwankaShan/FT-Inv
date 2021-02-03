
@extends('layouts.PageLayout')
@section('content')

  <div class="card mr-1 p-1" id="itemsCard" style="min-width: 1500px !important; ">

  <div class="card-header mr-1 p-1" style="min-width: 1250px;" >
      <h1 class="text-dark text-center font-weight-bold">Disposed Data</h1>
  </div>

  <div class="card-body p-1" style="min-width: 1250px;" id="items_table">
     @include('tables.disposed_table')
  </div>
  
</div>

<script src="{{ asset('js/restore.js') }}"></script>
@endsection
