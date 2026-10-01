<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No bill ID was provided.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM utility_bills WHERE bill_id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Utility bill not found.");
}

$bill = $result->fetch_assoc();


if (isset($_POST["submit"])) {

    $lease_id = $_POST["lease_id"];
    $utility_type = $_POST["utility_type"];
    $billing_month = $_POST["billing_month"];
    $amount = $_POST["amount"];
    $bill_status = $_POST["bill_status"];

    $sql = "UPDATE utility_bills SET
            lease_id = '$lease_id',
            utility_type = '$utility_type',
            billing_month = '$billing_month',
            amount = '$amount',
            bill_status = '$bill_status'
            WHERE bill_id = $id";

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

    <title>Edit Utility Bill</title>

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

    <h1>Edit Utility Bill</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Lease:</label>

        <select name="lease_id" required>

            <?php

            $lease_sql = "SELECT leases.*,
                                 tenants.first_name,
                                 tenants.last_name,
                                 units.unit_number
                          FROM leases
                          INNER JOIN tenants
                          ON leases.tenant_id = tenants.tenant_id
                          INNER JOIN units
                          ON leases.unit_id = units.unit_id";

            $lease_result = $conn->query($lease_sql);

            while ($lease = $lease_result->fetch_assoc()) {

            ?>

                <option value="<?php echo $lease["lease_id"]; ?>"
                    <?php
                    if ($lease["lease_id"] == $bill["lease_id"]) {
                        echo "selected";
                    }
                    ?>>

                    <?php

                    echo $lease["first_name"] . " "
                       . $lease["last_name"]
                       . " - Unit "
                       . $lease["unit_number"];

                    ?>

                </option>

            <?php

            }

            ?>

        </select>


        <label>Utility Type:</label>

        <select name="utility_type" required>

            <option value="Electricity"
                <?php
                if ($bill["utility_type"] == "Electricity") {
                    echo "selected";
                }
                ?>>
                Electricity
            </option>

            <option value="Water"
                <?php
                if ($bill["utility_type"] == "Water") {
                    echo "selected";
                }
                ?>>
                Water
            </option>

        </select>


        <label>Billing Month:</label>

        <input
            type="date"
            name="billing_month"
            value="<?php echo $bill["billing_month"]; ?>"
            required
        >


        <label>Amount:</label>

        <input
            type="number"
            name="amount"
            step="0.01"
            value="<?php echo $bill["amount"]; ?>"
            required
        >


        <label>Bill Status:</label>

        <select name="bill_status" required>

            <option value="Unpaid"
                <?php
                if ($bill["bill_status"] == "Unpaid") {
                    echo "selected";
                }
                ?>>
                Unpaid
            </option>

            <option value="Paid"
                <?php
                if ($bill["bill_status"] == "Paid") {
                    echo "selected";
                }
                ?>>
                Paid
            </option>

            <option value="Pending"
                <?php
                if ($bill["bill_status"] == "Pending") {
                    echo "selected";
                }
                ?>>
                Pending
            </option>

        </select>


        <button type="submit" name="submit">
            Update Utility Bill
        </button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>