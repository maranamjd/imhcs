$(document).ready(function(){
  $('#patient_table').DataTable();

  $(document).on('click', '#add', function(){
    $('#child_name').val('');
    $('#mother_name').val('');
    $('#father_name').val('');
    $('#address').val('');
    $('#birthdate').val('');
    $('#birth_place').val('');
    $('#birth_height').val('');
    $('#birth_weight').val('');
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
    $('#process').attr('data-id', me.attr('data-id'));
    $.ajax({
      url: url+'immunization_record/edit',
      method: 'post',
      dataType: 'json',
      data: {id: me.attr('data-id')},
      success: function(data){
        $('#child_name').val(data['child_name']);
        $('#mother_name').val(data['mother_name']);
        $('#father_name').val(data['father_name']);
        $('#address').val(data['address']);
        $('#birthdate').val(data['birthdate']);
        $('#birth_place').val(data['birthplace']);
        $('#birth_height').val(data['birth_height']);
        $('#birth_weight').val(data['birth_weight']);
        $('#sex').val(data['sex']);
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
        text: 'you are about to add a new patient...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('child_name', $('#child_name').val());
          formData.append('mother_name', $('#mother_name').val());
          formData.append('father_name', $('#father_name').val());
          formData.append('address', $('#address').val());
          formData.append('birthdate', $('#birthdate').val());
          formData.append('birth_place', $('#birth_place').val());
          formData.append('birth_height', $('#birth_height').val());
          formData.append('birth_weight', $('#birth_weight').val());
          formData.append('sex', $('#sex').val());
          $.ajax({
            url: url+'immunization_record/create',
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
        text: 'you are about to update an existing patient...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('type', '1');
          formData.append('id', $('#process').attr('data-id'));
          formData.append('child_name', $('#child_name').val());
          formData.append('mother_name', $('#mother_name').val());
          formData.append('father_name', $('#father_name').val());
          formData.append('address', $('#address').val());
          formData.append('birthdate', $('#birthdate').val());
          formData.append('birth_place', $('#birth_place').val());
          formData.append('birth_height', $('#birth_height').val());
          formData.append('birth_weight', $('#birth_weight').val());
          formData.append('sex', $('#sex').val());
          $.ajax({
            url: url+'immunization_record/update',
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
      text: 'you are about to delete a patient...',
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
          url: url+'immunization_record/update',
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
