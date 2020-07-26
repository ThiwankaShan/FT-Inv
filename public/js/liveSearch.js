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
