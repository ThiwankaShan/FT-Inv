$(document).on("click","#preview",function(){//get input from create item blade and check the data
   console.log('came to js function');
    var location = $('#location').val();
    var sublocation = $('#sublocation').val();
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var no_of_items = $('#noItems').val();
    var no_sub_items=$('#NoSub').val();
    var Vat=$('#Vat').val();
    var rate= $('#Rate').val();
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
            Location: location,
            subLocation: sublocation,
            category: category,
            subCategory: subcategory,
            Quantity: no_of_items,
            sub_item:no_sub_items,
            action: action,
            Vat:Vat,
            Rate:rate,
            procument_id:procument_id,
            purchased_date:purchased_date,
            grn_no:GRN_code
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

        error: function(request, status, error){

            var error="";
            $.each(request.responseJSON.errors, function (index, object) {
                if(index=='Vat'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#vatError').html("");
                    $('#vatError').append(error);
                }
                else if(index=='Quantity'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#quantityError').html("");
                    $('#quantityError').append(error);
                }
                else if(index=='procument_id'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#procumentIdError').html("");
                    $('#procumentIdError').append(error);
                }
                else if(index=='Rate'){
                    error="";
                    error+='<strong>'+object[0]+'</strong>'
                    $('#rateError').html("");
                    $('#rateError').append(error);
                }

            });

        },
    })
})
