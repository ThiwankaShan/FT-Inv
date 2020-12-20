@include('layouts.app')
<body>

    <div id="app">
        @include('layouts.navbar')
        @include('layouts.sidebar')

        <div class="content pr-0">
            @yield('content')
        </div>
    </div>

    

</body>

</html>