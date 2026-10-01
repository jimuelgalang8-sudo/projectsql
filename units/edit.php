<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No unit ID was provided.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM units WHERE unit_id = $id";
$result = $conn->query($sql);

if (!$result) {
    die("Error: " . $conn->error);
}

if ($result->num_rows == 0) {
    die("Unit not found.");
}

$row = $result->fetch_assoc();

if (isset($_POST["submit"])) {

    $unit_number = $_POST["unit_number"];
    $unit_type = $_POST["unit_type"];
    $monthly_rent = $_POST["monthly_rent"];
    $status = $_POST["status"];

    $sql = "UPDATE units SET
            unit_number = '$unit_number',
            unit_type = '$unit_type',
            monthly_rent = '$monthly_rent',
            status = '$status'
            WHERE unit_id = $id";

    if ($conn->query($sql) === TRUE) {

        header("Location: index.php");
        exit();

    } else {

        echo "Error: " . $conn->error;

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Unit</title>

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

        <h1>Edit Unit</h1>

    </div>

    <div class="container">

        <form method="POST">

            <label>Unit Number:</label>

            <input type="text"
                   name="unit_number"
                   value="<?php echo $row['unit_number']; ?>"
                   required>


            <label>Unit Type:</label>

            <input type="text"
                   name="unit_type"
                   value="<?php echo $row['unit_type']; ?>"
                   required>


            <label>Monthly Rent:</label>

            <input type="number"
                   name="monthly_rent"
                   value="<?php echo $row['monthly_rent']; ?>"
                   required>


            <label>Status:</label>

            <select name="status" required>

                <option value="Available"
                    <?php if ($row['status'] == 'Available') echo 'selected'; ?>>
                    Available
                </option>

                <option value="Occupied"
                    <?php if ($row['status'] == 'Occupied') echo 'selected'; ?>>
                    Occupied
                </option>

                <option value="Maintenance"
                    <?php if ($row['status'] == 'Maintenance') echo 'selected'; ?>>
                    Maintenance
                </option>

            </select>


            <button type="submit" name="submit">
                Update Unit
            </button>

            <a href="index.php">Cancel</a>

        </form>

    </div>

</body>

</html>
