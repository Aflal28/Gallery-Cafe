<?php

@include 'config.php';

// Signup logic
if (isset($_POST['submit'])) {
    $reservasion_name = $_POST['reservasion_name'];
    $reservasion_email = $_POST['reservasion_email'];
    $reservasion_number = $_POST['reservasion_number'];
    $reservasion_date = $_POST['reservasion_date'];
    $reservasion_month = $_POST['reservasion_month'];
    $reservasion_year = $_POST['reservasion_year'];
    $reservasion_time = $_POST['reservasion_time'];
    $reservasion_guests = $_POST['reservasion_guests'];
    $payment_method = $_POST['payment_method'];
 
    
        $insert_query = mysqli_query($conn, "INSERT INTO `reservasion_detils` (r_name, r_email, r_number, r_date, r_month, r_year, r_time,r_guests,r_payment_method) VALUES ('$reservasion_name ', '$reservasion_email', '$reservasion_number', '$reservasion_date', '$reservasion_month', '$reservasion_year', '$reservasion_time', '$reservasion_guests', '$payment_method')") or die('query failed');
        
        if ($insert_query) {
            $message[] = 'booked   successfull';
            header('location:visitorpage.php');
        } else {
            $message[] = 'book not success';
        }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admins.css">
    <link rel="stylesheet" href="resarvasionforms.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include 'visitornavbar.php'; ?>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <h4>Table Reservation</h4>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="Full Name"  name="reservasion_name" required/>
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="email" placeholder="Email Address" name="reservasion_email" required/>
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="Contact Number" name="reservasion_number" required/>
                    <div class="input-icon"><i class="fa-solid fa-phone"></i></div>
                </div>
            </div>
            <div class="row">
                <div class="col-half">
                    <h4>Date of Reservation</h4>
                    <div class="input-group">
                        <div class="col-third">
                            <input type="text" placeholder="DD" name="reservasion_date" required/>
                        </div>
                        <div class="col-third">
                            <input type="text" placeholder="MM" name="reservasion_month" required/>
                        </div>
                        <div class="col-third">
                            <input type="text" placeholder="YYYY" name="reservasion_year" required/>
                        </div>
                        <div class="col-third">
                            <input type="time" placeholder="Time" name="reservasion_time" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group input-group-icon">
                <input type="number" placeholder="Number of Guests" name="reservasion_guests" required/>
                <div class="input-icon"><i class="fa-solid fa-person"></i></div>
            </div>
           
            <div class="row">
                <h4>Payment Details</h4>
                <div class="input-group">
                    <input id="payment-method-card" type="radio" name="payment_method" value="credit"  checked="true"/>
                    <label for="payment-method-card"><span><i class="fa-solid fa-credit-card"></i>Credit Card</span></label>
                    <input id="payment-method-paypal" type="radio" name="payment_method" value="debit"/>
                    <label for="payment-method-paypal"><span><i class="fa-duotone fa-solid fa-credit-card"></i>Debit card</span></label>
                </div>
                
                
                
            </div>
            <div class="row">
                <h4>Terms and Conditions</h4>
                <div class="input-group">
                    <input id="terms" type="checkbox"/>
                    <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
                </div>
            </div>
            <div class="btn1">
                <input type="submit" name="submit" value="submit"  >
                
            </div>
        </form>
    </div>
<br>
<br>
    <?php
  if (isset($message)) {
      foreach ($message as $msg) {
          echo '<div class="message"><span>' . htmlspecialchars($msg) . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
      }
  }
  
  ?>
  <br><br>
  <div class="footerform">
  </div>
</body>
</html>
