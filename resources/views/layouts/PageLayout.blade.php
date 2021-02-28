@include('layouts.app')
<body>

    <div id="app" class="wrapper">
    @include('layouts.sidebar')
        @include('layouts.navbar')
        <div class="content-fluid w-100 content-body">
            @yield('content')
        </div>
    </div>



</body>


