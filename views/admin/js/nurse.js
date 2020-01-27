$(document).ready(function(){
  $('#main_table').DataTable();

  $(document).on('click', '#add', function(){
    $('#firstname').val('');
    $('#middlename').val('');
    $('#lastname').val('');
    $('#address').val('');
    $('#email').val('');
    $('#birthdate').val('');
    $('#contact_number').val('');
    $('#sex').val('');
    $('#process').val('add');
    $('#main_content').attr('class', 'col-lg-8');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('click', '#close', function(){
    $('#main_content').attr('class', 'col-lg-12');
    $('#secondary_content').attr('class', 'col-lg-4 hidden');
  });

  $(document).on('click', '#edit', function(){
    let me = $(this);
    $('#process').val('edit');
    $.ajax({
      url: url+'user/edit',
      method: 'post',
      dataType: 'json',
      data: {id: me.attr('data-id')},
      success: function(data){
        $('#firstname').val(data['firstname']);
        $('#middlename').val(data['middlename']);
        $('#lastname').val(data['lastname']);
        $('#address').val(data['address']);
        $('#email').val(data['email']);
        $('#birthdate').val(data['birthdate']);
        $('#contact_number').val(data['contact_info']);
        $('#sex').val(data['sex']);
        $('#email').prop('disabled', true);
        $('#contact_number').prop('disabled', true);
        $('#process').attr('data-id', data['user_id']);
      }
    });

    $('#main_content').attr('class', 'col-lg-8');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('submit', '#patient_form', function(e){
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
          formData.append('firstname', $('#firstname').val());
          formData.append('middlename', $('#middlename').val());
          formData.append('lastname', $('#lastname').val());
          formData.append('user_type', '2');
          formData.append('address', $('#address').val());
          formData.append('email', $('#email').val());
          formData.append('birthdate', $('#birthdate').val());
          formData.append('contact_number', $('#contact_number').val());
          formData.append('sex', $('#sex').val());
          $.ajax({
            url: url+'user/create',
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
    }else {
      Swal.fire({
        title: 'Continue?',
        text: 'you are about to update an existing record...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('type', '1');
          formData.append('id', $('#process').attr('data-id'));
          formData.append('firstname', $('#firstname').val());
          formData.append('middlename', $('#middlename').val());
          formData.append('lastname', $('#lastname').val());
          formData.append('address', $('#address').val());
          formData.append('birthdate', $('#birthdate').val());
          formData.append('sex', $('#sex').val());
          $.ajax({
            url: url+'user/update',
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
                  title: "Failed to Update!",
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

  $(document).on('click', '#delete', function(e){
    Swal.fire({
      title: 'Continue?',
      text: 'you are about to delete an existing record...',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        let formData = new FormData();
        formData.append('type', '2');
        formData.append('id', $(this).attr('data-id'));
        $.ajax({
          url: url+'user/update',
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
