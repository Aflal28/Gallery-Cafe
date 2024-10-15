
<?php
@include 'config.php';
if (isset($_POST['submit'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];
    $query = mysqli_query($conn, "SELECT * FROM staff WHERE susername='$username' AND spassword='$password'");
    
    if (mysqli_num_rows($query) > 0) {
      $message[] = 'Login successful';
      header('location:staffhome.php');
    
 
    } else {
        $message[] = 'Incorrect username or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stafflogins.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="heading">Log In</div>
    <form action="stafflogin.php" class="form" method="post">
      <input class="input" type="text" name="login_username" id="email" placeholder="username" required>
      <input  class="input" type="password" name="login_password" id="password" placeholder="Password" required>
 
      <input class="login-button" type="submit" name="submit"  value="submit">
      
    </form >
   
   
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