
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">

                <strong>IMS</strong>
            </div>
            <ul class="list-unstyled components">
                <!-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>

                    </a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Pages
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li> -->
                <li class="active">
            <a href="/"><i class="fa fa-lg fa-home"></i><span  >Home</span></a>
        </li>
        <li>
            <a href="/home"><i class="fa fa-lg fa-tachometer"></i><span  >Dashboard</span></a>
        </li>
        <li>
            <a href="{{route('item.create')}}"><i class="fa fa-lg fa-sitemap"></i><span  >Create
                    Items</span></a>

        </li>
        <li>
            <a href="{{ route('reports.create') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Reports</span></a>

        </li>

        <li>
            <a href="{{ route('dispose.index') }}"><i class="fa fa-lg fa-suitcase"></i><span >Bin</span></a>
        </li>
        <li >
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-lg fa-suitcase"></i><span >Inventory</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                    <a href="{{ route('supplier.index') }}"><i class="fa fa-lg fa-address-card"></i><span  >Suppliers</span></a>
                </li>
                <li>
                    <a href="{{ route('location.index') }}"><i class="fa fa-lg fa-map-marker"></i><span  >Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('subLocation.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Sub Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Category</span></a>
                </li>
                <li>
                    <a href="{{ route('subcategory.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Sub Category</span></a>
                </li>
                <li>
                    <a href="{{ route('grn.show',1) }}"><i class="fa fa-lg fa-suitcase"></i><span  >GRN</span></a>
                </li>
                    </ul>
                </li>
            </ul>


        </nav>
<!-- <div class="sidebar" >
 <div >
    <ul class="list-unstyled components" id="side_bar">
        <li>
            <a href="/"><i class="fa fa-lg fa-home"></i><span  >Home</span></a>
        </li>
        <li>
            <a href="/home"><i class="fa fa-lg fa-tachometer"></i><span  >Dashboard</span></a>
        </li>
        <li>
            <a href="{{route('item.create')}}"><i class="fa fa-lg fa-sitemap"></i><span  >Create
                    Items</span></a>

        </li>
        <li>
            <a href="{{ route('reports.create') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Reports</span></a>

        </li>

        <li>
            <a href="{{ route('dispose.index') }}"><i class="fa fa-lg fa-suitcase"></i><span >Bin</span></a>
        </li>



        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="side_bar">
                <i class="fa fa-lg fa-suitcase"></i><span >Inventory</span>
            </a>

            </li>
    </ul>
            <ul class="collapse list-unstyled custom-menue " id="pageSubmenu" class="collapse">
                <li>
                    <a href="{{ route('supplier.index') }}"><i class="fa fa-lg fa-address-card"></i><span  >Suppliers</span></a>
                </li>
                <li>
                    <a href="{{ route('location.index') }}"><i class="fa fa-lg fa-map-marker"></i><span  >Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('subLocation.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Sub Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Category</span></a>
                </li>
                <li>
                    <a href="{{ route('subcategory.index') }}"><i class="fa fa-lg fa-suitcase"></i><span  >Sub Category</span></a>
                </li>
                <li>
                    <a href="{{ route('grn.show',1) }}"><i class="fa fa-lg fa-suitcase"></i><span  >GRN</span></a>
                </li>

            </ul>





</div>
</div>

 -->
