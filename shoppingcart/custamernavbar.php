<?php
$message = ['please login into page'];
$row_count = 0; // Example row count. Replace with actual value.

if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
}
?>

<header class="header">
   <div class="flex">
      <a href="#" class="logo">FOOD GALLERY</a>
      <nav class="navbar">
         <a href="custamor.php">Home</a>
         <a href="custamor.php">Table Reservation</a>
         <a href="custamerpromation.php">Promotion</a>
         <a href="custamerabout.php">About</a>
         <a href="custamorpark.php">PARK</a>
         <a href="usersignup.php">Login</a>
      </nav>
      <a href="custamor.php" class="cart">Cart <span><?php echo $row_count; ?></span></a>
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>
</header>
