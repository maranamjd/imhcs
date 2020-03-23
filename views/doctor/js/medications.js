$(document).ready(function(){
  $('#medication_table').DataTable();

  $(document).on('click', '#add', function(){
    $('#patient').val('');
    $('#patient_name').val('');
    $('#medicine').html('<option value="" selected disabled>- Select -</option>');
    $('#checkups').val('');
    $('#checkups').attr('disabled', false);
    $('#quantity').val(1);
    $('#process').val('add');
    $('#matches').hide();
    $('#main_content').attr('class', 'col-lg-5');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('click', '#close', function(){
    $('#main_content').attr('class', 'col-lg-9');
    $('#secondary_content').attr('class', 'col-lg-4 hidden');
  });

  $(document).on('click', '#edit', function(){
    let me = $(this);
    $('#process').val('edit');
    $('#process').attr('data-id', me.attr('data-id'));
    $.ajax({
      url: url+'medication/edit',
      method: 'post',
      dataType: 'json',
      data: {id: me.attr('data-id')},
      success: function(data){
        $('#patient').val(data['lastname']+', '+data['firstname']);
        $('#patient_id').val(data['patient_id']);
        $('#checkups').val(data['checkup_id']);
        $('#checkups').prop('disabled', true);
        getMedicines(data['checkup_id']);
        $('#medicine').val(data['med_id']);
        $('#quantity').val(data['quantity']);
      }
    });

    $('#patient').prop('disabled', true);
    $('#main_content').attr('class', 'col-lg-5');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('submit', '#medication_form', function(e){
    e.preventDefault();
    if ($('#process').val() == 'add') {
      Swal.fire({
        title: 'Continue?',
        text: 'you are about to request a new medication...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('patient_id', $('#patient_id').val());
          formData.append('checkup_id', $('#checkups').val());
          formData.append('med_id', $('#medicine').val());
          formData.append('quantity', $('#quantity').val());
          $.ajax({
            url: url+'medication/create',
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
          formData.append('med_id', $('#medicine').val());
          formData.append('quantity', $('#quantity').val());
          $.ajax({
            url: url+'medication/update',
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
      text: 'you are about to cancel Medication request...',
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
          url: url+'medication/update',
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
                title: "Failed to Cancel request!",
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

  $(document).on("change", "#checkups", function(){
    getMedicines($(this).val());
  });

  function getMedicines(id){
    $.ajax({
      url: url+'medicine/get',
      method: 'post',
      dataType: 'json',
      data: {id: id},
      success: function(data){
        appendSelect(data);
      }
    });
  }

  const appendSelect = data => {
    let html = '<option value="" disabled selected>- Select -</option>';
    if (data.length > 0) {
      html += data.map(medicine => `
        <option value="${medicine.med_id}">${medicine.name}</option>
      `).join('');
    }
    $('#medicine').html(html);
  }

});
