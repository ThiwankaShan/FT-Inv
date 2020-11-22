
$(document).ready(function() {

    //Send ajax request to Filter Controller and retreving subLocations Object
    var _token = $('input[name="_token"]').val();
    $('#location').change(function() {

        var locationCode = $(this).val();
        console.log(locationCode);
        var form = $(this).parent();
        var op = '';
        $.ajax({

            url: "/ajax/division",
            method: "POST",
            data: {
                locationCode: locationCode,
                _token: _token,
            },
            success: function(data) {

                op += '<option value="" selected disabled> Sub Location</option>';
                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].subLocation_code + '" >' + data[i].subLocation_name + '</option>';
                }

                $('#sublocation').html('');
                $('#sublocation').append(op);
            },
            error: function() {

            }
        });

    })



    //Popup the error because loction not selected
    $('#sublocation').click(function(){
       
        console.log($('#location').val());
        if(!$('#location').val()){
              $('#alertLocation').click();  
        }
    }) 



   //Send ajax request to Filter Controller and retrive  subCategories as a Object
    $('#category').change(function() {
      
        var categoryCode = $(this).val();
        var a = $(this).parent();
        var op = '';
        $.ajax({

            url: "/ajax/category",
            type: "POST",
            data: {
                categoryCode: categoryCode,
                _token: _token
            },
            success: function(data) {

                op += '<option value="" > Sub Category</option>';
                op += '<option value="000" >No Sub Category</option>';

                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].subCategory_code + '" >' + data[i].subCategory_name + '</option>';
                }
                $('#subCategory').html('');
                $('#subCategory').append(op);
            },
            error: function() {

            }
        });

    })

     
     //Popup the error because category not selected
     $('#subCategory').click(function(){

        console.log($('#category').val());
        if(!$('#category').val()){
              $('#alertCategory').click();  
        }
    }) 

    

    function fetchData(loactionCode = "", subLoactionCode = "", categoryCode = "", subCategoryCode = "",type = "", pid = "", column="location_code", order="ASC") {
              
        // input filter and sort paramters
        // send data to ajaxcontroller get filter method
        // output item data as item rows to dashboard (sorted and filterd)
        // this function double as standalone sort function  
        
        var _token = $('input[name="_token"]').val();
        $.ajax({

            url: "/ajax/filter",
            method: "POST",

            data: {
                _token: _token,
                loactionCode: loactionCode,
                subLoactionCode: subLoactionCode,
                categoryCode: categoryCode,
                subCategoryCode: subCategoryCode,
                type: type,
                pid: pid,
                column : column,
                order : order,
            },
            success: function(data) {
                var output = "";              
                console.log(data);
                
                if(data['records'].length < 1 ){  //If empty the Filtered data will be appeared "no data" warning
                   
                    output += '<tr>'
                    output += '<td colspan="12"><div class="alert alert-danger text-center" role="alert"><strong>No Related Data!</strong></div></td>';     
                    output += '</tr>'
                    
                    $('#dataBody').html("");
                    $('#dataBody').append(output);   
                }else{
                    for (var i = 0; i < data['records'].length; i++) {
                   
                        output += '<tr>';
                        output += ' <th scope="row">' + data['records'][i].item_code + '</th>';
                        output += '<td>' + data['records'][i].location_code + '</td>';
                        output += '<td>' + data['records'][i].type + '</td>';
                        output += '<td>' + data['records'][i].purchased_date + '</td>';
                        output += '<td>' + data['records'][i].supplier_name + '</td>';
                        output += '<td>' + data['records'][i].serialNumber + '</td>';
                        output += '<td>' + data['records'][i].GRN_no + '</td>';
                        output += '<td>' + data['records'][i].vat + '</td>';
                        output += '<td>' + data['records'][i].vat_rate_vat + '</td>';
                        output += '<td>' + data['records'][i].procurement_id + '</td>';
                        output += '<td>' + data['records'][i].rate + '</td>';
    
                        if(data['authType'] == "manager"){
                            output += '<td class="d-flex flex-row"><a href="" class="btn btn-secondary mr-1 text-light">View</a><a href="/item/edit/' + data['records'][i].item_code + '" class="btn btn-primary">Edit</a> </td>';
                        }else if(data['authType'] == "admin"){
                            output += '<td class="d-flex flex-row"><a href="/item/edit/' + data['records'][i].item_code + '" class="btn btn-primary mr-1 text-light">Edit</a> <a href="/item/delete/'+ data['records'][i].item_code +'" data-method="post" class="btn btn-danger delete-item text-light" token="'+ _token+'">Delete</a>  </td> ';
                        
                        }
                        
                       
                        output += '</tr>';
                    }
    
                    $('#dataBody').html("");
                    $('#dataBody').append(output);
                }

            },
            error: function() {
                console.log('error!');
            }

        })

    }

    // global variables to keep both sort and filter independent
    var location = "";
    var subLocation = "";
    var category = "";
    var subCategory = "";
    var type = "";
    var pID = "" ;
    var column = "location_code";
    var order = "ASC";

    //Here is the above Function call
    $('#filter').click(function() {

        location = $('#location').val();
        subLocation = $('#sublocation').val();
        category = $('#category').val();
        subCategory = $('#subCategory').val();
        type = $('#Type').val();
        pID = $('#ProID').val();
        console.log(pID);
            fetchData(location, subLocation, category, subCategory, type, pID, column, order);
            
    });

    // sort and filter function 
    $('#sort').click(function() {
        
        column = $('#column').val();
        order = $('#order').val();
        console.log(pID);
            fetchData(location, subLocation, category, subCategory, type, pID, column, order);
            
    });

    



})