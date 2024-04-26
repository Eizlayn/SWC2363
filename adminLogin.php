<!DOCTYPE html>
<html>


<head>
    <title>Theme Park System - Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form {
            margin-top: 20px;
            margin-right: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .input-field {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            text-decoration: none;
            color: #007bff;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    //call file to connect server eleave
    include("header.php");
    ?>

<?php
//This section processes submission from the login form
//Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //validate the adminName
    if (!empty($_POST['adminName'])) {
        $name = mysqli_real_escape_string($connect, $_POST['adminName']);
    } else {
        $name = FALSE;
        echo '<p class="error"> You forgot to enter your name.</p>';
    }

    //validate the adminPassword
    if (!empty($_POST['adminPassword'])) {
        $p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
    } else {
        $p = FALSE;
        echo '<p class="error"> You forgot to enter your password.</p>';
    }

    //if no problems
    if ($name && $p) {
        //Retrieve the adminName, adminPassword, adminID, adminPhoneNo, adminEmail
        $q = "SELECT adminName, adminPassword, adminID, adminPhoneNo, adminEmail
        FROM admin WHERE (adminName = '$name' AND
        adminPassword = '$p')";

        //run the query and assign it to the variable $result
        $result = mysqli_query($connect, $q);

        //count the number of rows that match the adminName/adminPassword combination
        //if one database row (record) matches the input:
        if (@mysqli_num_rows($result) == 1) {
            //start the session, fetch the record and insert the three values in an array
            session_start();
            $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

            echo '<p> Welcome to eLeave System<p>';

            //Redirect to userList.php
            header("Location: userList.php");
            exit();
        } else {
            echo '<p class ="error"> The adminName and adminPassword entered do not match our records
            <br> perhaps you need to register, just click the Register button</p>';
        }
        //if there was a problem
    } else {
        echo '<p class ="error"> Please try again. </p>';
    }
    mysqli_close($connect);
    } //end of submit conditional
    ?>
    <div class="container">
    <h2 class="page-title">Admin Login</h2>

    <form action="adminLogin.php" method="post" class="form">
        <div class="form-group">
            <label for="adminName" class="label">Admin Name:</label>
            <input type="text" id="adminName" name="adminName" class="input-field" size="30" maxlength="30" value="<?php if (isset($_POST['adminName'])) echo $_POST['adminName']; ?>" required>
        </div>

        <div class="form-group">
            <label for="adminPassword" class="label">Password:</label>
            <input type="password" id="adminPassword" name="adminPassword" class="input-field" size="15" maxlength="60" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must have at least 8 or more characters and contain at least one number and one uppercase letter" required>
        </div>

        <div>
            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn">Reset</button>
        </div>

        <div class="signup-link">
            <label>Don't have an account? <a href="adminRegister.php">Sign Up</a></label>
        </div>
    </form>
    </div>
</body>

</html>
