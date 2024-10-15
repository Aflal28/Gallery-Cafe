<?php   @include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Restaurant - Rasturent Gallery Café in Colombo">
    <meta name="keywords" content="restaurant, cafe, Colombo, premium dining">
    <meta name="author" content="Rasturent Gallery Café">
    <title>Rasturent Gallery Café | About Us</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admins.css">
    <link rel="stylesheet" href="aboutus.css"> <!-- Link to the external CSS file -->
</head>

<body>
    <header>
    <?php include 'custamernavbar.php'; ?>

    <main>
        <section class="hero">
            <h2>Welcome to Rasturent Gallery Café</h2>
            <p>Discover a blend of exquisite cuisine and artistic ambiance.</p>
        </section>

        <section class="about-us">
            <h2>About Us</h2>
            <p>Located in the heart of Colombo, Rasturent Gallery Café offers a unique dining experience combining gourmet food with an art gallery setting. Our mission is to provide a space where culinary excellence meets cultural enrichment.</p>
            <p>At Rasturent, we believe in using only the freshest ingredients to create delightful dishes that will tantalize your taste buds. Our café also features a rotating selection of local and international artworks, enhancing your dining experience with visual pleasures.</p>
        </section>

        <section class="team">
            <h2>Our Team</h2>
            <div class="profile-card">
                <div class="profile-pic">
                    <img src="images/chef.jpg" alt="Chef John Doe">
                </div>
                <div class="personal-details">
                    <h3>Chef John Doe</h3>
                    <p>Head Chef and Culinary Artist</p>
                    <p>With over 20 years of experience, Chef John brings his passion for cooking and artistry to every dish.</p>
                </div>
            </div>

          
            <div class="profile-card">
                <div class="profile-pic">
                    <img src="images/chef.jpg" alt="Chef John Doe">
                </div>
                <div class="personal-details">
                    <h3>Chef John Doe</h3>
                    <p>Head Chef and Culinary Artist</p>
                    <p>With over 20 years of experience, Chef John brings his passion for cooking and artistry to every dish.</p>
                </div>
            </div>

        
            <div class="profile-card">
                <div class="profile-pic">
                    <img src="images/chef.jpg" alt="Chef John Doe">
                </div>
                <div class="personal-details">
                    <h3>Chef John Doe</h3>
                    <p>Head Chef and Culinary Artist</p>
                    <p>With over 20 years of experience, Chef John brings his passion for cooking and artistry to every dish.</p>
                </div>
            </div>
            <!-- Add more profile cards as needed -->
        </section>

        <section class="gallery">
            <h2>Our Gallery</h2>
            <div class="gallery-grid">
                <img src="images/gallary3.jpg" alt="Gallery Image 1">
                <img src="images/gallary4.jpg" alt="Gallery Image 2">
                <img src="images/gallary5.jpg" alt="Gallery Image 3">
                <!-- Add more images as needed -->
            </div>
        </section>

        <section class="contact-info">
            <h2>Contact Us</h2>
            <p>Address: 123 Art Street, Colombo</p>
            <p>Phone: +94 123 4567</p>
            <p>Email: info@rasturent.com</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Rasturent Gallery Café. All rights reserved.</p>
    </footer>
</body>

</html>
