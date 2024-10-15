<header class="header">

   <div class="flex">

      <a href="#" class="logo"> FOOD GALLERY</a>

      <nav class="navbar">
         <a href="visitorpage.php">Home</a>
         <a href="resarvasionform.php">Table Reservation</a>
         <a href="promostion.php">Promotion</a>
         <a href="visitorpark.php"> Park</a>
         
         <a href="custamor.php">Logout</a>
         
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>