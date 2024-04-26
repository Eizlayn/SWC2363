<?php
session_start();

// Assuming $connect is your database connection
include("header.php");

// Assuming $connect is your database connection
$connect = mysqli_connect("localhost", "root", "", "tpark");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if visitorID is set
if (isset($_GET['visitorID'])) {
    $id = $_GET['visitorID'];
} else if (isset($_POST['visitorID'])) {
    $id = $_POST['visitorID'];
} else {
    echo 'ERROR. No Visitor ID';
    exit(); // Stop further execution if visitorID is not set
}

// Fetch user information from the database
$query = "SELECT `visitorID`, `visitorPassword`, `visitorName`, `visitorPhoneNo`, `visitorEmail` FROM `visitor` WHERE visitorID='$id'";
$runquery = mysqli_query($connect, $query);

if ($runquery && mysqli_num_rows($runquery) > 0) {
    $result = mysqli_fetch_assoc($runquery);
} else {
    echo 'ERROR. User not found';
    exit(); // Stop further execution if user is not found
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Made In Heaven Theme Park</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom styles for this page */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .user-info {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        .user-info ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .user-info ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }

        .logout-btn {
            display: inline-block;
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>

<body>
<header>
        <div class="container">
            <h1 id="theme-park-title">Made In Heaven Theme Park</h1>
        </div>
    </header>
    <div class="user-info">
        <h2>My Account</h2>
        <p>Welcome, <?php echo htmlspecialchars($result['visitorName']); ?>!</p>
        <p>Your account information:</p>
        <ul>
            <li><strong>Name:</strong> <?php echo htmlspecialchars($result['visitorName']); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($result['visitorEmail']); ?></li>
            <li><strong>Phone Number:</strong> <?php echo htmlspecialchars($result['visitorPhoneNo']); ?></li>
        </ul>
        <a href="Logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>
</body>

</html>
