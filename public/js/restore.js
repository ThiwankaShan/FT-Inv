$(document).on('click', 'a.restore_item', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
  
    Swal.fire({
        text: 'This Item Will Be Active One...',
        title: 'Are You Sure?',
        icon: 'warning',
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText : 'Restore',
 
    }).then(function(result){
     
      if(result.isConfirmed){
        console.log('Restore button fired');
        $.ajax({
        method: "GET",
        url: $this.attr('href'),
        success: function (res) {
            
              window.open('/home?restore=true', '_self');
              $(window).scrollTop($('#'+res.id).position().top)
            
        }
      });

      }
    })
  
});