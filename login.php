<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travel Vista - Explore beautiful destinations around the world. Find travel inspiration, tips, reviews, and more.">
    <meta name="keywords" content="Travel, Travel Vista, Destinations, World Travel, Vacation, Travel Reviews, Travel Gallery">
    <meta name="Avni-Yash-Kohsheen-Rishab" content="WebDev Group">
    <title>Travel Vista</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&family=Brush+Script+MT&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="T">
            <span class="top"></span>
            <span class="bottom"></span>
        </div>
        <div class="V">
            <span class="left"></span>
            <span class="right"></span>
        </div>
    </div>
    <div class="elementspacing">
        &nbsp;
    </div>
    <div class="main-content">
        <header class="hdr">
            <div class="image_Carousel">
                <img id="imageElement" src="" alt="Image Carousel">
            </div>
            <div class="column logo">
                <a href="index.html"><img src="travellogo.png" alt="Travel Vista Logo" height="80" width="120"></a>
            </div>
            <div class="column heading">
                <h1>Travel Vista</h1>
            </div>
        </header>
        <nav class="navbar">
            <ul>
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="review.php">Reviews</a></li>
                <li><a href="past_bookings.php">Bookings</a></li>
                <li ><a><h3 class="pos" >Welcome, <?php echo htmlspecialchars($email); ?>!</h3></a></li>
                <button class="btn"><a href="index.html">Logout</a></button>
            </ul>
        </nav>
        <div class="hero-section">
            <video autoplay muted loop class="background-video">
                <source src="Travel With Us.mp4" type="video/mp4"> Your browser does not support the video tag.
            </video>
            <div class="hero-content">
                <br><br>
                <h2 class="hover-trigger">Discover Your Next Adventure</h2>
                <p>Explore the world's most breathtaking destinations.</p>
            </div>
        </div>
        <div class="destination-carousel"></div>
            <div class="carousel-container">
                <div class="elementspacing"></div>
                <div class="carousel-track">
                    <!---images here --->
                </div>
                <button class="carousel-button prev">&lt;</button>
                <button class="carousel-button next">&gt;</button>
            <div class="elementspacing"></div>
            </div>  
        <div class="elementspacing"></div> 
     <div class="container2">
        <footer>
        <div class="content">
            <div class="column_2">
                <h2>Why Travel Vista?</h2>
                <p>Established in 2024, Travel Vista is our Web Development Project. We offer competitive experience of trip planning, exclusive review and blogging community, and a seamless booking experience. From flights to hotels, we've got all your travel needs covered.</p>
            </div>
            <div class="column_2">
                <h2>Booking with Travel Vista</h2>
                <p>At Travel Vista, find the best deals on flights, hotels, and vacation packages. Our user-friendly platform allows you to book with ease. With 24/7 customer support, we ensure your travel plans are always in good hands.</p>
            </div>
            <div class="column_2">
                <h2>Explore the World</h2>
                <p>Whether it's domestic getaways or international adventures, Travel Vista has you covered. Enjoy instant confirmations, price comparisons, and exciting travel features to make your journey unforgettable.</p>
            </div>
        </div>
        <div class="elementspacing"></div>
        <div class="social-text-links">
            <h3>CONNECT WITH US</h3>
            <div class="social-links-container">
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-links">
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Contact Us</a>
            </div>
            <div class="copyright">
                Travel Vista © 2024. All Rights Reserved.<br>
                Created by Avni, Yash, Kohsheen & Rishab
            </div>
        </div>
    </footer>
    </div>
</div>
    <script src="script.js"></script>
</body>
</html>
