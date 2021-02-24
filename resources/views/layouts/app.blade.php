<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventory Managment System</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://use.fontawesome.com/6a3acfdd48.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    
    <!-- Custom js scripts -->
    <script src="{{ asset('js/filter_sort.js') }}"> </script>
    <script src="{{ asset('js/ui.js') }}"> </script>
    

    <!--Live search configs-->

    <script>
        var config = {
            routes: {
                liveSearch: "{{ route('liveSearch')}}"
            },
            tokens: {
                token: "{{ csrf_token()}}"
            }
        };
    </script>
    <script src="{{ asset('js/liveSearch.js') }}"> </script>

    <!--item code config-->
    <script>
        var config = {
            routes: {
                itemStore: "{{ route('item.store')}}"
            },
            tokens: {
                token: "{{ csrf_token()}}"
            }
        };
    </script>
    <script src="{{ asset('js/itemCodes.js') }}"> </script>
    <script src="{{ asset('js/todelete.js') }}"> </script>
    

</head>

