$('body').on('keyup', '#searchValue', function () {
    var searchQuerry = $(this).val();
    console.log(searchQuerry);
    $.ajax({
        method: 'POST',
        url: config.routes.search,
        dataType: 'json',
        data: {
            '_token': config.tokens.token,
            searchQuerry: searchQuerry,
        },
        success: function (res) {

            var tableRow = '';
            var i = 0;
            console.log(res);
            $('#dynamic-row').fadeIn();
            $('#dynamic-row').html('');
            $.each(res, function (index, object) {
                switch (index) {
                    case 0:
                        console.log(index);
                        console.log('switch 0');
                        $.each(object, function (index, value) {
                            $tableRow = '<li class="list-group-item" id="result" href="#"> <a>' + value.division_name + '</a> </li><li class="list-group-item" id="result" href="#"> <a>' + value.division_id + '</a> </li>';
                            $('#dynamic-row').append($tableRow);
                        });
                        break;

                    case 1:
                        // code block
                        console.log(index);
                        console.log('switch 1');
                        $.each(object, function (index, value) {
                            $tableRow = '<li class="list-group-item" id="result" href="#"> <a>' + value.subDivision_name + '</a> </li><li class="list-group-item" id="result" href="#"> <a>' + value.subDivision_id + '</a> </li>';
                            $('#dynamic-row').append($tableRow);
                        });
                        break;

                    case 2:
                        // code block
                        console.log(index);
                        console.log('switch 2');
                        $.each(object, function (index, value) {
                            $tableRow = '<li class="list-group-item" id="result" href="#"> <a>' + value.category_name + '</a> </li><li class="list-group-item" id="result" href="#"> <a>' + value.category_id + '</a> </li>';
                            $('#dynamic-row').append($tableRow);
                        });
                        break;

                    case 3:
                        console.log(index);
                        console.log('switch 3');
                        $.each(object, function (index, value) {
                            $tableRow = '<li class="list-group-item" id="result" href="#"> <a>' + value.subCategory_name + '</a> </li><li class="list-group-item" id="result" href="#"> <a>' + value.subCategory_id + '</a> </li>';
                            $('#dynamic-row').append($tableRow);
                        });
                        break;

                    case 4:
                        console.log(index);
                        console.log('switch 4');
                        $.each(object, function (index, value) {
                            $tableRow = '<li class="list-group-item" id="result" href="#"> <a>' + value.item_code + '</a> </li>';
                            $('#dynamic-row').append($tableRow);
                        });
                        break;
                }
                $('body').on('click', '#result', function () {
                    console.log('clicked');
                    $('#searchValue').val($(this).text());
                    $('#dynamic-row').fadeOut();
                });

            });

        }
    });

});




