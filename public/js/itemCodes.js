$(document).on("click","#preview",function(){
   
    var location = $('#location').val();
    var sublocation = $('#subLocation').val();
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var no_of_items = $('#noItems').val();
    var Vat=$('#Vat').val();
    var rate= $('#Rate').val();
    var procument_id=$('#procument_id').val();
    var action='show';

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
            action: action,
            Vat:Vat,
            Rate:rate,
            procument_id:procument_id,


        },
        success: function (res) {
            
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