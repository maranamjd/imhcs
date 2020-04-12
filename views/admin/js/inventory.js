$(document).ready(function(){
  $('#main_table').DataTable();

  $(document).on('click', '#add', function(){
    $('#quantity').val('100');
    $('#supplier').val('');
    $('#process').attr('data-id', $(this).attr('data-id'));
    $('#process').val('add');
    $('#main_content').attr('class', 'col-lg-8');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('click', '#close', function(){
    $('#main_content').attr('class', 'col-lg-12');
    $('#secondary_content').attr('class', 'col-lg-4 hidden');
  });


  $(document).on('submit', '#medicine_form', function(e){
    e.preventDefault();
    if ($('#process').val() == 'add') {
      Swal.fire({
        title: 'Continue?',
        text: 'you are about to add a new record...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('med_id', $('#process').attr('data-id'));
          formData.append('quantity', $('#quantity').val());
          formData.append('supplier_id', $('#supplier').val());
          $.ajax({
            url: url+'med_supply/add',
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
                    window.location.reload();
                  }
                });
              }else {
                Swal.fire({
                  title: "Failed to Add!",
                  text: data['message'],
                  type: 'error'
                });
              }
              // console.log(data);
            }
          });
        }
      });
    }
  });


});
