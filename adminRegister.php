<!DOCTYPE html>
<html>

<head>
    <title>eLeave Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding-top: 50px;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="password"],
        input[type="text"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"],
        button[type="reset"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover,
        button[type="reset"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
    // call file to connect server eleave
    include("header.php");
    ?>

    <?php
    // This query insert a record in the eLeave table
    // has form been submitted?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $error = array(); //initialize an error array

        // check for a adminPassword
        if (empty($_POST['adminPassword'])) {
            $error[] = 'You forgot to the password';
        } else {
            $p = mysqli_real_escape_string($connect, trim($_POST['adminPassword']));
        }

        // check for a adminName
        if (empty($_POST['adminName'])) {
            $error[] = 'You forgot to enter your name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['adminName']));
        }

        // check for a adminPhoneNo
        if (empty($_POST['adminPhoneNo'])) {
            $error[] = 'You forgot to enter your phone number';
        } else {
            $ph = mysqli_real_escape_string($connect, trim($_POST['adminPhoneNo']));
        }

        // check for a adminEmail
        if (empty($_POST['adminEmail'])) {
            $error[] = 'You forgot to enter your email.';
        } else {
            $e = mysqli_real_escape_string($connect, trim($_POST['adminEmail']));
        }

        // register the admin in the database
        // make the query
        $q = "INSERT INTO admin (adminID, adminPassword, adminName, adminPhoneNo, adminEmail) VALUES ('', '$p', '$n', '$ph', '$e')";

        $result = @mysqli_query($connect, $q); // run the query

        if ($result) {
            echo '<h1>Thank you</h1>';
            echo '<p>Your registration is successful.</p>';
            echo '<p>Please <a href="adminLogin.php">click here</a> to login.</p>';
            exit();
        } else {
            // if it didn't run
            // message 
            echo '<h1>System error</h1>';

            // debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query : ' . $q . '</p>';
        } // end of it (result)

        mysqli_close($connect); //close the database connection_aborted
        exit();
        // end of the main submit conditional  
    }

    ?>

<h2>Register Admin</h2>
    <h4>*Required field</h4>
    <form action="adminRegister.php" method="post">
        <div>
            <label for="adminPassword">Password</label>
            <input type="password" id="adminPassword" name="adminPassword" size="15" maxlength="60" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php if (isset($_POST['adminPassword'])) echo $_POST['adminPassword']; ?>">
        </div>

        <div>
            <label for="adminName">Admin Name</label>
            <input type="text" id="adminName" name="adminName" size="30" maxlength="50" required value="<?php if (isset($_POST['adminName'])) echo $_POST['adminName']; ?>">
        </div>

        <div>
            <label for="adminPhoneNo">Phone No.</label>
            <input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="adminPhoneNo" name="adminPhoneNo" size="15" maxlength="20" required value="<?php if (isset($_POST['adminPhoneNo'])) echo $_POST['adminPhoneNo']; ?>">
        </div>


        <div>
            <label for="adminEmail">Admin Email</label>
            <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="adminEmail" name="adminEmail" size="30" maxlength="50" required value="<?php if (isset($_POST['adminEmail'])) echo $_POST['adminEmail']; ?>">
        </div>

        <div>
            <button type="submit">Register</button>
            <button type="reset">Clear All</button>
        </div>
    </form>
</body>

</html>
