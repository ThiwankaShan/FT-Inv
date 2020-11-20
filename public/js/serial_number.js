$(document).ready(function(){
   
    var _token = $('input[name="_token"]').val();
$('.submit_serial').click(function(){
    var clicked_item_code = ($(this).val()).toString();
    var cleared_item_code = clicked_item_code.replace(/\/+/g, '');
    var serial_number = $(`#${cleared_item_code}`).val();
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


})