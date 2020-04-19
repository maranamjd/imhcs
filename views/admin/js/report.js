$(document).ready(function(){

  $(document).on('submit', '#report_form', function(e){
    e.preventDefault();
    window.open(url+'report/'+$('#report').val(), '__blank');
  });

});
