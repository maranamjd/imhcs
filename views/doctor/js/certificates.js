$(document).ready(function(){

  $(document).on('submit', '#referral_form', function(e){
    e.preventDefault();
    $.ajax({
      url: url+'referral/create',
      method: 'post',
      dataType: 'json',
      data: {
        checkup_id: $("#checkups").val(),
        physician: $('#physician_name').val(),
        address: $('#address').val(),
        recommendation: $('#recommendation').val()
      },
      success: function(data){
        window.open(url+'downloads/referral/'+data['id'], '__blank');
      }
    });
  });

  $(document).on('submit', '#medical_form', function(e){
    e.preventDefault();
    window.open(url+'downloads/medcert/'+$("#checkups").val(), '__blank');
  });
  $(document).on('submit', '#fitness_form', function(e){
    e.preventDefault();
    window.open(url+'downloads/fitcert/'+$("#checkups").val(), '__blank');
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
  let id = $(this).find('.patient_id').text();
  $.ajax({
    url: url+'checkup/search',
    method: 'post',
    dataType: 'json',
    data: {key: id},
    success: function(data){
      appendSelect(data);
    }
  });

  $('#patient').val($(this).find('.patient_name').text());
  $('#matches').hide();
});

const appendSelect = data => {
  let html = '<option value="" disabled selected>- Select -</option>';
  if (data.length > 0) {
    html += data.map(checkup => `
      <option value="${checkup.checkup_id}">${checkup.date} - ${checkup.diagnosis}</option>
    `).join('');
    $('#checkups').prop('disabled', false);
  }else {
    html = '<option value="" disabled selected>No Checkup record!!!</option>';
    $('#checkups').prop('disabled', true);
  }
  $('#checkups').html(html);
}

});
