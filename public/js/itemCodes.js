$(document).on("click","#preview",function(){//get input from create item blade and check the data
   console.log('came to js function');
    var location = $('#location').val();
    var sublocation = $('#sublocation').val();
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var no_of_items = $('#noItems').val();
    var no_sub_items=$('#NoSub').val();
    var Vat=$('#tax').val();
    var rate= $('#gross_price').val();
    var procument_id=$('#procument_id').val();
    var action='show';
    var purchased_date = $('#purchased_date').val();
    var GRN_code = $('#GRN_code').val();
    $.ajax({
        method: "POST",
        url: config.routes.itemStore,
        dataType: "json",
        data: {
            _token: config.tokens.token,
            location_code: location,
            subLocation_code: sublocation,
            category_code: category,
            subCategory_code: subcategory,
            Quantity: no_of_items,
            sub_item:no_sub_items,
            action: action,
            tax:Vat,
            gross_price:rate,
            procument_id:procument_id,
            purchased_date:purchased_date,
            GRN_number:GRN_code
        },
        success: function (res) {
            console.log(res);
            $("#vatError").fadeOut();
            $("#quantityError").fadeOut();
            $("#procumentIdError").fadeOut();
            $("#rateError").fadeOut();

            $('#itemCodes').modal("show");
            var tabledata="";
            $.each(res, function (index, object) {

                tabledata+='<tr> <td>'+object+'</td></tr><hr>';

            });
            $('#itemCode').html("");
            $('#itemCode').append(tabledata);
        },

        error: function(request){
            console.log(request.responseJSON.errors)
            var error="";
            $.each(request.responseJSON.errors, function (index, object) {
                if(index=='location_code'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#locationError').html("");
                    $('#locationError').append(error);

                }
                else if(index=='subLocation_code'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#subLocationError').html("");
                    $('#subLocationError').append(error);

                }
                else if(index=='category_code'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#categoryError').html("");
                    $('#categoryError').append(error);

                }
                else if(index=='tax'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#real_time_tax').html("");
                    $('#real_time_tax').append(error);
                }
                else if(index=='Quantity'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#quantityError').html("");
                    $('#quantityError').append(error);
                }
                else if(index=='purchased_date'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#real_time_purchased_date').html("");
                    $('#real_time_purchased_date').append(error);
                }
                else if(index=='gross_price'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#real_time_gross_price').html("");
                    $('#real_time_gross_price').append(error);
                }

            });

        },
    })
})
