<div class="modal fade " id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                                            placeholder="Emri" required="required" onchange="fillUsername()">
                                        <small id="first_nameError" class="text-danger"></small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                                            placeholder="Mbiemri" required="required" onchange="fillUsername()">
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
                            <div class="mb-3" id="demo">
                                <input type="text" id="birthday" name="birthday" class="form-control" placeholder="Datelindja"
                                    autocomplete="off" required="required">
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
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <button type="button" class="btn btn-secondary col" data-bs-dismiss="modal">Close</button>
                                <button type="button" onclick="signup()" class="btn btn-primary col" id="signup">Register</button>
                            </div>
                        </div>

            </div>
        </div>


<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Login</h1>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                    <div>
                        <input type="email" class="form-control input-lg" name="email" value="">
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success">Login</button>

                            <a class="btn btn-link" href="">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
                <h1>Or Signup!</h1>
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Confirm Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php 
require_once 'header.php'
?>
<style>
    body, html {
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.5)50%, rgba(0,0,0,0.5)50%), url(img/1.jpg);
        background-position: center;
        background-size: cover;
        height: 100vh;
    }
</style>
<body>
  
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
            <button class="btn"  type="submit" id="Sign_in">Sign in</button>
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
                        <div class="form-group">
                            <div class="row">
                                <button type="button" class="btn btn-secondary col" data-bs-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-primary col" id="Sign_up">Register</button>
                            </div>
                        </div>
                    </form>
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
    $('#Sign_in').click( function(e) {
      console.log("login Message");  
      e.preventDefault();
      var data = new FormData($('#loginForm')[0]);
      data.append('action', 'login');
      var form = $('#loginForm');
      form.find(':submit').attr('disabled', true);
      var url = "/phploginsystem/ajax.php";
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
            window.location.href = "profile.php";

          } else if (response.status == 0) {
            // Handling failure response
            toastr.error(response.msg);
          }
        }
      });
    });
  </script>

  <script>
    $('#Sign_up').click( function(e) {
      console.log("Message");
      e.preventDefault();
      var data = new FormData($('#registrationForm')[0]);
      data.append('action', 'register');
      var form = $('#registrationForm');
      form.find(':submit').attr('disabled', true);
      var url = "/phploginsystem/ajax.php";
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
            $('input').addClass('border-success');
            //console.log(response);
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

<?php
if (isset($_POST['action']) == 'login') {
    include 'db_conn.php';
    $password = $_POST['password'];
    $email = $_POST['email'];

    // validation
    $error = array(
        'error_status' => 0
    );
    if (empty($email)) {
        $error['error_status'] = 1;
        $error['email'] = 'Email is required!';
    }
    if (empty($password)) {
        $error['error_status'] = 1;
        $error['password'] = 'Password is required!';
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    // if validation is successful
    $hashed_password = md5($password);
    $qry = "Select * from users where (email = '" . $email . "' or phone = '" . $email . "') and password = '" . $hashed_password . "'";
    $result = $conn->query($qry);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // user exists
        session_start();
        $_SESSION['user_data'] = $row;

        $response = array(
        'status' => 1,
        'msg' => 'Login successful'
        );
    } else {
        $response = array(
        'status' => 0,
        'msg' => 'Invalid Credentials'
        );
    }
    echo json_encode($response);
    exit();
}
elseif (isset($_GET['action']) == 'logout') {
    session_start();
    session_destroy();
    header('Location: /phploginsystem/login.php');
}

elseif (isset($_POST['action']) == 'register'){
    require_once "db_conn.php";
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $atesia = mysqli_real_escape_string($conn, $_POST['atesia']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $image = 'img/avatar.jpg';
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);

    $error = array(
    'error_status' => 0
    );
    if (empty($first_name)) {
    $error['error_status'] = 1;
    $error['first_name'] = 'Vendosni emrin!';
    }
    if (!empty($first_name)) {
        if(!preg_match("/^[a-zA-Z]*$/",$first_name)){
            $error['error_status'] = 1;
            $error['first_name'] = 'Emri nuk mund te permbaje numra!';
        }
    }
    if (empty($last_name)) {
    $error['error_status'] = 1;
    $error['last_name'] = 'Vendosni mbiemrin!';
    }
    if (!empty($last_name)) {
        if(!preg_match("/^[a-zA-Z]*$/",$last_name)){
            $error['error_status'] = 1;
            $error['last_name'] = 'Mbiemri nuk mund te permbaje numra!';
        }
    }
    if (empty($atesia)) {
    $error['error_status'] = 1;
    $error['atesia'] = 'Vendosni atesine!';
    }
    if (!empty($atesia)) {
        if(!preg_match("/^[a-zA-Z]*$/",$atesia)){
            $error['error_status'] = 1;
            $error['atesia'] = 'Atesia nuk mund te permbaje numra!';
        }
    }
    if (empty($phone)) {
    $error['error_status'] = 1;
    $error['phone'] = 'Vendosni numrin e tel!';
    }
    if (!empty($phone)) {
        if (!preg_match("/^(((067|068|069)\d{7})){1}$/",$phone)) {
            $error['error_status'] = 1;
            $error['phone'] = 'Numri tel esht gabim!';
        }
    }
    if (empty($birthday)) {
    $error['error_status'] = 1;
    $error['birthday'] = 'Datelindja is required!';
    }
    if (empty($email)) {
    $error['error_status'] = 1;
    $error['email'] = 'Email is required!';
    }
    if (!empty($email)) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['error_status'] = 1;
            $error['email'] = 'Email i gabuar!';
        }
    }
    if (empty($password)) {
    $error['error_status'] = 1;
    $error['password'] = 'Vendosni fjalekalimin!';
    }
    if (empty($cpassword)) {
    $error['error_status'] = 1;
    $error['cpassword'] = 'Konfirmoni fjalekalimin!';
    }
    if (!empty($password)) {
        if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $password)){
            $error['error_status'] = 1;
            $error['password'] = 'Fjalekalimi duhet te permbaje te pakten nje shkronje te vogel,nje te madhe, nje karakter special dhe minimumi 8 karaktere!';
        }
    }
    if (!empty($password)) {
        if(!empty($cpassword)){
            if($password !== $cpassword){
                $error['error_status'] = 1;
                $error['cpassword'] = 'Fjalekalimi nuk perputhet!';
            }
        }
    }
    $sql = "SELECT * FROM users WHERE email = ? OR phone = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt, "si", $email, $phone);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        $error['error_status'] = 1;
        if($row['phone'] == $phone){
          $error['phone'] = 'Numri tel eshte perdorur!';
        } else{
            $error['email'] = ['Emaili eshte perdorur!'];
        }
    }
    mysqli_stmt_close($stmt);

    if ($error['error_status'] > 0) {
    echo json_encode($error);
    exit();
    }

    $hashed_password = md5($password);
    $roli = 'user';
    $username = strtolower($first_name[0]) . strtolower($last_name);
    $qry = "INSERT INTO users SET first_name = '" . $first_name . "',
                                last_name = '" . $last_name . "',
                                phone = '" . $phone . "',
                                username = '" . $username . "',
                                password = '" . $hashed_password . "',
                                birthday = '" . $birthday . "',
                                email = '" . $email . "',
                                roli = '" . $roli . "',
                                image = '" . $image . "',
                                atesia = '" . $atesia . "'
                                ";
    $result = $conn->query($qry);
  
    if ($result) {
      echo json_encode(array('status' => '1', 'message' => 'U regjistrua me sukses'));
      exit();
    } else {
      $response = array(
        'status' => 0,
        'msg' => 'Registration Failed!'
      );
    }
    echo json_encode($response);
    exit();
}
?>

<?php require_once 'header.php ' ?>

<body>
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="img/avatar.jpg" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">John Smith</h5>
            <p class="text-muted mb-1">Full Stack Developer</p>
            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p class="mb-0">https://mdbootstrap.com</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Johnatan Smith</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">example@example.com</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(097) 234-5678</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(098) 765-4321</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>