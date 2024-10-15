


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animated Login Form</title>
    <link rel="stylesheet" href="adminlogin.css" autocomplete="off">
</head>
<body>
    <div class="box">
        <form action="adminlogin.php" method="POST">
            <h2>Sign in</h2>
            <div class="inputBox">
                <input type="text" name="name" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="pass" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Forgot Password ?</a>
                <a href="#">Signup</a>
            </div>
            <input type="submit" name="submit" value="Login">
           
        </form>
       
    </div>
   
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['name'];
        $password = $_POST['pass'];

        // Create connection
        $con = new mysqli("localhost", "root", "", "shop_db");

        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Use prepared statements to avoid SQL injection
        $stmt = $con->prepare("SELECT * FROM adminlogin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, login successful
            
            header("Location: admin.php");
            exit(); // Ensure no further code is executed
        } else {
            // User not found, login failed
            $invalid= "Invalid username or password";
        }

        $stmt->close();
        $con->close();
    }
    ?>
     <?php if (isset($invalid)): ?>
                <h1 class="error"><?php echo htmlspecialchars($invalid); ?></h1>
            <?php endif; ?>
</body>
</html>
