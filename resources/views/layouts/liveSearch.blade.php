

            <!--Live search  this will be usefull when we add live search -->
            <form class="form-inline my-2 my-lg-0" autocomplete="off" method="POST" action="{{route('search')}}">
                @csrf
                <div class="autocomplete" style="position:relative;">
                    <input class="form-control mr-sm-2" id="searchValue" name="value" type="search" placeholder="Search" aria-label="Search">
                    <ul class="list-group position-relative" id="dynamic-row" style="z-index:100;"></ul>
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0 ml-3" type="submit">Search</button>
            </form>
            <!--Live search end-->


        

