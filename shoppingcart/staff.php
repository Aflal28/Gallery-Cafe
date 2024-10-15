<?php

@include 'config.php';

if(isset($_POST['addstaff'])){
   $p_name = $_POST['staff_name'];
   $p_email = $_POST['staff_email'];
   $p_phone = $_POST['staff_phone'];
   $p_address = $_POST['staff_address'];
   $p_username= $_POST['staff_username'];
   $p_password = $_POST['staff_password'];

   $insert_query = mysqli_query($conn, "INSERT INTO `staff`(sname, semail, sphone, saddress, susername, spassword) VALUES('$p_name', '$p_email', '$p_phone', '$p_address', '$p_username', '$p_password')") or die('Query failed');

   if($insert_query){
      
      $message[] = 'staff add succesfully';
   }else{
      $message[] = 'could not add the staff';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `staff` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:staff.php');
      $message[] = 'staff has been deleted';
   }else{
      header('location:staff.php');
      $message[] = 'staff could not be deleted';
   };
};

if(isset($_POST['update_staff'])){
   $update_s_id = $_POST['update_staff_id'];
   $update_s_name = $_POST['update_staff_name'];
   $update_s_email = $_POST['update_staff_email'];
   $update_s_phone = $_POST['update_staff_phone'];
   $update_s_address = $_POST['update_staff_address'];
   $update_s_username = $_POST['update_staff_username'];
   $update_s_password = $_POST['update_staff_password'];
   $update_query = mysqli_query($conn, "UPDATE `staff` SET sname = '$update_s_name', semail = '$update_s_email', sphone = '$update_s_phone ', saddress = '$update_s_address',susername='$update_s_username', spassword = '$update_s_password'  WHERE id = '$update_s_id'");

   if($update_query){
      
      $message[] = 'staff updated succesfully';
      header('location:staff.php');
   }else{
      $message[] = 'staff could not be updated';
      header('location:staff.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admins.css">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" >
   <h3>add a new staff</h3>
   <input type="text"   name="staff_name" placeholder="enter the staff name" class="box" required>
   <input type="email"   name="staff_email" placeholder="enter the staff email" class="box" required >
   <input type="text"   name="staff_phone" placeholder="enter the staff phone number" class="box" required>
   <input type="text"   name="staff_address" placeholder="enter the staff adress" class="box" required>
   <input type="text"   name="staff_username" placeholder="enter the staff username" class="box" required>
   <input type="password"   name="staff_password" placeholder="enter the password" class="box" required >
  
   <input type="submit" value="addstaff" name="addstaff" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th> Name</th>
         <th> Email</th>
         <th>Phone Number</th>
         <th>Adrass</th>
         <th>Username</th>
         <th>Password</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_staff = mysqli_query($conn, "SELECT * FROM `staff`");
            if(mysqli_num_rows($select_staff) > 0){
               while($row = mysqli_fetch_assoc($select_staff)){
         ?>

         <tr>
            
            <td><?php echo $row['sname']; ?></td>
            <td><?php echo $row['semail']; ?></td>
            <td><?php echo $row['sphone']; ?></td>
            <td><?php echo $row['saddress']; ?></td>
            <td><?php echo $row['susername']; ?></td>
            <td><?php echo $row['spassword']; ?></td>
            
            

            <td>
               <a href="staff.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');">  <i class="fa-solid fa-trash-can"></i> delete </a>
               <a href="staff.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no staff added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `staff` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" >
      
      <input type="hidden" name="update_staff_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_staff_name" value="<?php echo $fetch_edit['sname']; ?>">
      <input type="text" class="box" required name="update_staff_email" value="<?php echo $fetch_edit['semail']; ?>">
      <input type="text" class="box" required name="update_staff_phone" value="<?php echo $fetch_edit['sphone']; ?>">
      <input type="text" class="box" required name="update_staff_address" value="<?php echo $fetch_edit['saddress']; ?>">
      <input type="text" class="box" required name="update_staff_username" value="<?php echo $fetch_edit['saddress']; ?>">
      <input type="password" class="box" required name="update_staff_password" value="<?php echo $fetch_edit['susername']; ?>">

      <input type="submit" value="update the staff" name="update_staff" class="btn">
      <a value="cancel" id="close-edit" class="option-btn" href="staff.php" >cancel</a>
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<!-- custom js file link  -->

<script src="js/script.js"></script>

</body>
</html>