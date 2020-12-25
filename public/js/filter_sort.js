
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
    

    function fetchData(loactionCode = "", subLoactionCode = "", categoryCode = "", subCategoryCode = "",type = "", pid = "", column="location_code", order="ASC",purchased_start='',purchased_end='') {
              
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
    var column = "location_code";
    var order = "ASC";
    var reportView = false;

    //Here is the above Function call
    $('#filter').click(function() {

        location = $('#location').val();
        subLocation = $('#sublocation').val();
        category = $('#category').val();
        subCategory = $('#subCategory').val();
        type = $('#Type').val();
        pID = $('#ProID').val();
        fetchData(location, subLocation, category, subCategory, type, pID, column, order);
            
    });

    // sort and filter function 
    $('#sort').click(function() {
        
        column = $('#column').val();
        order = $('#order').val();
            fetchData(location, subLocation, category, subCategory, type, pID, column, order);
            
    });

    // pdf download function 
    $('#viewReport').click(function() {
        reportView = true;
        location = $('#location').val();
        subLocation = $('#sublocation').val();
        category = $('#category').val();
        subCategory = $('#subCategory').val();
        type = $('#Type').val();
        pID = $('#ProID').val();
        column = $('#column').val();
        order = $('#order').val();
        purchased_start = $('#purchased_start').val() ;
        purchased_end = $('#purchased_end').val();

        // read and display department 
        var sel = document.getElementById('sublocation');
        var department= sel.options[sel.selectedIndex].text;
        department = 'Department : '+department;
        if (department == 'Department : Sub Location') {department=''};
        $('#department').html(department);

        // read and display date
        var start = $('#purchased_start').val(); 
        var end = $('#purchased_end').val();
        console.log(start);
        if (start == '' & end =='' ){

        }
        else if (start==end){
            $('#date').html("");
            $('#date').html('Purchased on '+start);
        }else{
            $('#date').html("");
            $('#date').html('Purchased during the Period of '+start+'-'+end);
        } 

        reportPreview(location, subLocation, category, subCategory, type, pID, column, order,purchased_start,purchased_end);
    });

    // pdf download function 
    $('#downloadReports').click(function() {
        reportView = true;
        reportPreview(location, subLocation, category, subCategory, type, pID, column, order);
    });

    



})