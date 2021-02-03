$(document).on('click', 'a.delete-item', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);
    var token=$this.attr('token');
    Swal.fire({
        text: 'Delete will permanantly delete the record and every dependent record',
        title: 'Disposed record can be restored later',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: `Cancel`,
        denyButtonText: `Delete`,
        confirmButtonText : 'Dispose',
 
    }).then(function(result){
      var force = 'False';
      if(result.isDenied){
        console.log('Delete button fired');
        $.ajax({
        method: $this.data('method'),
        url: $this.attr('href'),
        data: {
            _token:token,
            force : 'True',
        },
        success: function (res) {
          location.reload(true);
        }
      });

      }else if(result.isConfirmed){
        console.log('Disposed button fired');
        $.ajax({
          method: $this.data('method'),
          url: $this.attr('href'),
          data: {
              _token:token,
              force : force,
          },
          success: function (res) {
            location.reload(true);
          }
        });
      }
    })
  
});