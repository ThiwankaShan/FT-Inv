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

                op += '<option value="" > Sub Location</option>';
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

                for (var i = 0; i < data.length; i++) {
                    op += '<option value="' + data[i].subCategory_code + '" >' + data[i].subCategory_name + '</option>';
                }
                $('#subCategory').children(':not(.default_option)').remove();
                $('#subCategory').append(op);
            },
            error: function() {

            }
        });

    })


    function fetchData(loactionCode = "", subLoactionCode = "", categoryCode = "", subCategoryCode = "",type = "", pid = "",sn="", column="location_code", order="ASC",purchased_start='',purchased_end='',serial_now='') {

        // input filter and sort paramters
        // send data to ajaxcontroller get filter method
        // output item data as item rows to dashboard (sorted and filterd)
        // this function double as standalone sort function

        var _token = $('input[name="_token"]').val();
        $.ajax({

            url: "/ajax/filter",
            method: "POST",
            async : false,

            data: {
                _token: _token,
                loactionCode: loactionCode,
                subLoactionCode: subLoactionCode,
                category_code: categoryCode,
                subCategory_code: subCategoryCode,
                type: type,
                pid: pid,
                serial_number:serial_number,
                column : column,
                order : order,
                purchased_start : purchased_start,
                purchased_end : purchased_end,

            },
            success: function(data) {
                $('#items_table').html(data.html);
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
    var serial_number="";
    var column = "location_code";
    var order = "ASC";


    //Here is the above Function call
    $('#filter').click(function() {
        console.log('Filter js function');
        location = $('#location').val();
        subLocation = $('#sublocation').val();
        category = $('#category').val();
        subCategory = $('#subCategory').val();
        type = $('#Type').val();
        pID = $('#ProID').val();
        serial_number=$('#sn').val();


        fetchData(location, subLocation, category, subCategory, type, pID,serial_number, column, order);


    });

    // sort and filter function
    $('#sort').click(function() {
        console.log('Sort js function');
        column = $('#column').val();
        order = $('#order').val();
            fetchData(location, subLocation, category, subCategory, type, pID, column, order);
    });

    // report disable purchase dates when period dates selected
    $('#period_start,#period_end').on('change',function() {
        if( $('#period_start').val()!='' || $('#period_end').val()!=''){
            $('#purchased_start').prop( "readonly", true );
            $('#purchased_end').prop( "readonly", true );
        }else if( $('#period_start').val()=='' && $('#period_end').val()==''){
            $('#purchased_start').prop( "readonly", false );
            $('#purchased_end').prop( "readonly", false );
        }

    });

    // report disable period dates when purchased dates selected
    $('#purchased_start,#purchased_end').on('change',function() {
        if( $('#purchased_start').val()!='' || $('#purchased_end').val()!=''){
            $('#period_start').prop( "readonly", true );
            $('#period_end').prop( "readonly", true );
        }else if( $('#purchased_start').val()=='' && $('#purchased_end').val()==''){
            $('#period_start').prop( "readonly", false );
            $('#period_end').prop( "readonly", false );
        }

    });


})
