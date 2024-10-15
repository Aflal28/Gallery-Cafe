<?php

@include 'config.php';

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

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `user` WHERE id = $delete_id") or die('query failed');
    if ($delete_query) {
        header('location:user.php');
        $message[] = 'User has been deleted';
    } else {
        header('location:staff.php');
        $message[] = 'User could not be deleted';
    }
}

if (isset($_POST['update_user'])) {
    $update_s_id = $_POST['update_user_id'];
    $update_s_name = $_POST['update_user_name'];
    $update_s_email = $_POST['update_user_email'];
    $update_s_phone = $_POST['update_user_phone'];
    $update_s_address = $_POST['update_user_address'];
    $update_s_username = $_POST['update_user_username'];
    $update_s_password = $_POST['update_user_password'];
    $update_s_conformpassword = $_POST['update_user_conformpassword'];
    
    if ($update_s_password != $update_s_conformpassword) {
        $message[] = 'Passwords do not match';
    } else {
        $update_query = mysqli_query($conn, "UPDATE `user` SET uname = '$update_s_name', uemail = '$update_s_email', uphone = '$update_s_phone', uaddress = '$update_s_address', uusername = '$update_s_username', upassword = '$update_s_password', uconformpassword = '$update_s_conformpassword' WHERE id = '$update_s_id'");
        
        if ($update_query) {
            $message[] = 'User updated successfully';
            header('location:user.php');
        } else {
            $message[] = 'User could not be updated';
            header('location:staff.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admins.css">
 
</head>
<body>

<?php

if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message"><span>' . htmlspecialchars($msg) . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
}

?>

<?php include 'header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form">
   <h3>Add a new user</h3>
   <input type="text" name="user_name" placeholder="Enter the user name" class="box" required>
   <input type="email" name="user_email" placeholder="Enter the user email" class="box" required>
   <input type="text" name="user_phone" placeholder="Enter the user phone number" class="box" required>
   <input type="text" name="user_address" placeholder="Enter the user address" class="box" required>
   <input type="text" name="user_username" placeholder="Enter the user username" class="box" required>
   <input type="password" name="user_password" placeholder="Enter the password" class="box" required>
   <input type="password" name="user_conformpassword" placeholder="Enter the confirm password" class="box" required>
   <input type="submit" value="Add user" name="adduser" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>
      <thead>
         <th>Name</th>
         <th>Email</th>
         <th>Phone Number</th>
         <th>Address</th>
         <th>Username</th>
         <th>Password</th>
         <th>Confirm Password</th>
         <th>Action</th>
      </thead>
      <tbody>
         <?php
         
            $select_user = mysqli_query($conn, "SELECT * FROM `user`");
            if (mysqli_num_rows($select_user) > 0) {
                while ($row = mysqli_fetch_assoc($select_user)) {
         ?>
         <tr>
            <td><?php echo htmlspecialchars($row['uname']); ?></td>
            <td><?php echo htmlspecialchars($row['uemail']); ?></td>
            <td><?php echo htmlspecialchars($row['uphone']); ?></td>
            <td><?php echo htmlspecialchars($row['uaddress']); ?></td>
            <td><?php echo htmlspecialchars($row['uusername']); ?></td>
            <td><?php echo htmlspecialchars($row['upassword']); ?></td>
            <td><?php echo htmlspecialchars($row['uconformpassword']); ?></td>
            <td>
               <a href="user.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa-solid fa-trash-can"></i> delete </a>
               <a href="user.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fa-solid fa-pen-to-square"></i> update </a>
            </td>
         </tr>
         <?php
                }
            } else {
                echo "<div class='empty'>No user added</div>";
            }
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if (isset($_GET['edit'])) {
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `user` WHERE id = $edit_id");
      if (mysqli_num_rows($edit_query) > 0) {
         while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
   ?>
   <form action="" method="post">
      <input type="hidden" name="update_user_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_user_name" value="<?php echo htmlspecialchars($fetch_edit['uname']); ?>">
      <input type="email" class="box" required name="update_user_email" value="<?php echo htmlspecialchars($fetch_edit['uemail']); ?>">
      <input type="text" class="box" required name="update_user_phone" value="<?php echo htmlspecialchars($fetch_edit['uphone']); ?>">
      <input type="text" class="box" required name="update_user_address" value="<?php echo htmlspecialchars($fetch_edit['uaddress']); ?>">
      <input type="text" class="box" required name="update_user_username" value="<?php echo htmlspecialchars($fetch_edit['uusername']); ?>">
      <input type="password" class="box" required name="update_user_password" value="<?php echo htmlspecialchars($fetch_edit['upassword']); ?>">
      <input type="password" class="box" required name="update_user_conformpassword" value="<?php echo htmlspecialchars($fetch_edit['uconformpassword']); ?>">
      <input type="submit" value="Update user" name="update_user" class="btn">
      <a value="cancel" id="close-edit" class="option-btn" href="admin.php" >cancel</a>

   </form>
   <?php
            }
         }
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      }
   ?>
</section>

</div>

<!-- custom js file link  -->

<script src="js/script.js"></script>

</body>
</html
