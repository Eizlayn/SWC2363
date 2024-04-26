<html>

<head>
    <title>Theme Park System - Edit Visitors Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
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
    </style>
</head>

<body>
    <?php
    // call file to connect server eleave
    include("header.php");
    ?>

<div class="container">
        <h2>Edit Visitor's Record</h2>

    <?php
    // look for a valid user id, either through GET or POST
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } else if (isset($_POST['id']) && (is_numeric($_POST['id']))) {
        $id =  $_POST['id'];
    } else {
        echo '<p class="error">This Page has been accessed in error</p>';
        exit();
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array(); //initialize an error array

        //look for a adminName
        if (empty($_POST['visitorName'])) {
            $error[] = 'Your forget to enter your name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['visitorName']));
        }

        // look for a adminPhoneNo
        if (empty($_POST['visitorPhoneNo'])) {
            $error[] = 'Your forgot to enter your phone number';
        } else {
            $ph = mysqli_real_escape_string($connect, trim($_POST['visitorPhoneNo']));
        }

        // look for a visitorEmail
        if (empty($_POST['visitorEmail'])) {
            $error[] = 'Your forgot to enter your email.';
        } else {
            $e = mysqli_real_escape_string($connect, trim($_POST['visitorEmail']));
        }

        // if no problem occured
        if (empty($error)) {
            $q = "SELECT visitorID FROM visitor WHERE visitorName = '$n' AND visitorID != $id";

            $result = @mysqli_query($connect, $q); //run the query

            if (mysqli_num_rows($result) == 0) {
                $q = "UPDATE visitor SET visitorName = '$n', visitorPhoneNo = '$ph', visitorEmail = '$e' WHERE visitorID = '$id' LIMIT 1";

                $result = @mysqli_query($connect, $q); //run the query
                if (mysqli_affected_rows($connect) == 1) {
                    echo '<script>alert("The visitor has been edited");
                    window.location.href = "userList.php";
                    </script>';
                } else {
                    echo '<p class="error">The visitor has not been edited due to the system error, We apologize for any inconvenience.</p>';
                    echo '<p>' . mysqli_error($connect) . '<br/> query:' . $q . '</p>';
                }
            } else {
                echo '<p class="error">The id had been registered</p>';
            }
        } else {
            echo '<p class="error">The following error (s)  occured: <br/>';
            foreach ($error as $msg) {
                echo '-' . $msg . '<br>\n';
            }
            echo '<p>Please try again</p></p>';
        }
    }

    $q = "SELECT visitorName, visitorPhoneNo, visitorEmail FROM visitor WHERE visitorID = $id";

    $result = @mysqli_query($connect, $q); // run the query

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        //create the form

        echo '<form action="userUpdate.php" method="post">
        <p><label class="label" for="visitorName">User Name*:</label>
        <input type="text" id="visitorName" name="visitorName" size="30" maxlength="50" value="' . $row[0] . '">
        </p>

        <p><label class="label" for="visitorPhoneNo">Phone No*:</label>
        <input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="visitorPhoneNo" name="visitorPhoneNo" size="15" maxlength="20" value="' . $row[1] . '">
        </p>

        <p><label class="label" for="visitorEmail">User Email*:</label>
        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="visitorEmail" name="visitorEmail" size="30" maxlength="50" required value="' . $row[2] . '">
        </p>

        <br><p><input id="submit" type="submit" name="submit" value="Update"></p>
        <br><input type="hidden" name="id" value="' . $id . '"/>
        </form>';
    } else { //if it didn't run
        //message
        echo '<p class="error">This page has been acessed in error</p>';
    } // end of it (result)
    mysqli_close($connect); //close the database connection_aborted

    ?>

</div>
</body>

</html>