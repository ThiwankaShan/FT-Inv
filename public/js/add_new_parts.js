$(document).ready(function(){
  
//    *******************ADD NEW LOCATION PART STRAT**********************************************************************************

    //if alertboxes display because last Location inserting, they will not appear from tis function
   $('#buttonCreateLocation').click(function(){
       $("#location_name_error").css('display','none');
       $('#location_code_error').css('display',"none");
       $('#location_name').removeClass("has_error");
       $('#location_code').removeClass("has_error");
       $('#validLocation').css('display',"none");
   })


    //Here is the Function that send Ajax Request to Cerate Location controller to Save Records of new Location
    var _token = $('input[name="_token"]').val();
    $('#saveLocation').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#location_name_error").css('display','none');
            $('#location_code_error').css('display',"none");
            $('#location_name').removeClass("has_error");
            $('#location_code').removeClass("has_error");
            

            var locationId = $('#location_code').val();
            var locationName = $('#location_name').val();

            $.ajax({
                url:"/location/store",
                method:"POST",
                data:{
                    location_code:locationId,
                    location_name:locationName,
                    _token:_token
                },
                success:function(data){
                    console.log(data.html);
                    console.log(data.error);
                    $('#location_container').replaceWith(data.html);
                if(data['status']){

                         $('#validLocation').css('display',"block");
                        //here reset the form when submit it
                         $("#Location_form").trigger('reset');

                        //updaing the create itemform dropdown
                        $('#location').html('');
                            $.each(data.records , function(key, value){
                                $("#location").append('<option value="'+value.location_code+'">'+value.location_name+'</option>');
                            });

                        $('#selectedLoaction').html('');
                            $.each(data.records , function(key, value){
                                 $("#selectedLoaction").append('<option value="'+value.location_code+'">'+value.location_name+'</option>');
                            });
                        
                }
                },

                error:function(error){

                    var error_type = error.responseJSON.errors;
                
                    if(error_type.location_name){
                        $('#location_name_error').css('display','block');
                        $('#location_name').addClass("has_error");
                        $('#location_name_msg').html(error_type.location_name[0]);
                    }
                    if(error_type.location_code){
                        $('#location_code_error').css('display','block');
                        $('#location_code').addClass("has_error");
                        $('#location_code_msg').html(error_type.location_code[0]);
                    }
                    
                }
            

            })

    })

    // ********************ADD NEW LOCATION PART IS ENDED!********************************************************************************



//    *******************ADD NEW SUB LOCATION PART STRAT**********************************************************************************


    //if alertboxes display because last sub Location inserting, they will not appear from tis function
    $('#buttonCreateSubLoaction').click(function(){
        $('#subLocation_name_error').css('display','none');
        $('#subLocation_name').removeClass("has_error");
        $('#subLocation_code_error').css('display','none');
        $('#subLocation_code').removeClass("has_error");
        $('#validSubLocation').css('display',"none");  
    })


        $('#saveSubLocation').click(function(){
 
            //if alert boxes appear because of inserting data before it will remove
            $('#subLocation_name_error').css('display','none');
            $('#subLocation_name').removeClass("has_error");
            $('#subLocation_code_error').css('display','none');
            $('#subLocation_code').removeClass("has_error");
           

            var subLocationId = $('#subLocation_code').val();
            var subLocationName = $('#subLocation_name').val();
            var loactionCode =  $('#selectedLoaction').val();
            var location_code_form = $('#location').val();  //this value also send to the controller because of we dont know coreectly what is the category in the create Item Form
          
            
            $.ajax({
                url:"/subLocation/store",
                method:"POST",
                data:{
                    location_code:loactionCode,
                    subLocation_name:subLocationName,
                    subLocation_code:subLocationId,
                    location_code_form:location_code_form,
                    _token:_token
                },
                success:function(data){
                    
                    if(data['status']){
                        $('#validSubLocation').css('display',"block");

                            //here reset the form when submit it
                            $("#subLocation_form").trigger('reset');
                            //updaing the create itemform dropdown
                            $('#sublocation').html('');


                                if(data['records'].length > 0){
                                    
                                    op = '';
                                    op += '<option value="" > Sub Location</option>';
                    
                                            for (var i = 0; i < data['records'].length; i++) {
                                                op += '<option value="' + data['records'][i].subLocation_code + '" >' + data['records'][i].subLocation_name + '</option>';
                                            }


                                    }else if(data['records'].length == 0){
                                        op = '';
                                        op += '<option value="" > Sub Location</option>';
                                    }   

                        $('#sublocation').html('');
                        $('#sublocation').append(op);
                        

                    }

                },
                error:function(error){

                    var error_type = error.responseJSON.errors;
                
                    if(error_type.subLocation_name){
                        $('#subLocation_name_error').css('display','block');
                        $('#subLocation_name').addClass("has_error");
                        $('#subLocation_name_msg').html(error_type.subLocation_name[0]);
                    }
                    if(error_type.subLocation_code){
                        $('#subLocation_code_error').css('display','block');
                        $('#subLocation_code').addClass("has_error");
                        $('#subLocation_code_msg').html(error_type.subLocation_code[0]);
                    }

                }
            

            })

            
        })
 // ********************ADD NEW SUB LOCATION PART IS ENDED!********************************************************************************



//    *******************ADD CATEGORY PART STRAT**********************************************************************************


        //if alertboxes display because last category inserting, they will not appear from tis function
        $('#button_create_category').click(function(){
            $('#category_name_error').css('display','none');
            $('#category_name').removeClass("has_error");
            $('#category_code_error').css('display','none');
            $('#category_id').removeClass("has_error");
            $('#valid_category').css('display','none');
        })


        $('#saveCategory').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $('#category_name_error').css('display','none');
            $('#category_name').removeClass("has_error");
            $('#category_code_error').css('display','none');
            $('#category_id').removeClass("has_error");

            var category_code = $('#category_id').val();
            var category_name = $('#category_name').val();
           
              
            $.ajax({
                url:"/category",
                method:"POST",
                data:{
                    category_code:category_code,
                    category_name:category_name,
                    _token:_token
                },
                success:function(data){
                    console.log(data);
                if(data['status']){
                    $('#valid_category').css('display',"block");

                    //here reset the form when submit it
                    $("#category_form").trigger('reset');

                    //updaing the create itemform dropdown
                    $('#category').html('');
                    $.each(data.records , function(key, value){
                        $("#category").append('<option value="'+value.category_code+'">'+value.category_name+'</option>');
                    })
                    
                    $('#categoryID').html('');
                    $.each(data.records , function(key, value){
                        $("#categoryID").append('<option value="'+value.category_code+'">'+value.category_name+'</option>');
                    })

                   }

                },
                error:function(error){

                    var error_type = error.responseJSON.errors;
                   
                    if(error_type.category_name){
                        $('#category_name_error').css('display','block');
                        $('#category_name').addClass("has_error");
                        $('#category_name_msg').html(error_type.category_name[0]);
                    }
                    if(error_type.category_code){
                        $('#category_code_error').css('display','block');
                        $('#category_id').addClass("has_error");
                        $('#category_code_msg').html(error_type.category_code[0]);
                    }
                    
                }
            

            })

        })
 // ********************ADD NEW CATEGORY PART IS ENDED!********************************************************************************



 //    *******************ADD SUB CATEGORY PART STRAT**********************************************************************************


        //if alertboxes display because last sub category inserting, they will not appear from tis function
        $('#button_create_subCategory').click(function(){
            $('#subCategory_name_error').css('display','none');
            $('#subCategory_name').removeClass("has_error");
            $('#subCategory_code_error').css('display','none');
            $('#subCategory_code').removeClass("has_error");
            $('#valid_subCategory').css('display',"none");
        })


        $('#save_subCategory').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#valid_subCategory").css('display','none');
            $('#invalid_subCategory').css('display',"none");

            var subCategory_code = $('#subCategory_code').val();
            var subCategory_name = $('#subCategory_name').val();
            var Category_code = $('#categoryID').val();
            var category_code_form = $('#category').val();   //this value also send to the controller because of we dont know coreectly what is the category in the create Item Form
          
             console.log(subCategory_code,subCategory_name,);
          
            $.ajax({
                url:"/subcategory",
                method:"POST",
                data:{
                    subCategory_code:subCategory_code,
                    subCategory_name:subCategory_name,
                    Category_code:Category_code,
                    category_code_form:category_code_form,
                    _token:_token
                },
                success:function(data){
                    console.log(data);
                if(data['status']){
                    $('#valid_subCategory').css('display',"block");

                        //here reset the form when submit it
                        $("#subCategory_form").trigger('reset');

                    //updaing the create itemform dropdown
                    $('#subCategory').html('');
                    if(data['records'].length > 0){
                        
                        op = '';
                        op += '<option value="" > Sub Category</option>';
                        op += '<option value="000" >No Sub Category</option>';
                        for (var i = 0; i < data['records'].length; i++) {
                            op += '<option value="' + data['records'][i].subCategory_code + '" >' + data['records'][i].subCategory_name + '</option>';
                        }
                    }else if(data['records'].length == 0){
                        op = '';
                        op += '<option value="" > Sub Category</option>';
                        op += '<option value="000" >No Sub Category</option>';
                    }   

                    $('#subCategory').html('');
                    $('#subCategory').append(op);
                    

                }
                },
                error:function(error){
                    
                    var error_type = error.responseJSON.errors;
           
                    if(error_type.subCategory_name){

                        $('#subCategory_name_error').css('display','block');
                        $('#subCategory_name').addClass("has_error");
                        $('#subCategory_name_msg').html(error_type.subCategory_name[0]);

                    }

                    if(error_type.subCategory_code){

                        $('#subCategory_code_error').css('display','block');
                        $('#subCategory_code').addClass("has_error");
                        $('#subCategory_code_msg').html(error_type.subCategory_code[0]);

                    }


                }
            

            })

        })
 // ********************ADD NEW SUB CATEGORY PART IS ENDED!********************************************************************************







 //    *******************ADD NEW GRN PART STRAT**********************************************************************************


        //if alertboxes display because last GRn inserting, they will not appear from this function
        $('#button_create_grn').click(function(){
            $('#GRN_date_error').css('display','none');
            $('#GRN_date').removeClass("has_error");
            $('#invoice_error').css('display','none');
            $('#invoice_number').removeClass("has_error");
            $('#invoice_date_error').css('display','none');
            $('#invoice_date').removeClass("has_error");
            $('#valid_grn').css('display',"none");
        })


        $('#save_GRN').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $('#GRN_date_error').css('display','none');
            $('#GRN_date').removeClass("has_error");
            $('#invoice_error').css('display','none');
            $('#invoice_number').removeClass("has_error");
            $('#invoice_date_error').css('display','none');
            $('#invoice_date').removeClass("has_error");


            var GRN_number = $('#GRN_number').val();
            var GRN_date = $('#GRN_date').val();
            var invoice_number = $('#invoice_number').val();
            var invoice_date = $('#invoice_date').val();   //this value also send to the controller because of we dont know coreectly what is the category in the create Item Form
            var supplier_code = $('#supplier_code').val();

            $.ajax({
                url:"/grn",
                method:"POST",
                data:{
                    GRN_number:GRN_number,
                    GRN_date:GRN_date,
                    invoice_number:invoice_number,
                    invoice_date:invoice_date,
                    supplier_code:supplier_code,
                    _token:_token
                },
                success:function(data){
                
                 if(data['status']){
                    $('#valid_grn').css('display',"block");

                        //here reset the form when submit it
                         $("#GRN_date").val('mm/dd/yy');
                         $("#invoice_number").val("");
                         $("#invoice_date").val('mm/dd/yy');
                         $("#supplier_name").html("");
                         $.each(data.supplier , function(key, value){
                            $("#supplier_name").append('<option value="'+value.supplier_code+'">'+value.supplier_name+'</option>');
                        })
                        $("#GRN_number").val(parseInt(GRN_number)+1);

                        //updaing the create itemform dropdown
                        $('#grn_number').html('');
                        $.each(data.records , function(key, value){
                            $("#grn_number").append('<option value="'+value.GRN_number+'">'+value.GRN_number+'</option>');
                        })
                        

                    }
                },
                error:function(error){
                    var error_type = error.responseJSON.errors;
           
                    if(error_type.GRN_date){

                        $('#GRN_date_error').css('display','block');
                        $('#GRN_date').addClass("has_error");
                        $('#GRN_date_msg').html(error_type.GRN_date[0]);

                    }

                    if(error_type.invoice_number){

                        $('#invoice_error').css('display','block');
                        $('#invoice_number').addClass("has_error");
                        $('#invoice_msg').html(error_type.invoice_number[0]);

                    }

                    if(error_type.invoice_date){

                        $('#invoice_date_error').css('display','block');
                        $('#invoice_date').addClass("has_error");
                        $('#invoice_date_msg').html(error_type.invoice_date[0]);

                    }

                }
            

            })

          
        })
 // ********************ADD NEW SUB CATEGORY PART IS ENDED!********************************************************************************

 $('.cancel_modal').click(function(){
     $('.modal').modal('hide');
 })


})