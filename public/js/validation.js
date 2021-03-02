

document.addEventListener("DOMContentLoaded", event => {

    const createForm = document.querySelector('#create_item_form');
    const submitButton = document.querySelector('#btn_submit');
    const showCodesButton = document.querySelector('#preview');

    pristineCreateForm = new Pristine(createForm);


    new AutoNumeric('#gross_price', {
        decimalCharacter: '.',
        digitGroupSeparator: ',',
        unformatOnSubmit: true
    });

    new AutoNumeric('#tax', {
        decimalCharacter: '.',
        digitGroupSeparator: ',',
        unformatOnSubmit: true
    });

    submitButton.addEventListener("click", async function () {

        var valid = pristineCreateForm.validate();

        if (valid) {
            if(localStorage.getItem('backToUrl')){
                $('#back_to').val(localStorage.getItem('backToUrl'));
            }
            createForm.submit();
        }

    })

    showCodesButton.addEventListener("click", async function () {

        var valid = pristineCreateForm.validate();

        if (valid) {
            showCodes();
        }

    })

})

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
       if(serial_target.value.length >= 20){
        serial_target.classList.add('validOne');
        document.getElementById(error).innerHTML = "Input is too long.Must be less than 20 characters";
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


// **************************************Serial Number Inputs Real Time Validation  END**************************


//*******************************Here is Highlights the Updated Row In Dashbord********************************************************** */

if(document.getElementById('highlighted_row')){

    var input_id = document.getElementById('highlighted_row');
    var val = input_id.value;
    var row_id = val.replace(/\/+/g, '');
    
    document.getElementById(row_id).style.backgroundColor = "#A5D6A7";
    document.getElementById(row_id).style.borderLeft = "5px solid #33691E";

    //scroll automatically to updated row
    $(window).scrollTop($('#'+row_id).position().top);

}

if(document.getElementById('highlighted_row_crud')){

    var input_id = document.getElementById('highlighted_row_crud');
    var val = input_id.value;
    // var row_id = val.replace(/\/+/g, '');
    
    document.getElementById(val).style.backgroundColor = "#A5D6A7";
    document.getElementById(val).style.borderLeft = "5px solid #33691E";
    //scroll automatically to updated row
    $(window).scrollTop($('#'+val).position().top);
                                                         
}

$('.item_edit_button').click(function(e){
    
    var url = window.location.href;
  
    localStorage.setItem("backToUrl", url);
    console.log(localStorage.getItem('backToUrl'))
})

//========================================================Live Validation Functions for Location,Sub Location,Category,Sub Category,GRN  ============================================
function live_validate_fail (input_id, error_span, button_save){
    document.getElementById(input_id).classList.add('validOne');
    document.getElementById(error_span).innerHTML="Input is too Long.Must be less than 5 characters"; 
    document.getElementById(error_span).style.display="block";
    document.getElementById(button_save).disabled=true;
}

function live_validate_pass(input_id, error_span, button_save){
    document.getElementById(input_id).classList.remove('validOne');
    document.getElementById(error_span).innerHTML=""; 
    document.getElementById(error_span).style.display="none";
    document.getElementById(button_save).disabled=false;
}

function remove_all_live_validation_functions(form_type,input_id, error_span, button_save){
    $("#"+form_type).trigger('reset');
    document.getElementById(input_id).classList.remove('validOne');
    document.getElementById(error_span).innerHTML=""; 
    document.getElementById(error_span).style.display="none";
    document.getElementById(button_save).disabled=false;
}

//========================================================Location Create Modal Live Validation  ============================================


$('#location_code').click(function(){

    let input_id = document.getElementById('location_code');
    input_id.addEventListener('input',validation);

    function validation(e){

        var target = e.target;
        if(target.value.length >= 5){
            live_validate_fail('location_code', 'live_location_code','saveLocation');        
        }else{
            live_validate_pass('location_code', 'live_location_code','saveLocation');
        }

    }

    // Hide errors when the modal open back
    $('#buttonCreateLocation').click(function(){     
        remove_all_live_validation_functions('Location_form','location_code', 'live_location_code','saveLocation');      
    })
  
})

//========================================================Sub Location Create Modal Live Validation  ============================================


$('#subLocation_code').click(function(){

    let input_id = document.getElementById('subLocation_code');
    input_id.addEventListener('input',validation);

    function validation(e){

        var target = e.target;
        if(target.value.length >= 5){
            live_validate_fail('subLocation_code', 'live_subLocation_code','saveSubLocation');        
        }else{
            live_validate_pass('subLocation_code', 'live_subLocation_code','saveSubLocation');
        }

    }

    //Hide errors when the modal open back
    $('#buttonCreateSubLoaction').click(function(){     
        remove_all_live_validation_functions('subLocation_form','subLocation_code', 'live_subLocation_code','saveSubLocation');      
    })
  
})

//========================================================Category Create Modal Live Validation  ============================================


$('#category_code').click(function(){

    let input_id = document.getElementById('category_code');
    input_id.addEventListener('input',validation);

    function validation(e){

        var target = e.target;
        if(target.value.length >= 5){
            live_validate_fail('category_code', 'live_category_code','saveCategory');        
        }else{
            live_validate_pass('category_code', 'live_category_code','saveCategory');
        }

    }

    //Hide errors when the modal open back
    $('#button_create_category').click(function(){     
        remove_all_live_validation_functions('category_form','category_code', 'live_category_code','saveCategory');      
    })
  
})


//========================================================Sub Category Create Modal Live Validation  ============================================


$('#subCategory_code').click(function(){

    let input_id = document.getElementById('subCategory_code');
    input_id.addEventListener('input',validation);

    function validation(e){

        var target = e.target;
        if(target.value.length >= 5){
            live_validate_fail('subCategory_code', 'live_subCategory_code','save_subCategory');        
        }else{
            live_validate_pass('subCategory_code', 'live_subCategory_code','save_subCategory');
        }

    }

    //Hide errors when the modal open back
    $('#button_create_subCategory').click(function(){     
        remove_all_live_validation_functions('category_form','subCategory_code', 'live_subCategory_code','save_subCategory');      
    })
  
})


//========================================================GRN Form Live Validation  ============================================

$('#invoice_number').click(function(){

    let input_id = document.getElementById('invoice_number');
    input_id.addEventListener('input',validation);

    function validation(e){

        var target = e.target;
        if(target.value.length >= 8){
            live_validate_fail('invoice_number', 'live_invoice_number','save_GRN');        
        }else{
            live_validate_pass('invoice_number', 'live_invoice_number','save_GRN');
        }

    }

    //Hide errors when the modal open back
    $('#button_create_grn').click(function(){     
        remove_all_live_validation_functions('Grn_form','invoice_number', 'live_invoice_number','save_GRN');      
    })
  
})


//========================================================Supplier Form Live Validation  ============================================


if(document.querySelector('#supplier_form')){

    const forms = document.querySelector('#supplier_form');

    let  supplier_code = forms.elements.namedItem('supplier_code');
    let  vat_register_no  = forms.elements.namedItem('vat_register_no');
   

    supplier_code.addEventListener('input', validation);
    vat_register_no.addEventListener('input', validation);
    
    //Real Time Validation Function
    function validation(e){

            let target = e.target;
            let supplier_code = document.getElementById('supplier_code'); 
            let vat_register_no = document.getElementById('vat_register_no'); 
        
            if(target.value.length >= 8){
                target.classList.add('validOne');
                document.getElementById('live_'+target.name).innerHTML = "Input is too long.Must be less than 8 characters";
                document.getElementById('live_'+target.name).style.display = 'block';
                
            }else{
                target.classList.remove('validOne');
                document.getElementById('live_'+target.name).innerHTML = "";
                document.getElementById('live_'+target.name).style.display = 'none';
                
            }
            
            //disable the submit button to prevent submitting invalid length of values
            if(supplier_code.value.length >= 8 || vat_register_no.value.length >= 8  ){
                document.getElementById('saveSupplier').disabled = true;
            }else{
                document.getElementById('saveSupplier').disabled = false;
            
            }
      

    }
}






