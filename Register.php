<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Made In Heaven Theme Park</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <h1 id="theme-park-title">Made In Heaven Theme Park</h1>
            <nav>
                <ul>
                    <li><a href="Home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="Attractions.html"><i class="fas fa-map-marker-alt"></i> Attractions</a></li>
                    <li><a href="About.html"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="Events.html"><i class="far fa-calendar-alt"></i> Events</a></li>
                    <li><a href="Contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="register">
        <div class="container">
            <h2>Create Your account</h2>
            <?php
                // Include file to connect to the server
                include("header.php");

                // Process form submission
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $error = array(); // Initialize an error array

                    // Check for visitorPassword
                    if (empty($_POST['visitorPassword'])) {
                        $error[] = 'You forgot to enter your password.';
                    } else {
                        $p = mysqli_real_escape_string($connect, trim($_POST['visitorPassword']));
                    }

                    // Check for visitorName
                    if (empty($_POST['visitorName'])) {
                        $error[] = 'You forgot to enter your name.';
                    } else {
                        $n = mysqli_real_escape_string($connect, trim($_POST['visitorName']));
                    }

                    // Check for visitorPhoneNo
                    if (empty($_POST['visitorPhoneNo'])) {
                        $error[] = 'You forgot to enter your phone number.';
                    } else {
                        $ph = mysqli_real_escape_string($connect, trim($_POST['visitorPhoneNo']));
                    }

                    // Check for visitorEmail
                    if (empty($_POST['visitorEmail'])) {
                        $error[] = 'You forgot to enter your email.';
                    } else {
                        $e = mysqli_real_escape_string($connect, trim($_POST['visitorEmail']));
                    }

                    // Register the visitor in the database
                    if (empty($error)) {
                        $q = "INSERT INTO visitor (visitorID, visitorPassword, visitorName, visitorPhoneNo, visitorEmail)
                            VALUES ('', '$p', '$n', '$ph', '$e')";
                        $result = mysqli_query($connect, $q); // Run the query

                        if ($result) {
                            echo '<h3>Thank you for registering!</h3>';
                        } else {
                            echo '<h3 class="error">System error. Please try again later.</h3>';
                            echo '<p>' . mysqli_error($connect) . '</p>';
                        }

                        mysqli_close($connect);
                    } else {
                        foreach ($error as $err) {
                            echo '<p class="error">' . $err . '</p>';
                        }
                    }
                }
            ?>

            <h3>Fill in Your Details</h3>
            <form action="register.php" method="post">
                <div>
                    <label for="visitorPassword">Password:</label>
                    <input type="password" id="visitorPassword" name="visitorPassword" required>
                </div>

                <div>
                    <label for="visitorName">Name:</label>
                    <input type="text" id="visitorName" name="visitorName" required>
                </div>

                <div>
                    <label for="visitorPhoneNo">Phone No.:</label>
                    <input type="tel" id="visitorPhoneNo" name="visitorPhoneNo" pattern="[0-9]{3}-[0-9]{7}" required>
                </div>

                <div>
                    <label for="visitorEmail">Email:</label>
                    <input type="email" id="visitorEmail" name="visitorEmail" required>
                </div>

                <div>
                <button type="submit">Register</button>
                    <button type="reset">Clear</button>
<a href="Login.php"><button type="button">Cancel</button></a>

                 </div>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>
</body>
</html>
