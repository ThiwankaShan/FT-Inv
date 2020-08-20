
<div class="card">
        <div class="card-header pr-0">
             <div class="row align-items-center">

                        <!--Live search -->
                            <form class="form-inline my-2 my-lg-0" autocomplete="off" method="POST" action="{{route('search')}}">
                            @csrf
                            <div class="autocomplete" style="position:relative;">
                                <input class="form-control mr-sm-2" id="searchValue" name="value" type="search" placeholder="Search" aria-label="Search">
                                <ul class="list-group position-relative" id="dynamic-row"  style="z-index:100;"></ul>
                            </div>
                                 <button class="btn btn-outline-success my-2 my-sm-0 ml-3" type="submit">Search</button>
                            </form>
                        <!--Live search end-->


             </div>

        </div>

            <div class="card-body">
            <table class="table" id="itemtable">

                        <thead>
                            <tr>
                            <th >Item Number</th>
                            <th >Item Code</th>
                            <th >Item Name</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                           <tbody id="dataBody">
                              @foreach($items as $item)
                                 <tr>
                                    <td>{{$item->item_id}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->item_code}}</td>
                                    <td><a href="" class="btn btn-success">Update</a></td>
                                 </tr>
                              @endforeach

                              @isset($data)
                              @foreach($data as $item)
                                 <tr>
                                    <td>{{$item['item_id']}}</td>
                                    <td>{{$item['item_name']}}</td>
                                    <td>{{$item['item_code']}}</td>
                                 </tr>
                              @endforeach
                              @endisset
                           </tbody>

                        </table>
                        {{ csrf_field() }}
              </div>
              <div class="card-footer">

                {{$items->links()}}

              </div>


</div>

@include('layouts.filterJS')





