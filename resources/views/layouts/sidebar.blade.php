<div class="sidebar">
    <ul class="list-unstyled components">
        <li>
            <a href="/"><i class="fa fa-lg fa-home"></i><span class="collapse" id="side_bar">Home</span></a>
        </li>
        <li>
            <a href="/home"><i class="fa fa-lg fa-tachometer"></i><span class="collapse" id="side_bar">Dashboard</span></a>
        </li>
        <li>
            <a href="{{route('item.create')}}"><i class="fa fa-lg fa-sitemap"></i><span class="collapse" id="side_bar">Create
                    Items</span></a>

        </li>
        <li>
            <a href="{{ route('reports.create') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">Reports</span></a>

        </li>


        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">Inventory</span>
            </a>
            <ul class="collapse list-unstyled custom-menue" id="pageSubmenu">
                <li>
                    <a href="{{ route('supplier.index') }}"><i class="fa fa-lg fa-address-card"></i><span class="collapse" id="side_bar">Suppliers</span></a>
                </li>
                <li>
                    <a href="{{ route('location.index') }}"><i class="fa fa-lg fa-map-marker"></i><span class="collapse" id="side_bar">Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('subLocation.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">Sub Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">Category</span></a>
                </li>
                <li>
                    <a href="{{ route('subcategory.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">Sub Category</span></a>
                </li>
                <li>
                    <a href="{{ route('grn.show',1) }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse" id="side_bar">GRN</span></a>
                </li>
            </ul>
        </li>


    </ul>
</div>
