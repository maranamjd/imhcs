$(document).ready(function(){

  // Swal.fire({
  //   title: "Failed to delete!",
  //   text: url,
  //   type: 'error'
  // });

  $(document).on('submit', '#login_form', function(e){
    e.preventDefault();
    let username = $('#username').val();
    let password = $('#password').val();
    $.ajax({
      url: url+'user/login',
      method: 'post',
      dataType: 'json',
      data: {username: username, password: password},
      success: function(data){
        console.log(data);
        if (data['res'] == 1) {
          Swal.fire({
            title: 'Login Successful!',
            text: 'redirecting...',
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
            title: "Login Failed!",
            text: data['message'],
            type: 'error'
          });
        }
      }
    });
  });


});
