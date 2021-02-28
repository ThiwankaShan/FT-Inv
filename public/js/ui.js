$(function () {
  $(document).click(function (event) {
    $('.collapse').collapse('hide');
  });

});

$(function () {
  $('.dropdown-toggle').click(function (event) {
    $('.collapse').collapse('show');
  });
});

// side bar toggle
$(function () {
  $('.content-body').click(function (event) {
    console.log('body clicked');
    $('#sidebar').addClass('active');
  });
});