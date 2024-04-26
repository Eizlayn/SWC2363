<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Made In Heaven Theme Park</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <style>
        <?php
        include("design.css");
        ?>
    </style>

    <header>
        <div class="container">
            <h1 id="theme-park-title">Made In Heaven Theme Park</h1>
            <nav>
                <ul>
                    <li><a href="Home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="Attractions.html"><i class="fas fa-map-marker-alt"></i> Attractions</a></li>
                    <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="Events.html"><i class="far fa-calendar-alt"></i> Events</a></li>
                    <li><a href="#manual"><i class="fas fa-book"></i> User Manual</a></li>
                </ul>
            </nav>
            <div class="user-section">
                <?php
                if (isset($_GET['islogin']) == "yes") {
                    $id=$_GET['visitorID'];
                    // User is logged in
                    echo '<a href="Account.php?visitorID='.$id.'" class="user-btn"><i class="fas fa-user"></i> Account</a>';
                } else if (isset($_POST['islogin']) == "yes"){
                    $id=$_POST['visitorID'];
                    echo '<a href="Account.php?visitorID='.$id.'" class="user-btn"><i class="fas fa-user"></i> Account</a>';
                }else{
                    echo '<a href="Login.php" class="user-btn"><i class="fas fa-user"></i> Login/Register</a>';
                }
                ?>
            </div>
            <nav>Reach us on:</nav>

            <div class="social-media" id="socialMedia">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
        </div>
        <style></style>
    </header>

    <section id="welcome">
        <div class="container">
            <h2>Welcome to Made In Heaven Theme Park!</h2>
            <p>Experience the magic and excitement at our enchanting theme park. 
                Get ready for thrilling rides, and unforgettable adventures for the whole family.</p>
                <button class="purchase-btn" onclick="purchaseTickets()">PURCHASE YOUR TICKETS NOW</button>
        </div>
    </section>

    <section id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-image">
                <img src="theme.jpg" alt="About Us Image">
            </div>
            <div class="about-description">
                <h2>About Us</h2>
                <p>Welcome to Made In Heaven Theme Park, where dreams come to life and unforgettable memories are made! Nestled in the heart of picturesque landscapes, our park offers a magical escape for visitors of all ages.</p>
                <p>With a wide array of thrilling rides, enchanting attractions, and captivating entertainment, there's something for everyone to enjoy. Whether you're seeking adrenaline-pumping adventures or leisurely strolls through whimsical gardens, our park promises an experience like no other.</p>
                <p>At Made In Heaven Theme Park, we're dedicated to providing exceptional hospitality and creating moments of joy and wonder for our guests. Join us for a day filled with laughter, excitement, and endless fun!</p>
            </div>
        </div>
    </div>
</section>

<section id="manual">
    <div class="container">
        <div class="video-container">
        <h2>User Manual</h2>
            <video controls>
                <source src="manual.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>

    <script>
    function purchaseTickets() {
        <?php 
        if (isset($_GET['islogin']) && $_GET['islogin'] == "yes") {
            $id = $_GET['visitorID'];
            echo 'window.location.href = "Purchase.php?visitorID='.$id.'";';
        } else if (isset($_POST['islogin']) && $_POST['islogin'] == "yes") {
            $id = $_POST['visitorID'];
            echo 'window.location.href = "Purchase.php?visitorID='.$id.'";';
        } else {
            echo 'alert("You need to login first.");';
            echo 'window.location.href = "Login.php";';
        }
        ?>
    }
</script>

    <script>
    $(document).ready(function(){
      $('a[href^="#"]').on('click',function (e) {
          e.preventDefault();

          var target = this.hash;
          var $target = $(target);

          $('html, body').stop().animate({
              'scrollTop': $target.offset().top
          }, 900, 'swing', function () {
              window.location.hash = target;
          });
      });
    });
    </script>

<script>
        function toggleSocialMedia() {
            var socialMedia = document.getElementById("socialMedia");
            socialMedia.style.display = (socialMedia.style.display === "block") ? "none" : "block";
        }
    </script>

</body>
</html>
