$(document).ready(function(){
  
//    *******************ADD NEW LOCATION PART STRAT**********************************************************************************

    //if alertboxes display because last Location inserting, they will not appear from tis function
   $('#buttonCreateLocation').click(function(){
       $("#invalid_location").css('display','none');
       $('#validLocation').css('display',"none");
   })


    //Here is the Function that send Ajax Request to Cerate Location controller to Save Records of new Location
    var _token = $('input[name="_token"]').val();
    $('#saveLocation').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#invalid_location").css('display','none');
            $('#validLocation').css('display',"none");

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
                console.log(data);
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
                   

              }else{
                  //Bellow function call 
                    printError(data.errors);
              }
            },
         

        })
 
        function printError(msg){
            $(".print-error-msg").find("ul").html('');
			$(".print-error-msg").css('display','block');
            $.each(msg , function(key, value){
                $(".print-error-msg").find("ul").append('<li><strong>'+value+'</strong></li>');
            })
        }

    })

    // ********************ADD NEW LOCATION PART IS ENDED!********************************************************************************



//    *******************ADD NEW SUB LOCATION PART STRAT**********************************************************************************


        //if alertboxes display because last sub Location inserting, they will not appear from tis function
        $('#buttonCreateSubLoaction').click(function(){
            $("#validSubLocation").css('display','none');
            $('#invalidSubLocation').css('display',"none");
        })


        $('#saveSubLocation').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#validSubLocation").css('display','none');
            $('#invalidSubLocation').css('display',"none");

            var subLocationId = $('#subLocation_code').val();
            var subLocationName = $('#subLocation_name').val();
            var loactionCode =  $('#selectedLoaction').val();
            var location_code_form = $('#location').val();  //this value also send to the controller because of we dont know coreectly what is the category in the create Item Form
                 console.log(loactionCode); 
            $.ajax({
                url:"/sublocation",
                method:"POST",
                data:{
                    Location_code:loactionCode,
                    subLocation_name:subLocationName,
                    subLocation_code:subLocationId,
                    location_code_form:location_code_form,
                    _token:_token
                },
                success:function(data){
                    console.log(data);
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
                    

                }else{
                    //Bellow function call 
                        printError1(data.errors);
                }
                },
            

            })

            function printError1(msg){
                $("#invalidSubLocation").find("ul").html('');
                $("#invalidSubLocation").css('display','block');
                $.each(msg , function(key, value){
                    $("#invalidSubLocation").find("ul").append('<li><strong>'+value+'</strong></li>');
                })
            }

        })
 // ********************ADD NEW SUB LOCATION PART IS ENDED!********************************************************************************



//    *******************ADD CATEGORY PART STRAT**********************************************************************************


        //if alertboxes display because last category inserting, they will not appear from tis function
        $('#button_create_category').click(function(){
            $("#valid_category").css('display','none');
            $('#invalid_category').css('display',"none");
        })


        $('#saveCategory').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#valid_category").css('display','none');
            $('#invalid_category').css('display',"none");

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

                }else{
                    //Bellow function call 
                        printError1(data.errors);
                }
                },
            

            })

            function printError1(msg){
                $("#invalid_category").find("ul").html('');
                $("#invalid_category").css('display','block');
                $.each(msg , function(key, value){
                    $("#invalid_category").find("ul").append('<li><strong>'+value+'</strong></li>');
                })
            }

        })
 // ********************ADD NEW CATEGORY PART IS ENDED!********************************************************************************



 //    *******************ADD SUB CATEGORY PART STRAT**********************************************************************************


        //if alertboxes display because last sub category inserting, they will not appear from tis function
        $('#button_create_subCategory').click(function(){
            $("#valid_subCategory").css('display','none');
            $('#invalid_subCategory').css('display',"none");
        })


        $('#save_subCategory').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#valid_subCategory").css('display','none');
            $('#invalid_subCategory').css('display',"none");

            var subCategory_code = $('#subCategory_code').val();
            var subCategory_name = $('#subCategory_name').val();
            var Category_code = $('#categoryID').val();
            var category_code_form = $('#category').val();   //this value also send to the controller because of we dont know coreectly what is the category in the create Item Form
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
                    

                }else{
                    //Bellow function call 
                        printError(data.errors);
                }
                },
            

            })

            function printError(msg){
                $("#invalid_subCategory").find("ul").html('');
                $("#invalid_subCategory").css('display','block');
                $.each(msg , function(key, value){
                    $("#invalid_subCategory").find("ul").append('<li><strong>'+value+'</strong></li>');
                })
            }

        })
 // ********************ADD NEW SUB CATEGORY PART IS ENDED!********************************************************************************







 //    *******************ADD NEW GRN PART STRAT**********************************************************************************


        //if alertboxes display because last GRn inserting, they will not appear from this function
        $('#button_create_grn').click(function(){
            $("#valid_grn").css('display','none');
            $('#invalid_grn').css('display',"none");
        })


        $('#save_GRN').click(function(){

            //if alert boxes appear because of inserting data before it will remove
            $("#valid_grn").css('display','none');
            $('#invalid_grn').css('display',"none");

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
                    console.log('got a response');
                if(data['status']){
                    $('#valid_grn').css('display',"block");

                        //here reset the form when submit it
                         $("#GRN_date").val('mm/dd/yy');
                         $("#invoice_no").val('mm/dd/yy');
                         $("#invoice_date").val('mm/dd/yy');
                         $("#supplier_name").html("");
                         $.each(data.supplier , function(key, value){
                            $("#supplier_name").append('<option value="'+value.supplier_code+'">'+value.supplier_name+'</option>');
                        })
                        $("#GRN_number").val(parseInt(GRN_number)+1);

                    //updaing the create itemform dropdown
                    $('#GRN_code').html('');
                    $.each(data.records , function(key, value){
                        $("#GRN_code").append('<option value="'+value.GRN_number+'">'+value.GRN_number+'</option>');
                    })
                    

                }else{
                    //Bellow function call 
                        printError(data.errors);
                }
                },
            

            })

            function printError(msg){
                $("#invalid_grn").find("ul").html('');
                $("#invalid_grn").css('display','block');
                $.each(msg , function(key, value){
                    $("#invalid_grn").find("ul").append('<li><strong>'+value+'</strong></li>');
                })
            }

        })
 // ********************ADD NEW SUB CATEGORY PART IS ENDED!********************************************************************************

 $('.cancel_modal').click(function(){
     $('.modal').modal('hide');
 })


})