 <!-- Page Content  -->
 <div  class="content-fluid">
<nav class="navbar navbar-expand navbar-dark shadow-sm fixed-top" >
    <div class="container-fluid ">
    <button type="button" id="sidebarCollapse" class="btn btn-custom">
    <i class="fa fa-bars" id="sideBar-icon"></i>
                        <span></span>
                    </button>


        <h4><a class="text-center nounderline" href="{{ url('/') }}">
            <strong class="text-light ">Inventory Managment System</strong>
        </a></h4>

            <div>
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

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
</nav>
</div>
<script>
    $(document).ready(function () {

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
});

});
</script>
