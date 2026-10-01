<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No payment ID was provided.");
}

$id = $_GET["id"];


/* Get the payment */
$sql = "SELECT * FROM payments WHERE payment_id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Payment not found.");
}

$payment = $result->fetch_assoc();


/* Update the payment */
if (isset($_POST["submit"])) {

    $lease_id = $_POST["lease_id"];
    $payment_date = $_POST["payment_date"];
    $amount = $_POST["amount"];
    $payment_method = $_POST["payment_method"];
    $payment_status = $_POST["payment_status"];

    $sql = "UPDATE payments SET
            lease_id = '$lease_id',
            payment_date = '$payment_date',
            amount = '$amount',
            payment_method = '$payment_method',
            payment_status = '$payment_status'
            WHERE payment_id = $id";

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

    <title>Edit Payment</title>

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

    <h1>Edit Payment</h1>

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
                    if ($lease["lease_id"] == $payment["lease_id"]) {
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


        <label>Payment Date:</label>

        <input
            type="date"
            name="payment_date"
            value="<?php echo $payment["payment_date"]; ?>"
            required
        >


        <label>Amount:</label>

        <input
            type="number"
            name="amount"
            step="0.01"
            value="<?php echo $payment["amount"]; ?>"
            required
        >


        <label>Payment Method:</label>

        <select name="payment_method" required>

            <option value="Cash"
                <?php
                if ($payment["payment_method"] == "Cash") {
                    echo "selected";
                }
                ?>>
                Cash
            </option>

            <option value="Bank Transfer"
                <?php
                if ($payment["payment_method"] == "Bank Transfer") {
                    echo "selected";
                }
                ?>>
                Bank Transfer
            </option>

            <option value="GCash"
                <?php
                if ($payment["payment_method"] == "GCash") {
                    echo "selected";
                }
                ?>>
                GCash
            </option>

        </select>


        <label>Payment Status:</label>

        <select name="payment_status" required>

            <option value="Paid"
                <?php
                if ($payment["payment_status"] == "Paid") {
                    echo "selected";
                }
                ?>>
                Paid
            </option>

            <option value="Pending"
                <?php
                if ($payment["payment_status"] == "Pending") {
                    echo "selected";
                }
                ?>>
                Pending
            </option>

            <option value="Cancelled"
                <?php
                if ($payment["payment_status"] == "Cancelled") {
                    echo "selected";
                }
                ?>>
                Cancelled
            </option>

        </select>


        <button type="submit" name="submit">
            Update Payment
        </button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>