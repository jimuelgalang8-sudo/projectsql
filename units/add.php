<?php

include "../config/database.php";

if (isset($_POST["submit"])) {

    $unit_number = $_POST["unit_number"];
    $unit_type = $_POST["unit_type"];
    $monthly_rent = $_POST["monthly_rent"];
    $status = $_POST["status"];

    $sql = "INSERT INTO units
            (unit_number, unit_type, monthly_rent, status)
            VALUES
            ('$unit_number', '$unit_type', '$monthly_rent', '$status')";

    if ($conn->query($sql) === TRUE) {

        header("Location: index.php");
        exit();

    } else {

        echo "<h2>Error adding unit</h2>";
        echo "<p>" . $conn->error . "</p>";
        echo "<br>";
        echo "<a href='index.php'>Back to Units</a>";

    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Unit</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
            margin: 0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
        }

        .container {
            width: 500px;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            box-shadow: 0 2px 5px gray;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        a {
            margin-left: 10px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Add Unit</h1>
</div>

<div class="container">

    <form method="POST">

        <label>Unit Number:</label>
        <input type="text" name="unit_number" required>

        <label>Unit Type:</label>
        <input type="text" name="unit_type" required>

        <label>Monthly Rent:</label>
        <input type="number" name="monthly_rent" step="0.01" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
            <option value="Maintenance">Maintenance</option>
        </select>

        <button type="submit" name="submit">Add Unit</button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>
</html>