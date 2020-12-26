<div class="sidebar">

    <a href="/"><i class="fa fa-lg fa-home"></i><span class="collapse" id="side_bar">Home</span></a>
    <a href="/home"><i class="fa fa-lg fa-tachometer"></i><span class="collapse" id="side_bar">Dashboard</span></a>
    <a href="{{route('item.create')}}"><i class="fa fa-lg fa-sitemap"></i><span class="collapse" id="side_bar">Create
            Items</span></a>

    <a href="{{ route('reports.create') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse"
            id="side_bar">Reports</span></a>

    <div class="dropdown">
        <a class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fa fa-lg fa-suitcase m-0 p-0 pl-1"></i>
            <span class="collapse cursor-pointer" id="side_bar">Inventory</span>
        </a>

        <div class="side-dropdown dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a href="{{ route('supplier.index') }}"><i class="fa fa-lg fa-address-card"></i><span class="collapse"
                    id="side_bar">Suppliers</span></a>
            <a href="{{ route('location.index') }}"><i class="fa fa-lg fa-map-marker"></i><span class="collapse"
                    id="side_bar">Locations</span></a>
            <a href="{{ route('subLocation.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse"
                    id="side_bar">Sub Locations</span></a>
            <a href="{{ route('category.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse"
                    id="side_bar">Category</span></a>
            <a href="{{ route('subcategory.index') }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse"
                    id="side_bar">Sub Category</span></a>
            <a href="{{ route('grn.show',1) }}"><i class="fa fa-lg fa-suitcase"></i><span class="collapse"
                    id="side_bar">GRN</span></a>
        </div>

    </div>


</div>