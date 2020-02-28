$(document).ready(function(){
  $('#medication_table').DataTable();


  $(document).on('click', '#fulfill', function(e){
    Swal.fire({
      title: 'Continue?',
      text: 'you are about to update Medication request...',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        let formData = new FormData();
        formData.append('type', '3');
        formData.append('id', $(this).attr('data-id'));
        formData.append('status', '1');
        $.ajax({
          url: url+'medication/update',
          method: 'post',
          dataType: 'json',
          data: formData,
          processData: false,
          contentType: false,
          success: function(data){
            console.log(data);
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
                  window.location.reload();
                }
              });
            }else {
              Swal.fire({
                title: "Failed to Update request!",
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
