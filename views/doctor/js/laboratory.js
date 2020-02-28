$(document).ready(function(){
  $('#medication_table').DataTable();

  $(document).on('click', '#add', function(){
    $('#patient').val('');
    $('#patient_name').val('');
    $('#medicine').val('');
    $('#quantity').val(1);
    $('#process').val('add');
    $('#matches').hide();
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
      url: url+'lab_request/edit',
      method: 'post',
      dataType: 'json',
      data: {id: me.attr('data-id')},
      success: function(data){
        $('#patient').val(data['lastname']+', '+data['firstname']);
        $('#patient_id').val(data['patient_id']);
        $('#laboratory').val(data['lab_id']);
        $('#note').val(data['note']);
      }
    });

    $('#patient').prop('disabled', true);
    $('#main_content').attr('class', 'col-lg-8');
    $('#secondary_content').attr('class', 'col-lg-4 visible');
  });

  $(document).on('submit', '#lab_form', function(e){
    e.preventDefault();
    if ($('#process').val() == 'add') {
      Swal.fire({
        title: 'Continue?',
        text: 'you are about to request a new Laboratory Test...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('patient_id', $('#patient_id').val());
          formData.append('lab_id', $('#laboratory').val());
          formData.append('note', $('#note').val());
          $.ajax({
            url: url+'lab_request/create',
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
        text: 'you are about to update an existing Laboratory Request...',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append('type', '1');
          formData.append('id', $('#process').attr('data-id'));
          formData.append('lab_id', $('#laboratory').val());
          formData.append('note', $('#note').val());
          $.ajax({
            url: url+'lab_request/update',
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
      text: 'you are about to cancel Laboratory Test request...',
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
          url: url+'lab_request/update',
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



  $(document).on('input', '#patient', function(){
  if ($(this).val() != '') {
    $.ajax({
      url: url+'patient/search',
      method: 'post',
      dataType: 'json',
      data: {key: $(this).val()},
      success: function(data){
        $('#matches').attr('style', 'display: ');
        outputHtml(data);
      }
    });
  }else {
    $('#matches').html('');
    $('#matches').attr('style', 'display: none');
  }
});

const outputHtml = data => {
  let html = '';
  if (data.length > 0) {
    html += data.map(patient => `
      <a class="patient_match">
        <span style="display:none" class="patient_id">${patient.patient_id}</span>
        <div class="mb-1 mt-1">
          <div class="row">
            <div class="col-md-10">
              <h3 class="patient_name">${patient.name}</h3>
              <h6><span class='text-muted'>Address:</span> ${patient.address}</h6>
              <h6><span class='text-muted'>Birthdate:</span> ${patient.birthdate}</h6>
            </div>
          </div>
        </div>
      </a>
    `).join('');
  }
  $('#matches').html(html);
}

$(document).on('click', '.patient_match', function(){
  $('#patient').val($(this).find('.patient_name').text());
  $('#patient_id').val($(this).find('.patient_id').text());
  $('#matches').hide();
});

});
