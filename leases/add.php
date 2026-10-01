<?php

include "../config/database.php";

if (isset($_POST["submit"])) {

    $tenant_id = $_POST["tenant_id"];
    $unit_id = $_POST["unit_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $lease_status = $_POST["lease_status"];

    $sql = "INSERT INTO leases
            (tenant_id, unit_id, start_date, end_date, lease_status)
            VALUES
            ('$tenant_id', '$unit_id', '$start_date', '$end_date', '$lease_status')";

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

    <title>Add Lease</title>

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

    <h1>Add Lease</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Tenant:</label>

        <select name="tenant_id" required>

            <option value="">Select Tenant</option>

            <?php

            $tenant_sql = "SELECT * FROM tenants";
            $tenant_result = $conn->query($tenant_sql);

            while ($tenant = $tenant_result->fetch_assoc()) {

            ?>

                <option value="<?php echo $tenant["tenant_id"]; ?>">

                    <?php
                    echo $tenant["first_name"] . " " . $tenant["last_name"];
                    ?>

                </option>

            <?php

            }

            ?>

        </select>


        <label>Unit:</label>

        <select name="unit_id" required>

            <option value="">Select Unit</option>

            <?php

            $unit_sql = "SELECT * FROM units";
            $unit_result = $conn->query($unit_sql);

            while ($unit = $unit_result->fetch_assoc()) {

            ?>

                <option value="<?php echo $unit["unit_id"]; ?>">

                    <?php
                    echo $unit["unit_number"] . " - ₱" . $unit["monthly_rent"];
                    ?>

                </option>

            <?php

            }

            ?>

        </select>


        <label>Start Date:</label>

        <input type="date" name="start_date" required>


        <label>End Date:</label>

        <input type="date" name="end_date" required>


        <label>Lease Status:</label>

        <select name="lease_status" required>

            <option value="Active">Active</option>
            <option value="Expired">Expired</option>
            <option value="Terminated">Terminated</option>

        </select>


        <button type="submit" name="submit">
            Add Lease
        </button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>
```
