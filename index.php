<?php require_once 'header.php ' ?>

<body>
  <div class="main">
    <div class="container">
      <form class="form" method="" action="" id="loginForm">
        <span class="bmd-form-group">
            <div class="input-group">
                <input type="text" name="email" placeholder="Email...">
            </div>    
            <small class="text-danger ml-5" id="emailError"></small>
        </span>
        <span class="bmd-form-group">
            <div class="input-group">
                <input type="password" name="password" placeholder="Password...">
            </div>
            <small class="text-danger ml-5" id="passwordError"></small>
        </span>
        <div class="card-footer justify-content-center">
            <button class="btnn btn-dark"  type="submit" id="Sign_in">Sign in</button>
        </div>
        <p class="link">Don't have an account?<br>
        <a href="#"  type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up here</a></p>
      </form>
    </div>
    <div class="modal fade " id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="formm" id="registrationForm" method="" action="">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="first_name" id="first_name" onchange="fillUsername()" placeholder="Emri">
                                    <small id="first_nameError" class="text-danger"></small>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last_name" id="last_name" onchange="fillUsername()" placeholder="Mbiemri">
                                    <small id="last_nameError" class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="atesia" id="atesia" placeholder="Atesia"
                                required="required">
                            <small id="atesiaError" class="text-danger"></small>
                        </div>
                        <div class="input-group mb-3">
                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="06..." maxlength=10 pattern="[0-9]{10}" required="required">
                            <small id="phoneError" class="text-danger"></small>
                        </div>
                        <div class="mb-3 flatpickr">
                            <input type="text" id="birthday" name="birthday" class="form-control" placeholder="Datelindja"
                                autocomplete="off" required="required">
                            <small id="birthdayError" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                required="required">
                            <small id="emailError" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                                required="required">
                            <small id="passwordError" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Verify"
                                required="required">
                            <small id="cpasswordError" class="text-danger"></small>
                        </div>
                        <div class="modal-footer">
                            
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-primary" id="Signup">Register</button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>



  <script>

    $("#birthday").flatpickr({
        enableTime: false,
        minDate: "1950-01",
        maxDate: "today"
    });
  </script>

  <script>
    function fillUsername() {
      let first_name = $('#first_name').val();
      let last_name = $('#last_name').val();
      let name_regex = /^[A-Za-z\s]+$/;
      if (name_regex.test(first_name) && name_regex.test(last_name)) {
        $('#username').val((first_name[0] + last_name).toLowerCase());
      }
    }
  </script>

  <script>
    $('#loginForm').on('submit', function(e) {
      console.log("Message");  
      e.preventDefault();
      var data = new FormData($(this)[0]);
      data.append('action', 'login');
      var form = $(this);
      form.find(':submit').attr('disabled', true);
      var url = "ajax.php";
      for (var pair of data.entries()){
        console.log(pair[0]+ ', ' + pair[1]);
      }
      $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        error: function(xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
        },
        success: function(response) {
          console.log(response);
          form.find(':submit').attr('disabled', false);
          if (response.error_status == 1) {
            form.find('small').text('');
            // If validation error exists
            for (var key in response) {
              var errorContainer = form.find(`#${key}Error`);
              if (errorContainer.length !== 0) {
                errorContainer.html(response[key]);
              }
            }
          }
          if (response.status == 1) {
            form.trigger('reset');
            form.find('small').text('');
            // handling success response
            //swal('Success', response.msg);
            console.log('header');
            window.location.replace("/phploginsystem/profile.php");

          } else if (response.status == 0) {
            // Handling failure response
            toastr.error(response.msg);
          }
        }
      });
    });
  </script>

  <script>
    $('#Signup').click( function(e) {
      console.log("reg Message");
      e.preventDefault();
      var data = new FormData($('#registrationForm')[0]);
      data.append('action', 'register');
      var form = $('#registrationForm');
      form.find(':submit').attr('disabled', true);
      var url = "ajax.php";
      for (var pair of data.entries()){
        console.log(pair[0]+ ', ' + pair[1]);
      }
      $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        error: function(xhr, textStatus, errorThrown) {
          console.log(xhr.responseText);
        },
        success: function(response) {
          form.find(':submit').attr('disabled', false);
          $('input').removeClass('border-danger');
          if (response.error_status == 1) {
            form.find('small').text('');
            form.find('input').addClass('border-success');
            // If validation error exists
            for (var key in response) {
              var errorContainer = form.find(`#${key}Error`);
              if (errorContainer.length !== 0) {
                errorContainer.html(response[key]);
                console.log(key);
                $('#'+key).addClass('border border-danger');
              }
            }
          }
          if (response.status == 1) {
            form.trigger('reset');
            form.find('small').text('');
            // handling success respone
            toastr.success(response.msg);
            setTimeout(function() {
              window.location.href = '/phploginsystem/profile.php'
            })
          } else if (response.status == 0) {
            // Handling failure response
            toastr.error(response.msg);
          }
        }
      });
    });
  </script>
</body>

</html>