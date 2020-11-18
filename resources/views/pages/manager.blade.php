@extends('layouts.PageLayout')
@section('content')


@include('pages.searchView');

  

<script src="{{ asset('js/filter_sort.js') }}"> </script>
@endsection

