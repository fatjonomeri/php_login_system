<?php
require_once "navbar.php";
?>

<body>
    <div class="row">
        <div class="col-md-3 ">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-end">
        <form class="foarm" id="editForm">     
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Ndrysho te dhenat</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Emri</label>
                        <input type="text" class="form-control" placeholder="emri.." id="first_name" name= "first_name" value="">
                        <small id="first_nameError" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Mbiemri</label>
                        <input type="text" class="form-control" id="last_name" name= "last_name"  value="" placeholder="mbiemri..">
                        <small id="last_nameError" class="text-danger"></small>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Numri tel</label>
                        <input type="tel" class="form-control" placeholder="Numri tel.." name="phone" id="phone" value="">
                        <small id="phoneError" class="text-danger"></small>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <input type="email" class="form-control" placeholder="emaili..." name="email" id="email" value="">
                        <small id="emailError" class="text-danger"></small>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btnn profile-button" type="button" id="change">Save changes</button>
                </div>
            </div>
        </form>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Ndrysho fjalekalimin</h4>
                </div><br>
                <form class="foarm" id="passForm">
                <div class="row mt-3">
                    <div class="mb-3 col-md-12">
                        <label class="labels">Fjalekalimi i vjeter</label>
                        <input type="password" class="form-control" placeholder="Fjalekalimi vjeter.." name="oldpass" id="oldpass" value="">
                        <small id="oldpassError" class="text-danger"></small>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="labels">Fjalekalimi i ri</label>
                        <input type="password" class="form-control" placeholder="Fjalekalimi ri.." name="newpass" id="newpass" value="">
                        <small id="newpassError" class="text-danger"></small>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="labels">Konfirmo</label>
                        <input type="password" class="form-control" placeholder="Konfirmo fjalekalimin.." name="cpass" id="cpass" value="">
                        <small id="cpassError" class="text-danger"></small>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btnn profile-button" type="button" id="changepass">Ndrysho fjalekalimin</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<script>

    //mbushja automatike e profilit
    function userFill(userID) {


        $.ajax({

            url: 'ajax.php',
            type: 'POST',
            data: {
                'action': 'fillprofile',
                'userid': userID
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    $('#first_name').val(response.message['first_name']);
                    $('#last_name').val(response.message['last_name']);
                    $('#phone').val(response.message['phone']);
                    $('#email').val(response.message['email']);
                    $('#id').val(response.message['ID']);
                } else {
                    toastr.error(response.message)
                }
            }
            });

    }
    $(document).ready(userFill(<?=$_SESSION['id']?>))

</script>

<script>
    $('#change').click( function(e) {
      console.log("edit Message");
      e.preventDefault();
      var data = new FormData($('#editForm')[0]);
      data.append('action', 'editprofile');
      var form = $('#editForm');
      form.find(':submit').attr('disabled', true);
      var url = "ajax.php";
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
          } else if (response.status == 0) {
              // Handling failure response
              toastr.error(response.msg);
          }
        }
      });
      userFill(<?=$_SESSION['id']?>);
    });
</script>

<script>
    $('#changepass').click( function(e) {
      console.log("pass Message");
      e.preventDefault();
      var data = new FormData($('#passForm')[0]);
      data.append('action', 'editpassword');
      var form = $('#passForm');
      form.find(':submit').attr('disabled', true);
      var url = "ajax.php";
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
          } else if (response.status == 0) {
              // Handling failure response
              toastr.error(response.msg);
          }
        }
      });
      //userFill(<?=$_SESSION['id']?>);
    });
</script>

</body>
</html>