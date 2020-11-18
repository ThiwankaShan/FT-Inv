<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    
      
    <!--************ This Css file Dashbord Design********** -->
    <link rel="stylesheet" href="{{asset('dashboard/dist/css/adminlte.min.css')}}">
   

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

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand  navbar-light fixed-top  " style="background-color: #691330;">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
    </ul> 


    <!-- Right navbar links -->
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
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-center">
      <span class="brand-text text-center " style="font-weight: bold;">FT-INV</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3  d-flex">
        <div class="image">
          <img src="/images/default.jpg" class="img-circle elevation-2" >

        </div>
        <div class="info ">
          <h4 class="d-block text-light py-0"> {{ Auth::user()->name }}</h4>
          <p class="text-light">({{Auth::user()->role}})</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item"><a href="/" class="nav-link"> <i class="nav-icon fa fa-home"></i><p>  Home</p> </a></li>
          <li class="nav-item "> <a href="/home" class="nav-link "> <i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a></li>   
          <li class="nav-item"> <a href="{{route('item.create')}}" class="nav-link "><i class="nav-icon fa fa-sitemap"></i> <p> Create Items </p> </a></li>    
          <li class="nav-item"><a href="{{ route('supplier.create') }}" class="nav-link "><i class="nav-icon fa fa-suitcase"></i><p> Suppliers</p></a></li> 
          <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon fa fa-copy"></i><p> Main <i class="fa fa-angle-left right"></i></p></a>
                <ul class="nav nav-treeview ml-5">
                    <li class="nav-item"> <a href="" class="nav-link"> <p>Location</p></a> </li>
                    <li class="nav-item"><a href="" class="nav-link"> <p>Sub Location</p></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><p>Category</p></a> </li>
                    <li class="nav-item"><a href="" class="nav-link"> <p>Sub Category</p></a> </li>
                    
                </ul>
           </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content mt-5">
       @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


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



<!--*********** jQuery For dashBord***************** -->
<script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>

<!--************** dashbord  js **********-->
<script src="{{asset('dashboard/dist/js/adminlte.js')}}"></script>


</body>
</html>
