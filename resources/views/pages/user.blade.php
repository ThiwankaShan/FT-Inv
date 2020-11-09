@extends('layouts.PageLayout')
@section('content')

<!-- include the  filter part and search part from codeRepeats/searchVew -->
@include('pages.searchView');

<script src="{{ asset('js/filter.js') }}"> </script>

@endsection
