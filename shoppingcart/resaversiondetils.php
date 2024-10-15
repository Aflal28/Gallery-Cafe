
<?php

@include 'config.php';



if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `reservasion_detils` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:resaversiondetils.php');
      $message[] = 'Reservation has been deleted';
   }else{
      header('location:resaversiondetils.php');
      $message[] = 'Reservation could not be deleted';
   };
};

if(isset($_POST['update'])){
   $update_r_id = $_POST['update_r_id'];
   $update_r_name = $_POST['update_r_name'];
   $update_r_email = $_POST['update_r_email'];
   $update_r_phone = $_POST['update_r_phone'];
   $update_r_date = $_POST['update_r_date'];
   $update_r_month = $_POST['update_r_month'];
   $update_r_year = $_POST['update_r_year'];
   $update_r_time= $_POST['update_r_time'];
   $update_r_guests= $_POST['update_r_guests'];
  
   

   $update_query = mysqli_query($conn, "UPDATE `reservasion_detils` SET r_name = '$update_r_name', r_email  = '$update_r_email',r_number= '$update_r_phone', r_date= '$update_r_date', r_month = '$update_r_month', r_year= '$update_r_year', r_time = '$update_r_time', r_guests= '$update_r_guests' WHERE id = '$update_r_id'");

   if($update_query){
   
      $message[] = 'product updated succesfully';
      header('location:resaversiondetils.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:resaversiondetils.php');
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
   <link rel="stylesheet" href="staffhomesnavbar.css">
   <link rel="stylesheet" href="resaversiondetils.css">

   
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'staffhomenavbar.php'; ?>

<div class="container">



<section class="display-product-table">

   <table>

      <thead>
         <th>Name</th>
         <th>Email</th>
         <th>Number</th>
         <th>Date</th>
         <th>Month</th>
         <th>Year</th>
         <th>Time</th>
         <th>guests </th>
         <th>payment_method</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_reservasion = mysqli_query($conn, "SELECT * FROM `reservasion_detils`");
            if(mysqli_num_rows($select_reservasion) > 0){
               while($row = mysqli_fetch_assoc($select_reservasion)){
         ?>

         <tr>
            
            <td><?php echo $row['r_name']; ?></td>
            <td><?php echo $row['r_email']; ?></td>
            <td><?php echo $row['r_number']; ?></td>
            <td><?php echo $row['r_date']; ?></td>
            <td><?php echo $row['r_month']; ?></td>
            <td><?php echo $row['r_year']; ?></td>
            <td><?php echo $row['r_time']; ?></td>
            <td><?php echo $row['r_guests']; ?></td>
            <td><?php echo $row['r_payment_method']; ?></td>



                  
            <td>
               <a href="resaversiondetils.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="resaversiondetils.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no reservasion addad added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `reservasion_detils` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data" class="add-product-form">
     
      <input type="hidden" name="update_r_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_r_name"  placeholder="enter the name" value="<?php echo $fetch_edit['r_name']; ?>">
      <input type="text" class="box" required name="update_r_email"  placeholder="enter the email" value="<?php echo $fetch_edit['r_email']; ?>">
      <input type="text" class="box" required name="update_r_phone"  placeholder="enter the Number" value="<?php echo $fetch_edit['r_number']; ?>">
      <input type="text" class="box" required name="update_r_date"  placeholder="enter the Date" value="<?php echo $fetch_edit['r_date']; ?>">

      <input type="text" class="box" required name="update_r_month" placeholder="enter the month"  value="<?php echo $fetch_edit['r_month']; ?>">
      <input type="text" class="box" required name="update_r_year" placeholder="enter the year"  value="<?php  echo $fetch_edit['r_year']; ?>"> 
      <input type="time" class="box" required name="update_r_time" placeholder="enter the time" value="<?php  echo $fetch_edit['r_time']; ?>">
     
      <input type="number" class="box" required name="update_r_guests" placeholder="enter gust count" value="<?php  echo $fetch_edit['r_guests']; ?>">

      
    
      <input type="submit" value="update " name="update" class="btn">
      <a value="cancel" id="close-edit" class="option-btn" href="resaversiondetils.php" >cancel</a>
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
</html>