<html>


<head>
    <title>Theme Park System</title>
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

    use function PHPSTORM_META\type;

    include("header.php");
    ?>

<div class="container">
        <h2>Delete Visitor Record</h2>

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
        if ($_POST['sure'] == 'Yes') //Delete the record
        {
            // make the query
            $q = "DELETE FROM visitor WHERE visitorID = $id LIMIT 1";
            $result = @mysqli_query($connect, $q); //run the query

            if (mysqli_affected_rows($connect) == 1) //if there was a problem
            //display message
            {
                echo '<script>alert("The visitor has been deleted.");
                window.location.href="userList.php";</script>';
            } else {
                // display error message
                echo '<p class="error">The record could not be deleted.<br>
                Probably because it does not exist or due to system error.</p>';

                echo '<p>' . mysqli_error($connect) . '<br/> Query:' . $q . '</p>';
                //debugging message
            }
        } else {
            echo '<script>alert("The visitor has NOT been deleted.");
            window.location.href="userList.php";</script>';
        }
    } else {
        //display the form
        //retrieve the member's date

        $q = "SELECT visitorName FROM visitor WHERE visitorID = $id";
        $result = @mysqli_query($connect, $q); //run the query

        if (mysqli_num_rows($result) == 1) {
            //get admin information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo '<h3>Are you sure want to permanently delete ' . $row[0] . '?</h3>';
            echo '<form action="userDelete.php" method="post">
            <input id="submit-no" type="submit" name="sure" value="Yes">
            <input id="submit-no" type="submit" name="sure" value="No">
            <input type="hidden" name="id" value="' . $id . '">
            </form>';
        } else { //if it didn't run
            //message
            echo '<p class="error">This page has been acessed in error</p>';
            echo '<p>$nbsp</p>';
        } //end of it (result)
    }
    mysqli_close($connect); //close the database connection_aborted
    ?>
</body>

</html>