<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/6a3acfdd48.js"></script>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet">



</head>

<body>


    <input type="checkbox" id="check">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top" style="height:70px;">
            <div class="container-fluid">

                <button class="navbar-toggler ml-2" type="button" id="side_bar" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <label for="check" style="margin-top:-25px;">
                    <i class="fa fa-bars" id="sidebar_btn"></i>
                </label>

                <a class="navbar-brand text-center " href="{{ url('/') }}">
                    <strong class="text-light mr-5 pr-5">FT-IMS</strong>
                </a>



                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <div class=" mr-5">


                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
        </nav>
    </div>

    <div class="sidebar">
        <div class="profile_info">
            <img src="/images/default.jpg" class="profile_image" alt="">
            <h4>{{Auth::user()->name}}</h4>
        </div>
        <a href="/"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="/home"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
        <a href="{{route('item.create')}}"><i class="fa fa-sitemap"></i><span>Create Items</span></a>
        <a href="{{ route('supplier.create') }}"><i class="fa fa-suitcase"></i><span>Suppliers</span></a>
        <a href="{{ route('reports.create') }}"><i class="fa fa-suitcase"></i><span>Reports</span></a>



    </div>
    <!--sidebar end-->

    <div class="content pr-0">
        <main class="bord ">
            <div class="container-fluid pl-0  main-body  ">
                @yield('content')
            </div>
        </main>
    </div>



    <!--Live search -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
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
    <!--Live search end -->


    <!--item code -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
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

    <!--item code end -->








</body>

</html>