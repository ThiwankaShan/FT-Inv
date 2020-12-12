<!doctype html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/6a3acfdd48.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="height:70px;">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                    <div class="container-fluid pt-2 ">
                        <a class="btn btn-dark text-light" href="/home">Back</a>
                    </div>
        

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

    <div class="card mt-0 px-0" id="con">
        <div class="card-header ">
            
            <div class="row ">
                <div class="col-sm-10 d-flex flex-row">

                <h6 style="font-size:14px; font-weight:bold" class="mt-2 mr-2">Filter by</h6>

                    <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4 bg-light mr-2"
                        style="outline:0px; width:200px; font-weight:bold; border:none; " id="location" data-column="0">

                        <option value=""> Location</option>
                        @foreach($locations as $location)
                        <option value="{{$location->location_code}}">{{$location->location_name}}</option>
                        @endforeach
                    </select>

                    <select class="form-control selector mr-2 mb-1 diseble2 diseble3 diseble4 bg-light mr-2"
                        style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="sublocation"
                        data-column="1">
                        <option value="">Sub Location</option>

                    </select>

                    <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4 bg-light mr-2"
                        style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="category" data-column="2">
                        <option value=""> Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->category_code}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>

                    <select class="form-control selector mr-2 mb-1 diseble1 diseble3 diseble4 bg-light mr-2"
                        style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="subCategory"
                        data-column="3">

                        <option value="" class="default_option"> Sub Category</option>
                        <option value="000" class="default_option"> 000</option>
                    </select>

                    <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble4 bg-light mr-2"
                        style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="Type" data-column="4">
                        <option value=""> Type</option>
                        <option value="Asset">Asset</option>
                        <option value="Consumable">Consumable</option>

                    </select>

                    <select class="form-control selector mr-2 mb-1 diseble1 diseble2 diseble3 bg-light mr-3"
                        style=" font-weight:bold; border:none; background-color:#f2f2f2 " id="ProID" data-column="5">
                        <option value=""> Procurement ID</option>
                        @foreach($proId as $pId)
                        <option value="{{$pId->procurement_id}}">{{$pId->procurement_id}}</option>
                        @endforeach
                    </select>
                    
                    <label for="item-name ">Purchase date start</label>
                    <input type="date" class="form-control" id='purchased_start' name="purchased_date" id="purchased_date" value="{{ old('purchased_date') }}"> 
                
                    <label for="item-name ">Purchase date end</label>
                    <input type="date" class="form-control" id='purchased_end' name="purchased_date" id="purchased_date" value="{{ old('purchased_date') }}"> 
</div></div>
<hr>
                    <div class="row ">
                    <div class="col-sm-3 d-flex flex-row">
                    <h6 style="font-size:14px; font-weight:bold" class="mt-2 mr-2">Sort by</h6>

                    <select class="form-control selector mr-2 mb-1 text-dark" id="column"
                        style="outline:0px; width:150px; border-color:#C21E56; border:none;" data-column="0">
                        <option value="location_code">Location</option>
                        <option value="type">Type</option>
                        <option value="purchased_date">Purchased date</option>
                        <option value="supplier_name">Supplier name</option>
                        <option value="GRN_no">GRN number</option>
                        <option value="procurement_id">Procurement ID</option>
                        <option value="created_at">Created time</option>
                    </select>


                    <select class="form-control selector mr-2 mb-1 text-dark" id="order"
                        style="outline:0px; width:150px; border-color:#C21E56; border:none;">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>

                </div>
                
            </div>
            <hr>
                <form>
                <div class="row justify-content-center">
                    <div class="col-sm-3 d-flex">
                        <button class="btn btn btn-primary ml-auto" id="viewReport" type='button'>Generate</button>
                        <button class="btn btn btn-primary ml-auto" id="filter1" type='submit'>Reset</button>
                        <a class="btn btn btn-primary ml-auto" href="/reports/download" type='button'>Download</a>

                        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}">    
                    </div>
                </div>
                </form>
        </div>

        <!-- here is the table  -->

        <div class="card-body px-0">
            <div class="container-fluid" id="dataTable">
                <table class="table">
                <h4 style="text-align:center">Faculty of Technology – Sabaragamuwa University of Sri Lanka <br>Fixed Assets <span id = 'date'>as of {{ date('Y-m-d') }}</span>.</h4>
                <h5 id="department"></h5>    
                <thead class="thead text-white" style="background-color:#691330">
                        <tr>
                            <th scope="col">Item Code</th>
                            <th scope="col">Asset Name</th>
                            <th scope="col">Location Code</th>
                            <th scope="col">Type</th>
                            <th scope="col">Purchased date</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Serial number</th>
                            <th scope="col">Model No</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        
                       
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <!-- This is a warnnig that if did not select Location -->
    <button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subLoca"
        id="alertLocation">Small modal</button>
    <div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="subLoca">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header " style="background-color:#ffb3b3">
                    <h2 class="text-center">Error!</h2>
                </div>
                <div class="modal-body">
                    <p><strong>You Must Select Location First</strong> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- This is a warnnig that if did not select Category -->
    <button type="button" class="btn btn-primary" data-toggle="modal" style="display:none;" data-target="#subCate"
        id="alertCategory">Small modal</button>
    <div class="modal fade bd-example-modal-sm mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="subCate">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header " style="background-color:#ffb3b3">
                    <h2 class="text-center">Error!</h2>
                </div>
                <div class="modal-body">
                    <p><strong> You Must Select Category First</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/filter_sort.js') }}"> </script>
    
</body>
</html>