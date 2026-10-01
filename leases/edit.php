<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No lease ID was provided.");
}

$id = $_GET["id"];

/* Get the lease */
$sql = "SELECT * FROM leases WHERE lease_id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Lease not found.");
}

$lease = $result->fetch_assoc();


/* Update the lease */
if (isset($_POST["submit"])) {

    $tenant_id = $_POST["tenant_id"];
    $unit_id = $_POST["unit_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $lease_status = $_POST["lease_status"];

    $sql = "UPDATE leases SET
            tenant_id = '$tenant_id',
            unit_id = '$unit_id',
            start_date = '$start_date',
            end_date = '$end_date',
            lease_status = '$lease_status'
            WHERE lease_id = $id";

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

    <title>Edit Lease</title>

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

    <h1>Edit Lease</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Tenant:</label>

        <select name="tenant_id" required>

            <?php

            $tenant_sql = "SELECT * FROM tenants";
            $tenant_result = $conn->query($tenant_sql);

            while ($tenant = $tenant_result->fetch_assoc()) {

                ?>

                <option value="<?php echo $tenant["tenant_id"]; ?>"
                    <?php
                    if ($tenant["tenant_id"] == $lease["tenant_id"]) {
                        echo "selected";
                    }
                    ?>>

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

            <?php

            $unit_sql = "SELECT * FROM units";
            $unit_result = $conn->query($unit_sql);

            while ($unit = $unit_result->fetch_assoc()) {

                ?>

                <option value="<?php echo $unit["unit_id"]; ?>"
                    <?php
                    if ($unit["unit_id"] == $lease["unit_id"]) {
                        echo "selected";
                    }
                    ?>>

                    <?php
                    echo $unit["unit_number"] . " - ₱" . $unit["monthly_rent"];
                    ?>

                </option>

                <?php

            }

            ?>

        </select>


        <label>Start Date:</label>

        <input
            type="date"
            name="start_date"
            value="<?php echo $lease["start_date"]; ?>"
            required
        >


        <label>End Date:</label>

        <input
            type="date"
            name="end_date"
            value="<?php echo $lease["end_date"]; ?>"
            required
        >


        <label>Lease Status:</label>

        <select name="lease_status" required>

            <option value="Active"
                <?php
                if ($lease["lease_status"] == "Active") {
                    echo "selected";
                }
                ?>>
                Active
            </option>

            <option value="Expired"
                <?php
                if ($lease["lease_status"] == "Expired") {
                    echo "selected";
                }
                ?>>
                Expired
            </option>

            <option value="Terminated"
                <?php
                if ($lease["lease_status"] == "Terminated") {
                    echo "selected";
                }
                ?>>
                Terminated
            </option>

        </select>


        <button type="submit" name="submit">
            Update Lease
        </button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>