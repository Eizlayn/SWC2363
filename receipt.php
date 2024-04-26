<?php
session_start();
include("header.php"); // Include database connection file

// Check if the user is logged in
if (isset($_GET['islogin']) == "yes" || isset($_POST['islogin']) == "yes") {
    $_SESSION['logged_in'] = true;
      // User is not logged in. Redirect them to the login page
      header("Location: Login.php");
      exit();
  }

if (isset($_GET['visitorID'])) {
    $id = $_GET['visitorID'];
} else if (isset($_POST['visitorID'])) {
    $id = $_POST['visitorID'];
} else {
    echo 'alert("no visitor id");';
    echo 'window.location.href = "Purchase.php";';
}

// Get visitor ID from session
$visitorID = $id;

// Get user details from the database
$sql_user = "SELECT * FROM visitor WHERE visitorID = $visitorID";
$result_user = mysqli_query($connect, $sql_user);

if (mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $visitorName = $row_user['visitorName'];
} else {
    $visitorName = "Guest";
}

// Get ticket details from the database
$sql_ticket = "SELECT * FROM ticket WHERE visitorID = $visitorID ORDER BY ticketID DESC LIMIT 1"; // Get the latest ticket
$result_ticket = mysqli_query($connect, $sql_ticket);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Made In Heaven Theme Park</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: ffcc00; 
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1 id="theme-park-title">Made In Heaven Theme Park</h1>
        </div>
    </header>

    <!-- Receipt Content -->
    <div class="container" style="padding: 20px;">
        <div class="receipt-frame" style="background-color: black; padding: 20px; border-radius: 10px;">
            <h2 style="color: white;">Receipt</h2>
            <p style="color: white;">Name: <?php echo $visitorName; ?></p>
            <p style="color: white;">Date Purchased: <?php echo date("Y-m-d H:i:s"); ?></p>
            <?php if (mysqli_num_rows($result_ticket) > 0) : ?>
            <?php while ($row_ticket = mysqli_fetch_assoc($result_ticket)){?>
            <p style="color: white;">Visit Date: <?php echo date("Y-m-d", strtotime($row_ticket['ticketDate'])); ?></p>
            <p style="color: white;">Ticket Details:</p>
            <ul style="list-style-type: none; color: white;">
                <li><?php echo $row_ticket['ticketType'] . ": " . $row_ticket['ticketQuantity']; ?></li>
            </ul>
            <?php } ?>
            <?php else : ?>
            <p style="color: white;">No tickets purchased.</p>
            <?php endif; ?>
        </div>
        <!-- Back to Home Button -->
        <div class="home-button" style="margin-top: 20px;">
            <button onclick="goHome()" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Back to Home</button>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>

    <!-- JavaScript for Home Button -->
    <script>
        function goHome() {
            window.location.href = "Home.php";
        }
    </script>
</body>
</html>
