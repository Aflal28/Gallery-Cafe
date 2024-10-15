<?php

@include 'config.php';

// Signup logic
if (isset($_POST['adduser'])) {
    $p_name = $_POST['user_name'];
    $p_email = $_POST['user_email'];
    $p_phone = $_POST['user_phone'];
    $p_address = $_POST['user_address'];
    $p_username = $_POST['user_username'];
    $p_password = $_POST['user_password'];
    $p_conformpassword = $_POST['user_conformpassword'];
    
    $check = mysqli_query($conn, "SELECT * FROM user WHERE uusername='$p_username'");
    
    if (mysqli_num_rows($check) > 0) {
        $message[] = 'Username already taken';
    } elseif ($p_password != $p_conformpassword) {
        $message[] = 'Passwords do not match';
    } else {
        $insert_query = mysqli_query($conn, "INSERT INTO `user` (uname, uemail, uphone, uaddress, uusername, upassword, uconformpassword) VALUES ('$p_name', '$p_email', '$p_phone', '$p_address', '$p_username', '$p_password', '$p_conformpassword')") or die('query failed');
        
        if ($insert_query) {
            $message[] = 'User added successfully';
        } else {
            $message[] = 'Could not add the user';
        }
    }
}


if (isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE uusername='$username' AND upassword='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $message[] = 'Login successful';
    header('location:visitorpage.php');
    } else {
        $message[] = 'Incorrect username or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="usersignup.css" />
  
  <title>Form</title>
</head>
<body>
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
      <label for="tab-1" class="tab">Sign In</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up">
      <label for="tab-2" class="tab">Sign Up</label>
      <div class="login-form">
        <div class="sign-in-htm">
          <form action="" method="post">
            <div class="group">
              <label for="user" class="label">Username</label>
              <input id="user" type="text" class="input" name="login_username" required>
            </div>
            <div class="group">
              <label for="pass" class="label">Password</label>
              <input id="pass" type="password" class="input" name="login_password" data-type="password" required>
            </div>
            <div class="group">
              <input id="check" type="checkbox" class="check" checked>
              <label for="check"><span class="icon"></span> Keep me Signed in</label>
            </div>
            <div class="group">
              <input type="submit" name="login" class="button" value="login">
            </div>
          </form>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div>
        </div>

        <div class="sign-up-htm">
          <form action="" method="post">
            <div class="group">
              <label for="user" class="label">Username</label>
              <input id="user" type="text" name="user_name" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">Email</label>
              <input id="pass" type="email" name="user_email" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">Phone Number</label>
              <input id="pass" type="text" name="user_phone" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">Address</label>
              <input id="pass" type="text" name="user_address" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">User Name</label>
              <input id="pass" type="text" name="user_username" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">Password</label>
              <input id="pass" type="password" name="user_password" class="input" required>
            </div>

            <div class="group">
              <label for="pass" class="label">Confirm Password</label>
              <input id="pass" type="password" name="user_conformpassword" class="input" required>
            </div>

            <div class="group">
              <input type="submit" name="adduser" class="button" value="Sign Up">
            </div>
          </form>
          <div class="hr"></div>
          <div class="foot-lnk">
            <label for="tab-1">Already a Member?</label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($message)) {
      foreach ($message as $msg) {
          echo '<div class="message"><span>' . htmlspecialchars($msg) . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
      }
  }
  ?>
</body>
</html>
