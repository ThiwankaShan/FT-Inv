<div class="card">
        <div class="card-header ">
             <div class="row ">
               
                    <form action="" class="mr-3">
                            <select class="form-control " id="exampleFormControlSelect1" name="subdivision">
                            <option value="">Select The Division...</option>
                             @foreach($div as $division)
                                 <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                             @endforeach
                            </select>
                            
                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control " id="exampleFormControlSelect1" name="subdivision">
                                <option value="">Select The Sub Division...</option>  
                                @foreach($subdiv as $subdivision)
                                 <option value="{{$subdivision->subDivision_id}}">{{$subdivision->subDivision_name}}</option>
                                @endforeach
                            </select>
                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control " id="exampleFormControlSelect1" name="subdivision">
                                <option value="">Select The Category...</option>  
                                @foreach($cate as $category)
                                 <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </form>

                        <form action="" class="mr-3">
                            <select class="form-control " id="exampleFormControlSelect1" name="subdivision">
                                <option value="" hide>Select The Sub category...</option>  
                                @foreach($subcate as $subcategory)
                                 <option value="{{$subcategory->subCategory_id}}">{{$subcategory->subcategory_name}}</option>
                                @endforeach   
                            </select>
                        </form>

                   
                        <div class="offset-2 ">
                            <form class="form-inline float-right">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search Items" aria-label="Search">
                                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                
                
             </div>
             
        </div>
        <div class="card-body">
        <table class="table">
  
            <thead>
                <tr>
                <th scope="col">Item Number</th>
                <th scope="col">Item Code</th>
                <th scope="col">Item Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
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
        </div>
</div>