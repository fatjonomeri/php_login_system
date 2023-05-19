<?php

require_once "db_conn.php";
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'login') {
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
    if ($count === 1) {
        // user exists
        //session_start();
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['atesia'] = $row['atesia'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['roli'] = $row['roli'];
        $_SESSION['birthday'] = $row['birthday'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['id'] = $row['ID'];
        $_SESSION['image'] = $row['image'];
        $_SESSION['username'] = $row['username'];


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
} elseif (isset($_POST['action']) && $_POST['action'] == 'register'){
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
}  elseif ($_POST['action'] == 'fillprofile') {
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    //printArray($id);
    $sql = "SELECT * FROM users WHERE ID='$id'";
    $query_get_user = mysqli_query($conn, $sql);
    if (!$query_get_user) {
        echo json_encode(array('status' => '404', 'message' => 'Error ne databaze' . __LINE__));
    }
    $row = mysqli_fetch_assoc($query_get_user);
    echo json_encode(array('status' => '200', 'message' => $row));
    exit();
} elseif (isset($_POST['action']) && $_POST['action'] == 'editprofile'){
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

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
    if (empty($email)) {
    $error['error_status'] = 1;
    $error['email'] = 'Vendosni emailin!';
    }
    if (!empty($email)) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['error_status'] = 1;
            $error['email'] = 'Email i gabuar!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }

    $username = strtolower($first_name[0]) . strtolower($last_name);
    $query_update_user = "UPDATE users SET first_name = '" . $first_name . "',
                                           last_name = '" . $last_name . "',
                                           phone = '" . $phone . "',
                                           email = '" . $email . "' WHERE ID=".$_SESSION['id']."";
    $result_update_user = mysqli_query($conn, $query_update_user);

    if (!$result_update_user) {
    echo json_encode(array('status' => '0', 'msg' => 'Te dhenat nuk u ndryshuan'));
    exit();
    }
    echo json_encode(array('status' => '1', 'msg' => "Te dhenat u ndryshuan"));
    exit();
} elseif (isset($_POST['action']) && $_POST['action'] == 'editpassword') {
    $id = $_SESSION['id'];
    $old = mysqli_real_escape_string($conn, $_POST['oldpass']);
    $new = mysqli_real_escape_string($conn, $_POST['newpass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

    $error = array(
    'error_status' => 0
    );
    if (empty($old)) {
    $error['error_status'] = 1;
    $error['oldpass'] = 'Vendosni fjalekalimin e vjeter!';
    }
    if (empty($new)) {
    $error['error_status'] = 1;
    $error['newpass'] = 'Vendos fjalekalimin e ri!';
    }
    if (empty($cpass)) {
    $error['error_status'] = 1;
    $error['cpass'] = 'Konfirmo fjalekalimin e ri!';
    }
    if(!empty($newpass)){
        if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $newpass)) {
            $error['error_status'] = 1;
            $error['cpass'] = 'Fjalekalimi duhet te permbaje te pakten nje shkronje te vogel,nje te madhe, nje karakter special dhe minimumi 8 karaktere!';
        }
    }  
    if(!empty($cpass)){
        if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $cpass)) {
            $error['error_status'] = 1;
            $error['cpass'] = 'Fjalekalimi duhet te permbaje te pakten nje shkronje te vogel,nje te madhe, nje karakter special dhe minimumi 8 karaktere!';
        }
    }   
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    } 

    $newhash = md5($new);

    $query_get_data = "SELECT password
                              FROM users WHERE ID='$id'";
    $result = mysqli_query($conn, $query_get_data);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (md5($old) == $row['password']) {
            if (md5($new) == md5($cpass) && md5($old) != md5($new)) {
                $query_update_password = "UPDATE users SET password = '" . $newhash . "'
                                                WHERE ID='$id'";
                $result_update_password = mysqli_query($conn, $query_update_password);

                if (!$result_update_password) {
                    echo json_encode(array('status' => '0', 'msg' => 'Error ne databaze'));
                    exit();
                } else{
                echo json_encode(array('status' => '1', 'msg' => "Passwordi u  ndryshua me sukses"));
                exit();
                }
            } 
            elseif (md5($new) == md5($old)) {
                $error['error_status'] = 1;
                $error['newpass'] = 'Fjalekalimi ri duhet te jete i ndryshem nga i vjetri';
            } 
            elseif (md5($new) != md5($cpass)) {
                $error['error_status'] = 1;
                $error['cpass'] = 'Fjalekalimet nuk perputhen!';
            }
        }
        else{
            $error['error_status'] = 1;
            $error['oldpass'] = 'Fjalekalim i gabuar!';
        }
    }
    if ($error['error_status'] > 0) {
      echo json_encode($error);
      exit();
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'adduser'){
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $atesia = mysqli_real_escape_string($conn, $_POST['atesia']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $roli = mysqli_real_escape_string($conn, $_POST['addroli']);
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
    if ($roli != 'admin' && $roli != 'user') {
    $error['error_status'] = 1;
    $error['addroli'] = 'Zgjidhni nje rol!';
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