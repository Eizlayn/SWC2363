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

        h1 {
            text-align: center;
            margin-bottom: 20px;
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

        #submit {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        #submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    //call file to connect server eleave
    include("header.php")
    ?>

<div class="container">
        <form action="userFound.php" method="post">
            <h1>Search Visitor Record</h1>
            <div class="form-group">
                <label class="label" for="visitorName">Visitor Name:</label>
                <input id="visitorName" type="text" name="visitorName" class="input-field" size="30" maxlength="50" value="<?php if (isset($_POST['visitorName'])) echo $_POST['visitorName']; ?>" />
            </div>
            <input id="submit" type="submit" name="submit" value="Search" />
        </form>
    </div>
</body>

</html>