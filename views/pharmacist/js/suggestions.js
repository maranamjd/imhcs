$(document).ready(function(){
  $('#category_table').DataTable();
  $('#product_table').DataTable();

  $(document).on('submit', '#suggestion_form', function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Continue?',
      text: 'you are about to send a message',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        let formData = new FormData();
        formData.append('name', $('#suggestion_name').val());
        formData.append('email', $('#suggestion_email').val());
        formData.append('message', $('#suggestion_message').val());
        $.ajax({
          url: url+'message/create',
          method: 'post',
          dataType: 'json',
          data: formData,
          processData: false,
          contentType: false,
          success: function(data){
            if (data['res'] == 1) {
              Swal.fire({
                title: data['message'],
                text: '',
                type: 'success',
                timer: 2000,
                position: 'top-end',
                toast: true
              }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                  window.location = url;
                }
              });
            }else {
              Swal.fire({
                title: "Failed to delete!",
                text: data['message'],
                type: 'error'
              });
            }
            // console.log(data);
          }
        });
      }
    });
  });

});
