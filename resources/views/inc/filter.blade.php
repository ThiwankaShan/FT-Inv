
<div class="card">
        <div class="card-header ">
             <div class="row ">

                    <form action="" class="mr-3">
                            <select class="form-control selector " id="division" name="dividion" data-column="0">
                            <option value="">Select Division</option>
                             @foreach($div as $division)
                                 <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                             @endforeach
                            </select>

                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control selector " id="subDivision" name="subDivision" data-column="1">
                                <option value="">Select Sub Division</option>

                            </select>
                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control selector " id="category" name="category" data-column="2">
                                <option value="">Select Category</option>
                                @foreach($cate as $category)
                                 <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control selector " id="subCategory" name="subCategory" data-column="3">
                                <option value="000" >Select Sub Category</option>

                            </select>
                        </form>
                        <button class="btn btn-outline-success ml-4" id="filter" type='button'>Filter</button>
<!--
                        <div class="offset-2 ">
                            <form class="form-inline float-right">
                                <input class="form-control selector mr-sm-2" type="search" placeholder="Search Items" aria-label="Search">
                                <input class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</input>
                            </form>
                        </div> -->
                        <div class="offset-2 ">
                        <form class="form-inline float-right ml-5 " id="form-search" autocomplete="off" method="POST" action="{{route('search')}}">
                @csrf
                <div class="autocomplete " style="position:relative;">
                <input class="form-control mr-sm-2" id="searchValue" name="value" type="search" placeholder="Search" aria-label="Search">
                <ul class="list-group position-fixed" id="dynamic-row"  style="z-index:100;"></ul>
                </div>
                <input class="btn btn-outline-light  my-2 my-sm-0 " id="search_button"  type="submit" value="search"></input>
                </form>

                </div>
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
                           @isset($data)

                    @foreach($data as $item)
                    <tr id="search-items" class="search-highligh-custom">
                        <td >{{$item['item_id']}}</td>
                        <td >{{$item['item_name']}}</td>
                        <td>{{$item['item_code']}}</td>
                        <td><a href="#" class="btn btn-success">Update</a></td>
                    </tr>
                    @endforeach
                    @endisset
                              @foreach($items as $item)
                                 <tr id="main-body">
                                    <td>{{$item->item_id}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->item_code}}</td>
                                    <td><a href="#" class="btn btn-success">Update</a></td>
                                 </tr>
                              @endforeach


                           </tbody>

                        </table>
                      {{ csrf_field() }}
              </div>
              <div class="card-footer">

                {{$items->links()}}

              </div>


</div>



@include('inc.filterJS')





