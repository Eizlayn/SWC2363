<?php
session_start();
if (isset($_GET['islogin']) == "yes" || isset($_POST['islogin']) == "yes") {
  $_SESSION['logged_in'] = true;
    // User is not logged in. Redirect them to the login page
    header("Location: Login.php");
    exit();
}

include("header.php");
  
if (isset($_GET['visitorID']) or is_numeric($_GET['visitorID'])) {
  $id = $_GET['visitorID'];
} else if (isset($_POST['visitorID']) or is_numeric($_POSTT['visitorID'])) {
  $id = $_POST['visitorID'];
} else {
  echo 'alert("no visitor id");';
  echo 'window.location.href = "Purchase.php";';
}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $error = array(); //initialize an error array

  // check for a adminPassword
  if (empty($_POST['ticket_kid'])) {
      $error[] = 'You forgot to the password';
  } else {
      $tk = mysqli_real_escape_string($connect, trim($_POST['ticket_kid']));
  }
  // check for a adminPassword
  if (empty($_POST['ticket_adult'])) {
      $error[] = 'You forgot to the password';
  } else {
      $ta = mysqli_real_escape_string($connect, trim($_POST['ticket_adult']));
  }
  // check for a adminPassword
  if (empty($_POST['ticket_senior'])) {
      $error[] = 'You forgot to the password';
  } else {
      $ts = mysqli_real_escape_string($connect, trim($_POST['ticket_senior']));
  }
  // check for a adminPassword
  if (empty($_POST['visit_date'])) {
      $error[] = 'You forgot to the password';
  } else {
      $vd = mysqli_real_escape_string($connect, trim($_POST['visit_date']));
  }

  if($tk){
    $sql = "INSERT INTO `ticket`(`ticketQuantity`, `ticketPrice`, `ticketType`, `ticketDate`, `visitorID`) VALUES ('$tk',50,'Kid','$vd', '$id')";
    $runsql = @mysqli_query($connect, $sql);
  }
  
  if($ta){
    $sqlA = "INSERT INTO `ticket`(`ticketQuantity`, `ticketPrice`, `ticketType`, `ticketDate`, `visitorID`) VALUES ('$ta',100,'Adult','$vd', '$id')";
    $runsqlA = @mysqli_query($connect, $sqlA);
  }
  
  if($ts){
    $sqlS = "INSERT INTO `ticket`(`ticketQuantity`, `ticketPrice`, `ticketType`, `ticketDate`, `visitorID`) VALUES ('$ts',80,'Senior','$vd', '$id')";
    $runsqlS = @mysqli_query($connect, $sqlS);
  }

  echo '<script>
  window.location.href = "receipt.php?visitorID='.$id.'"
  </script>';
  mysqli_close($connect); //close the database connection_aborted
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Made In Heaven Theme Park - Purchase Tickets</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<header>
        <div class="container">
            <h1 id="theme-park-title">Made In Heaven Theme Park</h1>
        </div>
    </header>
<body>
    <div class="container" style="padding: 20px;">
        <div class="purchase-frame" style="background-color: black; padding: 20px; border-radius: 10px;">
            <h2 style="color: white;">Purchase Tickets</h2>
            <form action="" method="POST">
                <label for="ticket_kid" style="color: white;">Kids (3 years old - 12 years old) - RM50 each:</label>
                <input type="number" id="ticket_kid" name="ticket_kid" min="0"><br><br>
                
                <label for="ticket_adult" style="color: white;">Adult - RM100 each:</label>
                <input type="number" id="ticket_adult" name="ticket_adult" min="0"><br><br>
                
                <label for="ticket_senior" style="color: white;">Senior Citizen (55 years old and above) - RM80 each:</label>
                <input type="number" id="ticket_senior" name="ticket_senior" min="0"><br><br>
                
                <label for="visit_date" style="color: white;">Select Visit Date:</label>
                <input type="date" id="visit_date" name="visit_date"><br><br>
                
                <input type="submit" value="Confirm" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
            </form>
        </div>
        <div class="cancel-button" style="margin-top: 20px;">
            <button onclick="cancelPurchase()" style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Cancel</button>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>

    <script>
        function cancelPurchase() {
            window.location.href = "Home.php";
        }
    </script>
</body>
</html>
