$(document).ready(function() {
    var _token = $('input[name="_token"]').val();
    $('#division').change(function() {

        var div_id = $(this).val();
        var form = $(this).parent();
        var op = '';
        $.ajax({

            url: "/ajax/division",
            method: "POST",
            data: {
                locationId: div_id,
                _token: _token,
            },
            success: function(data) {

                op += '<option value="" selected disabled>Select Sub Location</option>';
                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].subLocation_code + '" >' + data[i].subLocation_name + '</option>';
                }
                $('#subDivision').html('');
                $('#subDivision').append(op);
            },
            error: function() {

            }
        });

    })

    //Popup the error because laction not selected
    $('#subDivision').click(function(){
        console.log($('#division').val());
        if(!$('#division').val()){
              $('#alertLocation').click();  
        }
    }) 



    //get the related subcategory
    $('#category').change(function() {

        var cate_id = $(this).val();
        var a = $(this).parent();
        var op = '';
        $.ajax({

            url: "/ajax/category",
            type: "POST",
            data: {
                categoryid: cate_id,
                _token: _token
            },
            success: function(data) {

                op += '<option value="000" >Select Sub Category</option>';
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

     
     //Popup the error because laction not selected
     $('#subCategory').click(function(){
        console.log($('#category').val());
        if(!$('#category').val()){
              $('#alertCategory').click();  
        }
    }) 



    //FILTER DATA

    function fetchData(division = "", subdivision = "", category = "", subcategory = "",type = "", pid = "") {

        var _token = $('input[name="_token"]').val();
        $.ajax({

            url: "/ajax/filter",
            method: "POST",

            data: {
                _token: _token,
                div: division,
                subdiv: subdivision,
                cate: category,
                subcate: subcategory,
                type: type,
                pid: pid
            },
            success: function(data) {
                var output = "";
             
                console.log(data);
                for (var i = 0; i < data['records'].length; i++) {
                    output += '<tr>';
                    output += ' <th scope="row">' + data['records'][i].item_code + '</th>';
                    output += '<td>' + data['records'][i].location_code + '</td>';
                    output += '<td>' + data['records'][i].subLocation_code + '</td>';
                    output += '<td>' + data['records'][i].category_code + '</td>';
                    output += '<td>' + data['records'][i].subCategory_code + '</td>';
                    output += '<td>' + data['records'][i].type + '</td>';
                    output += '<td>' + data['records'][i].GRN_no + '</td>';
                    output += '<td>' + data['records'][i].vat + '</td>';
                    output += '<td>' + data['records'][i].vat_rate_vat + '</td>';
                    output += '<td>' + data['records'][i].procurement_id + '</td>';
                    output += '<td>' + data['records'][i].rate + '</td>';

                    if(data['authType'] == "manager"){
                        output += '<td class="d-flex flex-row"><a href="" class="btn btn-primary mr-1">View</a><a href="/item/edit/' + data['records'][i].item_code + '" class="btn btn-success">Edit</a> </td>';
                    }else if(data['authType'] == "admin"){
                        output += '<td class="d-flex flex-row"><a href="" class="btn btn-primary mr-1">View</a><a href="/item/edit/' + data['records'][i].item_code + '" class="btn btn-success mr-1">Edit</a>  <button type="submit" class=" btn btn-danger text-light delete-confirm " data-action="/item/delete/' + data['records'][i].item_code + '" data-id="'+ data['records'][i].item_code+'"></data-id>Delete</button> </td> ';
                    }else if(data['authType'] == "user"){
                        output += '<td class="d-flex flex-row"><a href="" class="btn btn-primary mr-1">View</a> </td>';
                    }
                    
                   
                    output += '</tr>';
                }

                $('#dataBody').html("");
                $('#dataBody').append(output);
               
            },
            error: function() {
                console.log('error!');
            }

        })

    }

    //function call
    $('#filter').click(function() {
        var div_id = $('#division').val();
        var subdiv_id = $('#subDivision').val();
        var cate_id = $('#category').val();
        var subcate_id = $('#subCategory').val();
        var type = $('#Type').val();
        var pID = $('#ProID').val();
        console.log(pID);
            fetchData(div_id, subdiv_id, cate_id, subcate_id, type, pID);
       

    });



})