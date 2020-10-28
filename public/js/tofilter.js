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

    //FILTER DATA

    function fetchData(division = "", subdivision = "", category = "", subcategory = "") {

        var _token = $('input[name="_token"]').val();
        $.ajax({

            url: "/ajax/filter",
            method: "POST",

            data: {
                _token: _token,
                div: division,
                subdiv: subdivision,
                cate: category,
                subcate: subcategory

            },
            success: function(data) {
                var output = "";
                if(data.length < 1){
                    output += '<div class="alert alert-danger w-100" role="alert"><p class="text-center">No Related Data!</p></div>';  
                  
                    $('#dataTable').html("");
                    $('#dataTable').append(output);

                }else{
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                    output += '<tr>';
                    output += '<td>' + data[i].item_code + '</td>';
                    output += '<td>' + data[i].location_code + '</td>';
                    output += '<td>' + data[i].subLocation_code + '</td>';
                    output += '<td>' + data[i].category_code + '</td>';
                    output += '<td>' + data[i].subCategory_code + '</td>';
                    output += '<td>' + data[i].type + '</td>';
                    output += '<td>' + data[i].GRN_no + '</td>';
                    output += '<td>' + data[i].vat + '</td>';
                    output += '<td>' + data[i].vat_rate_vat + '</td>';
                    output += '<td>' + data[i].procurement_id + '</td>';
                    output += '<td>' + data[i].rate + '</td>';
                    output += '<td class="d-flex flex-row"><a href="" class="btn btn-primary mr-1">View</a><a href="" class="btn btn-success">Edit</a> </td>';
                   
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

    //function call
    $('#filter').click(function() {
        var div_id = $('#division').val();
        var subdiv_id = $('#subDivision').val();
        var cate_id = $('#category').val();
        var subcate_id = $('#subCategory').val();
        console.log(div_id);
        if (div_id != "" && subdiv_id != "" && cate_id != "") {
            fetchData(div_id, subdiv_id, cate_id, subcate_id);
        } else {
            alert('All Selections Should Be!');
        }

    });



})