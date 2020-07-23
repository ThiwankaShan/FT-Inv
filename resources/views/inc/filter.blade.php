
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
                        <button class="btn btn-outline-success" id="filter" type='button'>Filter</button>
                   
                        <div class="offset-2 ">
                            <form class="form-inline float-right">
                                <input class="form-control selector mr-sm-2" type="search" placeholder="Search Items" aria-label="Search">
                                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
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
                              @foreach($items as $item)
                                 <tr>
                                    <td>{{$item->item_id}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->item_code}}</td>
                                    <td><a href="" class="btn btn-success">Update</a></td>
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




<script>
                $(document).ready(function () {
                    var _token=$('input[name="_token"]').val();
                       $('#division').change(function() {

                           var div_id=$(this).val();   
                           var form=$(this).parent();
                           var op='';     
                           $.ajax({
                               
                               url:"{{ route('ajax.getSubdivision') }}",
                               method:"POST",
                               data:{
                                   divisionid:div_id,
                                   _token:_token,
                                },
                               success:function(data){
                                
                                 op+='<option value="" selected disabled>Select Sub Division</option>';
                                 for(var i=0;i<data.length;i++){
                                    op+='<option value="'+data[i].subDivision_id+'" >'+data[i].subDivision_name+'</option>';
                                      }
                                         $('#subDivision').html('');
                                         $('#subDivision').append(op);                      
                               },
                               error:function(){

                               }
                           });

                       })  

                       //get the related subcategory
                       $('#category').change(function() {

                           var cate_id=$(this).val();   
                           var a=$(this).parent();
                           var op='';     
                           $.ajax({
                               
                               url:"{{ route('ajax.getSubcategory') }}",
                               type:"POST",
                               data:{
                                   categoryid:cate_id,
                                   _token:_token
                                },
                               success:function(data){
                                
                                 op+='<option value="000" >Select Sub Category</option>';
                                 for(var i=0;i<data.length;i++){
                                    op+='<option value="'+data[i].subCategory_id+'" >'+data[i].subCategory_name+'</option>';
                                      }
                                         $('#subCategory').html('');
                                         $('#subCategory').append(op);                      
                               },
                               error:function(){

                               }
                           });

                       })  

                       //FILTER DATA    
                       
                       function fetchData(division ="",subdivision="",category="",subcategory=""){
                        
                         var _token=$('input[name="_token"]').val();
                           $.ajax({
                              
                               url:"{{route('ajax.filter')}}",
                               method:"POST",  
                                                    
                               data:{
                                 _token:_token,
                                  div:division,
                                  subdiv:subdivision,
                                  cate:category,
                                  subcate:subcategory

                               },
                               success:function(data){
                                  var output="";
                                  
                                  for(var i=0;i<data.length;i++){
                                    output+='<tr>';
                                    output+='<td>'+data[i].item_id+'</td>';
                                    output+='<td>'+data[i].item_name+'</td>';
                                    output+='<td>'+data[i].item_code+'</td>';
                                    output+='<td><a href="" class="btn btn-success">Update</a></td>';
                                    output+='</tr>';
                                  }
                                  
                                  $('#dataBody').html("");
                                  $('#dataBody').append(output);

                               },
                               error:function(){

                               }   

                           })

                       }

                       //function call
                       $('#filter').click(function(){
                           var div_id=$('#division').val();
                           var subdiv_id=$('#subDivision').val();
                           var cate_id=$('#category').val();
                           var subcate_id=$('#subCategory').val();
                            console.log(subcate_id);
                           if(div_id !="" && subdiv_id !="" && cate_id !=""){
                            fetchData(div_id,subdiv_id,cate_id,subcate_id);
                           }else{
                               alert('All Selections Should Be!');
                           }

                       });

                       
                    
                 })

            

</script>



   