$("body").on("keyup", "#searchValue", function () {
    var searchQuerry = $(this).val();

    $.ajax({
        method: "POST",
        url: config.routes.liveSearch,
        dataType: "json",
        data: {
            _token: config.tokens.token,
            searchQuerry: searchQuerry,
        },
        success: function (res) {
            var tableRow = "";
            $("#dynamic-row").fadeIn();
            $("#dynamic-row").html("");

            $.each(res, function (index, object) {
                switch (index) {
                    case 0:
                        $.each(object, function (index, value) {
                            $tableRow =
                                '<li class="list-group-item" id="result" href="#"> <a>' +
                                value.division_name +
                                '</a>';
                            $("#dynamic-row").append($tableRow);
                        });
                        break;
                    case 1:
                        $.each(object, function (index, value) {
                            $tableRow =
                                '<li class="list-group-item" id="result" href="#"> <a>' +
                                value.subDivision_name +
                                '</a>';
                            $("#dynamic-row").append($tableRow);
                        });
                        break;
                    case 2:
                        $.each(object, function (index, value) {
                            $tableRow =
                                '<li class="list-group-item" id="result" href="#"> <a>' +
                                value.category_name +
                                '</a>';
                            $("#dynamic-row").append($tableRow);
                        });
                        break;
                    case 3:
                        $.each(object, function (index, value) {
                            $tableRow =
                                '<li class="list-group-item" id="result" href="#"> <a>' +
                                value.subCategory_name +
                                '</a>';
                            $("#dynamic-row").append($tableRow);
                        });
                        break;
                    case 4:
                        $.each(object, function (index, value) {
                            $tableRow =
                                '<li class="list-group-item" id="result" href="#"> <a>' +
                                value.item_code +
                                "</a> </li>";
                            $("#dynamic-row").append($tableRow);
                        });
                        break;
                }
                $("body").on("click", "#result", function () {
                    $("#searchValue").val($(this).text());
                    $("#dynamic-row").fadeOut();
                });
            });
        },
    });
});


$(document).ready(function(){
    $('#toggleButton').click(function(){
        $('.pimage').toggleClass("profile_img");
        $('.userName').toggleClass("uname");
        $('.sideMenu').toggleClass("sideMenu_1");
        $('.content').toggleClass("content_1");
        $('.textLink').toggleClass("text1");
        $('.nav-link').toggleClass("navLink");
       
    })
     
    $("#side_bar").click(function(){
        $('.sideMenu').toggleClass("sideMenu_2");
    })

    $(document).on('click', 'ul li', function(){
        $(this).addClass('active').siblings().removeClass('active');
    })

    getsLocationAndsCategory();
 })

 function getsLocationAndsCategory(){
    var _token=$('input[name="_token"]').val();
    $('#location').change(function(){
        var loca = $(this).val();
        var op = "";

        $.ajax({
            url:"/ajax/division",
            method:"POST",
            data:{
                locationId:loca,
                _token:_token,
            },
            success:function(data){
                op += '<option value ="000">Select Sub Location</option>';

               for(var i=0;i<data.length;i++){
                op += '<option value="'+data[i].subLocation_code+'">'+data[i].subLocation_name+'</option>';

               }

               $('#subLocation').html("");
               $('#subLocation').append(op);
            },
        })
    })

    $('#category').change(function(){
        var cate = $(this).val();
        var opt = "";

        $.ajax({
            url:"/ajax/category",
            method:"POST",
            data:{
                categoryid:cate,
                _token:_token,
            },
            success:function(data){
               opt += '<option value ="000">Select Sub Category</option>';

               for(var i=0;i<data.length;i++){
                opt += '<option value="'+data[i].subCategory_code+'">'+data[i].subCategory_name+'</option>';

               }

               $('#subcategory').html("");
               $('#subcategory').append(opt);
            },
        })
    })

    $('#preview').click(function(){
        var location = $('#location').val();
        var sublocation = $('#subLocation').val();
        var category = $('#category').val();
        var subcategory = $('#subcategory').val();
        var no_of_items = $('#noItems').val();

        var tb = "";

        for(var a=0;a<no_of_items;a++){
            tb += '<tr>';
            tb += '<td>'+location+'/'+sublocation+'/'+category+'/'+subcategory+'/'+(a+1)+'</td>';
            tb += '</tr>';
        }
        $('#itemCode').html("");
        $('#itemCode').append(tb);
    })
 }