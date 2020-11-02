$(document).on('click', 'a.delete-item', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var token=$this.attr('token');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: {
            cancel: true,
            confirm: true,
          },
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    }).then(function(result){
      if(result){

        $.ajax({
        method: $this.data('method'),
        url: $this.attr('href'),
        data: {
            _token:token,
        },
        success: function (res) {
          location.reload(true);
        }
      });

      }
    })
  
});