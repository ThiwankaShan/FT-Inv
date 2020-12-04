// **************************************Item Create Form Real Time Validation**************************
if(document.querySelector('#create_item_form')){

    const forms = document.querySelector('#create_item_form');
    let  vat = forms.elements.namedItem('Vat');
    let  procument_id = forms.elements.namedItem('procument_id');
    let  rate = forms.elements.namedItem('Rate');

    vat.addEventListener('input', validation);
    procument_id.addEventListener('input', validation);
    rate.addEventListener('input', validation);

    //Real Time Validation Function
    function validation(e){
    let target = e.target;
    let Vat = document.getElementById('Vat'); 
    let Procument_id = document.getElementById('procument_id'); 
    let Rate = document.getElementById('Rate'); 

    target.value = formatNumberWithCommas(target.value);
    function formatNumberWithCommas(x) {
        return x.toString().replace(/B(?=(d{3})+(?!d))/g, ",");
    }
   
    

    if(target.value.length >= 8){
        target.classList.add('validOne');
        document.getElementById('real_time_'+target.name).innerHTML = "Input is too long.Must be less than 8 characters";
        document.getElementById('real_time_'+target.name).style.display = 'block';
        
    }else{
        target.classList.remove('validOne');
        document.getElementById('real_time_'+target.name).innerHTML = "";
        document.getElementById('real_time_'+target.name).style.display = 'none';
        
    }
    
    //disable the submit button to prevent submitting invalid length of values
    if(Vat.value.length >= 8 || Procument_id.value.length >= 8 || Rate.value.length >= 8 ){
        document.getElementById('btn_submit').disabled = true;
        document.getElementById('preview').disabled = true;
    }else{
        document.getElementById('btn_submit').disabled = false;
        document.getElementById('preview').disabled = false;
    }
    


    }
}

// **************************************Item Create Form Real Time Validation  End**************************


// **************************************Serial Number Inputs Real Time Validation  Start**************************
  $(".real_time_input").click(function(){

    var input_id = ($(this).attr('id'));
    console.log(input_id);
    var main =document.querySelector('.'+input_id);
    //  document.querySelector('.'+input_id);
    var btn_id = main.children[0].getAttribute('value');
    var serial_inputs =document.getElementById(input_id);
    var error =  btn_id.replace(/\/+/g, '_');
    var save_serial = btn_id.replace(/\/+/g, '2');
    
    serial_inputs.addEventListener('input', validation_serial_number);
    
    //validation
    function validation_serial_number(e){
       var serial_target = e.target;
       console.log(serial_target.value);
       if(serial_target.value.length >= 8){
        serial_target.classList.add('validOne');
        document.getElementById(error).innerHTML = "Input is too long.Must be less than 8 characters";
        document.getElementById(error).style.display = 'block';
        document.getElementById(save_serial).style.display = 'none';
       }else{
        serial_target.classList.remove('validOne');
        document.getElementById(error).innerHTML = "";
        document.getElementById(error).style.display = 'none';
        document.getElementById(save_serial).style.display = 'block';
       }
    }
})




// serial number in the edit form
$('#serial_number').click(function(){
    
    var serial_input = document.getElementById('serial_number');
    
    serial_input.addEventListener('input',validation);

    function validation(e){
       var target = e.target;
      
       if(target.value.length >= 8){
        
          target.classList.add('validOne');
          document.getElementById('serial_er').innerHTML = "Input is too long.Must be less than 8 characters";
          document.getElementById('serial_er').style.display = 'block';
         
       }else{
        target.classList.remove('validOne');
        document.getElementById('serial_er').innerHTML = '';
        document.getElementById('serial_er').style.display = 'none';
      
       }

       //disebled the buttons of submit when invalid length
       if(Vat.value.length >= 8 || Procument_id.value.length >= 8 || Rate.value.length >= 8 || target.value.length >= 8 ){
           document.getElementById('btn_submit').disabled = true;
       }else{
           document.getElementById('btn_submit').disabled = false;
       }

    }
  

})

$('#Vat').keyup(function(event) {

    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return ;
  
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/[^\d.]/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });

// **************************************Serial Number Inputs Real Time Validation  End**************************