<!DOCTYPE html>
<html lang="en">

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
            max-width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    //call file to connect server eleave
    include("header.php")
    ?>
    <div class="container">
        <h2>Search Result</h2>

        <?php
        $in = $_POST['visitorName'];
        $in = mysqli_real_escape_string($connect, $in);

        //make the query
        $q = "SELECT * FROM visitor WHERE visitorName='$in' ORDER BY visitorID";

        //run the query and assign it to the variable $result
        $result = @mysqli_query($connect, $q);

        if ($result) {
            //table heading
            echo '<table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE NO.</th>
                <th>EMAIL</th>
            </tr>';

            //Fetch and print all the records
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>
                    <td>' . $row['visitorID'] . '</td>
                    <td>' . $row['visitorName'] . '</td>
                    <td>' . $row['visitorPhoneNo'] . '</td>
                    <td>' . $row['visitorEmail'] . '</td>
                </tr>';
            }
            //close the table
            echo '</table>';

            //free the resources
            mysqli_free_result($result);
        } else {
            //error message
            echo '<p class="error">If no record is shown, this is because you had an incorrect or missing entry in the search form. Click the back button on the browser and try again.</p>';
            //debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br/>Query:' . $q . '</p>';
        } //end of it ($result)
        //close the database connection
        mysqli_close($connect);
        ?>
    </div>
</body>

</html>