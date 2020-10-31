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
    <script type="text/javascript" src="{{ asset('js/tofilter.js') }}"> </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- selecting  filter js file -->
    </div>


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
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top">
            <div class="container-fluid">

                <button class="navbar-toggler ml-2" type="button" id="side_bar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand text-center " href="{{ url('/') }}">
                    <strong class="text-light mr-5 pr-5">FT-IMS</strong>
                </a>



                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <div class="wrapper d-flex">
        <div class="sideMenu">
            <div class="sideBar">
                <img src="/images/default.jpg" alt="profile image" class="pimage ml-5 mt-4 mb-2" style="width:100px; height:100px; border-radius:50%; transition: linear .5s;">

                <h3 class="ml-5 text-white  mb-2 userName">{{Auth::user()->name}}</h3>
                <hr>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="/" class="nav-link sideBarLink "><i class="fa fa-home mx-2 sideBar-icon" aria-hidden="true"></i><span class="textLink ml-1">Home</span></a></li>
                    <li class="nav-item"><a href="/home" class="nav-link sideBarLink "><i class="fa fa-tachometer mx-2 sideBar-icon" aria-hidden="true"></i><span class="textLink ml-1">Dashbord</span></a></li>
                    <!-- <li class="nav-item"><a href="#" class="nav-link sideBarLink "><i class="fa fa-user mx-2" aria-hidden="true"></i><span class="textLink ml-1">Profile</span></a></li> -->
                    <li class="nav-item"><a href="{{route('item.create')}}" role="button" class="nav-link sideBarLink "><i class="fa fa-sitemap mx-2 sideBar-icon" aria-hidden="true"></i><span class="textLink ml-1">Create Items</span></a></li>
                    <li class="nav-item"><a href="{{ route('supplier.create') }}" role="button" class="nav-link sideBarLink "><i class="fa fa-suitcase mx-2 sideBar-icon" aria-hidden="true"></i><span class="textLink ml-1">Suppliers</span></a></li>
                    <!-- <li class="nav-item"><a href="#" class="nav-link sideBarLink "><i class="fa fa-cogs mx-2" aria-hidden="true"></i><span class="textLink ml-1">Settings</span></a></li> -->
                    <li class="nav-item"><a class="nav-link sideBarLink  text-light" type="button" id="toggleButton"><i class="fa fa-arrows-alt mx-2 sideBar-icon" aria-hidden="true"></i><span class="textLink ml-1">Resize</span></a></li>
                </ul>


            </div>
        </div>

        <div class="content ">
            <main class="bord pt-4">
                <div class="container-fluid pl-0  main-body  ">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!--Live search -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
