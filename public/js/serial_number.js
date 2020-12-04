$(document).ready(function(){
   
//Sending Serial Numbers of new  Created Items as a ajax request  to Item controller@SerialNumber

    var _token = $('input[name="_token"]').val();
$('.submit_serial').click(function(){
    var clicked_item_code = ($(this).val()).toString();
    var cleared_item_code = clicked_item_code.replace(/\/+/g, '');
    var serial_number = $(`#${cleared_item_code}`).val();
    var edit_id = clicked_item_code.replace(/\/+/g, '-');
    
     console.log(serial_number);
    $.ajax({
        url:'/serial_number/store',
        method:"POST",
        data:{
          item_code:clicked_item_code,  
          serial_number:serial_number,
          _token:_token

        },
        success:function(data){
             console.log(data);

             if(data['edit']){
                $(`#${cleared_item_code}`).css('border-color','#e6f2ff');
                $('#invalid_serial_number').css('display','none');
                $(`#${cleared_item_code}`).attr('disabled','disabled');
                $(`.${cleared_item_code}`).find('button').css('display','none');
                $(`.${cleared_item_code}`).find('span').css('display','block');
                $(`#${edit_id}`).css('display','block');
             }else{
                 $('#invalid_serial').html('');
                 $('#invalid_serial').html(data.errors[0]);
                 $('#invalid_serial_number').css('display','block');
                 $(`#${cleared_item_code}`).css('border-color','red');
                
             }
        },
        error:function(){

        }
    })
})


//After Adding  serial numbers display a edit part

$('.edit_serial').click(function(){
    var clicked_item_code = ($(this).val()).toString();
    var this_id = clicked_item_code.replace(/\/+/g, '-');
    var save_id = clicked_item_code.replace(/\/+/g, '2');
    var inputs_id = clicked_item_code.replace(/\/+/g, '');
    

    $(`#${inputs_id}`).removeAttr('disabled');
    $(`#${save_id}`).css('display','block');
    $(`#${this_id}`).css('display','none');
    $(`.${inputs_id}`).find('span').css('display', 'none');

})


})