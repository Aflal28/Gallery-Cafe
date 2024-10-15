<?php

@include 'config.php';
 include 'staffhomenavbar.php';
// Initialize the message array
$message = [];



// Delete order logic
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id") or die('query failed');
   if($delete_query){
      $message[] = 'Order has been deleted';
   } else {
      $message[] = 'Order could not be deleted';
   }
   header('location:staffbills.php');
   exit();
}

// Update order logic
if(isset($_POST['update_orders'])){

   $update_o_id = $_POST['update_o_id'];
   $update_o_name = $_POST['update_o_name'];
   $update_o_phone= $_POST['update_o_phone'];
   $update_o_totalprodects = $_POST['update_o_totalprodects'];
   $update_o_price = $_POST['update_o_price'];

   $update_query = mysqli_query($conn, "UPDATE `order` SET name = '$update_o_name', number='$update_o_phone', total_products='$update_o_totalprodects', total_price = '$update_o_price' WHERE id = '$update_o_id'");

   if($update_query) {
      $message[] = 'Order has been updated';
   } else {
      $message[] = 'Order could not be updated';
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

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admins.css">
   <link rel="stylesheet" href="staffbill.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      header('location:staffbills.php');
   }
}
?>

<div class="containers">

<section class="display-product-table">
   
   <div class="fooditems">
      
         <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `order`");
            if(mysqli_num_rows($select_orders) > 0){
               while($row = mysqli_fetch_assoc($select_orders)){
         ?>
         </div >
       <div class="staffbillbox">
         <img src="images/userimage2.jpg" alt="" class="imgs">
           <p class="pnames" id="pnamesid"> <?php echo $row['name']; ?></p><br>
           <p class="pnames">  <?php echo $row['number']; ?></p><br>
           <p class="pnames"> <?php echo $row['total_products']; ?></p><br>
           <p class="pnames"> $<?php echo $row['total_price']; ?>/-</p><br>
            
             <a href="staffbills.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a> 
               <a href="staffbills.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Update </a>
               </div>
               </div>
         <?php
               }
            } else {
               echo "<div class='empty'>No order added</div>";
            }
         ?>
     
</section>

<section class="edit-form-container">
   <?php
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `order` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="fooditems">
     <input type="hidden" name="update_o_id" value="<?php echo $fetch_edit['id']; ?>">
     <p class="pnames" id="pnamesid">  <input type="text" class="box" required name="update_o_name" placeholder="Update Name" value="<?php echo $fetch_edit['name']; ?>">
     <p class="pnames">   <input type="number" class="box" required name="update_o_phone" placeholder="Update Phone Number" value="<?php echo $fetch_edit['number']; ?>"></p><br>
     <p class="pnames">  <input type="text" class="box" required name="update_o_totalprodects" placeholder="Update Total Products" value="<?php echo $fetch_edit['total_products']; ?>"></p><br>
     <p class="pnames">  <input type="text" class="box" required name="update_o_price" placeholder="Update Total Price" value="<?php echo $fetch_edit['total_price']; ?>"></p><br>
      <input type="submit" value="Update the Product" name="update_orders" class="btn">
      <a value="cancel" id="close-edit" class="option-btn" href="staffbills.php" >cancel</a>
   </form>
   <?php
         }
      }
      echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
   }
   ?>
   
   
</section>
</div>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
