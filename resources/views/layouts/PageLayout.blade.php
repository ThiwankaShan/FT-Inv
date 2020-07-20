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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success  shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand text-center " href="{{ url('/') }}">
                    <strong class="text-dark mr-5 pr-5">FT-Inv</strong>
                </a>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id='searchValue' type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Search</button>
                </form>
               <h1 class="text-center text-light" style="font-weight:900;">{{ Auth::user()->name}} Page</h1>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <div class=" mr-5">
 <div class="btn-group">
  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Division
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Division 1</a>
    <a class="dropdown-item" href="#">Division 2</a>
    <a class="dropdown-item" href="#">Division 3</a>
    <a class="dropdown-item" href="#">Division 4</a>
  </div>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sub-Division
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Sub-Division 1</a>
    <a class="dropdown-item" href="#">Sub-Division 2</a>
    <a class="dropdown-item" href="#">Sub-Division 3</a>
    <a class="dropdown-item" href="#">Sub-Division 4</a>
  </div>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Category
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Category 1</a>
    <a class="dropdown-item" href="#">Category 2</a>
    <a class="dropdown-item" href="#">Category 3</a>
    <a class="dropdown-item" href="#">Category 4</a>
  </div>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sub-Category
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Sub-Category 1</a>
    <a class="dropdown-item" href="#">Sub-Category 2</a>
    <a class="dropdown-item" href="#">Sub-Category 3</a>
    <a class="dropdown-item" href="#">Sub-Category 4</a>
  </div>
</div>
</div>

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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
        <main class="py-4">
            @yield('content') 
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
<script type="text/javascript">
  $('body').on('keyup','#searchValue',function(){
            var searchQuerry= $(this).val();
            console.log(searchQuerry);
            $.ajax({
            method:'POST',
            url:'{{ route("search")}}',
            dataType:'json',
            data:{
                '_token':'{{ csrf_token()}}',
                searchQuerry:searchQuerry,
            },
            success:function(res){
                console.log(res);
            }
        });

    });

       
</script>
    </div>
</body>
</html>

