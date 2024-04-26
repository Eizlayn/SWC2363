<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Made In Heaven Theme Park</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
<body>
    <style>
        <?php
        include("design.css");
        ?>
    </style>
    <?php
       //call file to connect server eleave
       include ("header.php");
    ?>


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
    



    <?php


        // This section processes submission from the login form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // validate the visitorID
            if (!empty($_POST['visitorName'])) {
                $n = mysqli_real_escape_string($connect, $_POST['visitorName']);
            } else {
                $n = FALSE;
                echo '<p class="error">You forgot to enter your Name.</p>';
            }

            // validate the visitorPassword
            if (!empty($_POST['visitorPassword'])) {
                $p = mysqli_real_escape_string($connect, $_POST['visitorPassword']);
            } 

            // if no problems
            if ($n && $p) {
                // Retrieve the visitorID, visitorPassword, visitorName, visitorPhoneNo, visitorEmail
                $q = "SELECT visitorID, visitorPassword, visitorName, visitorPhoneNo, visitorEmail
                FROM visitor WHERE (visitorName = '$n' AND
                visitorPassword = '$p')";

                // run the query and assign it to the variable $result
                $result = mysqli_query($connect, $q);

                // count the number of rows that match the visitorID/visitorPassword combination
                // if one database row (record) matches the input:
                // After authenticating the user, set session variables and redirect to home page
                if (@mysqli_num_rows($result) == 1) {
                    // Fetch user data and set session variables
                    $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Set session variable to indicate user is logged in
                    $_SESSION['logged_in'] = true;
                    // Set visitorID in the session
                    $_SESSION['visitorID'] = $_SESSION['visitorID'];
                    // Redirect to home page
                    echo "<script>window.location.href='Home.php?islogin=yes&visitorID=".$_SESSION['visitorID']."'</script>";
                    exit();
                }
                 else {
                    echo '<p class="error">Your Name and your Password do not match our records.
                    Perhaps you need to register, just click the Register button.</p>';
                }
            } else {
                echo '<p class="error">Please try again.</p>';
            }
            mysqli_close($connect);
        }
    ?>

    <section id="login">
        <div id="content-wrapper">
            <div id="login-container">
                <div id="login-frame">
                    <h2>Login to Made In Heaven Theme Park</h2>
                    <form action="Login.php" method="post">
                        <div>
                            <label for="visitor Name">Your Name:</label>
                            <input type="text" id="visitorName" name="visitorName" size="3" maxlength="30"
                            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitorName']) && empty($n)) echo 'value="' . htmlspecialchars($_POST['visitorName']) . '"'; ?>>
                        </div>

                        <div>
                            <label for="visitorPassword">Password:</label>
                            <input type="password" id="visitorPassword" name="visitorPassword" size="15" maxlength="60"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must have at least 8 or more characters and contain at least one number and one uppercase letter"
                            required
                            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitorPassword']) && empty($p)) echo 'value="' . htmlspecialchars($_POST['visitorPassword']) . '"'; ?>>
                        </div>

                        <div>
                            <button type="submit">Login</button>
                        </div>
            
                        <div>
                            <label>Don't have an account? Join Us Now!
                                <a href="Register.php">REGISTER</a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Made In Heaven Theme Park</p>
        </div>
    </footer>
</body>
</html>
