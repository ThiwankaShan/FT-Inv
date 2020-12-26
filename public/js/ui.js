$(function() {
    $(document).click(function (event) {
      $('.collapse').collapse('hide');
    });
    
  });

  $(function() {
    $('.dropdown-toggle').click(function (event) {
      $('.collapse').collapse('show');
    });
  });
 