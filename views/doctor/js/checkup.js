$(document).ready(function(){
  $(document).on('click', '#new', function(){
    $('#blood_pressure').val("");
    $('#temperature').val("");
    $('#pulse_rate').val("");
    $('#respiration_rate').val("");
    $('#weight').val("");
    $('#height').val("");
    $('#symptoms').val("");
    $('#diagnosis').val("");
    $('#notes').val("");
    $('#history').attr('style', 'display: none');
    $('#new_checkup').attr('style', 'display: block');
    $('#process').val('add');
  });

  $(document).on('click', '#close', function(){
    $('#new_checkup').attr('style', 'display: none');
    $('#history').attr('style', 'display: block');
  });

  $(document).on('click', '#new_prescription', function(){
    let dom = $(this).attr('data-id');
    $('#prescription_process').val('add')
    $('#medicine_'+dom).val('');
    $('#no_days_'+dom).val('1');
    $('#intake_schedule_'+dom).val('');
    $('#before_meal_'+dom).val('');
    $('#main_prescription_'+dom).attr('style', 'display: none');
    $('#add_prescription_'+dom).attr('style', 'display: block');
  });

  $(document).on('click', '#close_prescription', function(){
    let dom = $(this).attr('data-id');
    $('#add_prescription_'+dom).attr('style', 'display: none');
    $('#main_prescription_'+dom).attr('style', 'display: block');
  });

//prescription
$(document).on('click', '#prescription_edit', function(){
  let me = $(this);
  $('#prescription_process').val('edit');
  $.ajax({
    url: url+'prescription/edit',
    method: 'post',
    dataType: 'json',
    data: {id: me.attr('data-id')},
    success: function(data){
      $('#medicine_'+data['checkup_id']).val(data['med_id']);
      $('#no_days_'+data['checkup_id']).val(data['no_days']);
      $('#intake_schedule_'+data['checkup_id']).val(data['intake_schedule']);
      $('#before_meal_'+data['checkup_id']).val(data['before_meal']);
      $('#main_prescription_'+data['checkup_id']).attr('style', 'display: none');
      $('#add_prescription_'+data['checkup_id']).attr('style', 'display: block');
      $('#prescription_process').attr('data-id', data['id']);
    }
  });

});

$('.prescription_form').submit(function(e){
  e.preventDefault();
  if ($('#prescription_process').val() == 'add') {
    let form = $(this).serializeArray();
    let data = {};
    form.forEach(function(entry){
      data[entry.name] = entry.value;
    });
    Swal.fire({
      title: 'Continue?',
      text: 'you are about to add a new record...',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url+'prescription/create',
          method: 'post',
          dataType: 'json',
          data: data,
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
    let form = $(this).serializeArray();
    let data = {};
    form.forEach(function(entry){
      data[entry.name] = entry.value;
    });
    data['type'] = '1';
    data['id'] = $('#prescription_process').attr('data-id');
    Swal.fire({
      title: 'Continue?',
      text: 'you are about to update an existing record...',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url+'prescription/update',
          method: 'post',
          dataType: 'json',
          data: data,
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

$(document).on('click', '#prescription_delete', function(e){
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
        url: url+'prescription/update',
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

/////////////////////////////////////////////////////////


//checkup
  $(document).on('click', '#edit', function(){
    let me = $(this);
    $('#process').val('edit');
    $.ajax({
      url: url+'checkup/edit',
      method: 'post',
      dataType: 'json',
      data: {id: me.attr('data-id')},
      success: function(data){
        $('#blood_pressure').val(data['blood_pressure']);
        $('#temperature').val(data['temperature']);
        $('#pulse_rate').val(data['pulse_rate']);
        $('#respiration_rate').val(data['respiration_rate']);
        $('#weight').val(data['weight']);
        $('#height').val(data['height']);
        $('#symptoms').val(data['symptoms']);
        $('#diagnosis').val(data['diagnosis']);
        $('#notes').val(data['notes']);
        $('#process').attr('data-id', data['checkup_id']);
      }
    });
    $('#history').attr('style', 'display: none');
    $('#new_checkup').attr('style', 'display: block');
  });

  $(document).on('submit', '#checkup_form', function(e){
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
          formData.append('blood_pressure', $('#blood_pressure').val());
          formData.append('temperature', $('#temperature').val());
          formData.append('pulse_rate', $('#pulse_rate').val());
          formData.append('respiration_rate', $('#respiration_rate').val());
          formData.append('weight', $('#weight').val());
          formData.append('height', $('#height').val());
          formData.append('symptoms', $('#symptoms').val());
          formData.append('diagnosis', $('#diagnosis').val());
          formData.append('notes', $('#notes').val());
          formData.append('patient_id', $('#patient_id').val());
          $.ajax({
            url: url+'checkup/create',
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
          formData.append('blood_pressure', $('#blood_pressure').val());
          formData.append('temperature', $('#temperature').val());
          formData.append('pulse_rate', $('#pulse_rate').val());
          formData.append('respiration_rate', $('#respiration_rate').val());
          formData.append('weight', $('#weight').val());
          formData.append('height', $('#height').val());
          formData.append('symptoms', $('#symptoms').val());
          formData.append('diagnosis', $('#diagnosis').val());
          formData.append('notes', $('#notes').val());
          formData.append('patient_id', $('#patient_id').val());
          $.ajax({
            url: url+'checkup/update',
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
          url: url+'checkup/update',
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
