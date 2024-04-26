<?php
include("header.php"); 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Theme Park System - List of Visitors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td a {
            text-decoration: none;
            color: #007bff;
        }

        td a:hover {
            text-decoration: underline;
        }

        .search-btn {
            margin-top: 20px;
            text-align: center;
        }

        .search-btn button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .search-btn button:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            margin-top: 20px;
            text-align: center;
        }

        .logout-btn button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .logout-btn button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>List of Visitors</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone No.</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php
            // make the query
            $q = "SELECT visitorID, visitorPassword, visitorName, visitorPhoneNo, visitorEmail FROM visitor ORDER BY visitorID";

            // run the query and assign it to the variable $result
            $result = @mysqli_query($connect, $q);

            if ($result) {
                // Fetch and print all the records
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo
                    '
                <tr>
                <td>' . $row["visitorID"] . '</td>
                <td>' . $row["visitorName"] . '</td>
                <td>' . $row["visitorPhoneNo"] . '</td>
                <td>' . $row["visitorEmail"] . '</td>
                <td><a href="userUpdate.php?id=' . $row['visitorID'] . '">Update</a></td>
                <td><a href="userDelete.php?id=' . $row['visitorID'] . '">Delete</a></td>
                </tr>';
                }
                // if failed to run
            } else {
                // error message
                echo '<tr><td colspan="6">The current user could not be retrieved. We apologize for any inconvenience.</td></tr>';
            } // end of if ($result)   
            // close the database connection
            mysqli_close($connect);
            ?>
        </table>

        <div class="search-btn">
            <button><a href="userSearch.php" style="color: #fff; text-decoration: none;">Search</a></button>
        </div>

        <div class="logout-btn">
            <button><a href="adminLogin.php" style="color: #fff; text-decoration: none;">Log Out</a></button>
        </div>

    </div>

</body>

</html>
