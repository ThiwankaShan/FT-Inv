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