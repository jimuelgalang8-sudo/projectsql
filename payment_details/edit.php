<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No payment detail ID was provided.");
}

$id = $_GET["id"];


/* Get existing payment detail */

$sql = "SELECT * FROM payment_details
        WHERE payment_detail_id = $id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Payment detail not found.");
}

$row = $result->fetch_assoc();


/* Update payment detail */

if (isset($_POST["submit"])) {

    $payment_id = $_POST["payment_id"];
    $bill_id = $_POST["bill_id"];
    $amount_paid = $_POST["amount_paid"];

    $sql = "UPDATE payment_details
            SET payment_id = '$payment_id',
                bill_id = '$bill_id',
                amount_paid = '$amount_paid'
            WHERE payment_detail_id = $id";

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

    <title>Edit Payment Detail</title>

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
        }

        a {
            margin-left: 10px;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="header">

    <h1>Edit Payment Detail</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Payment:</label>

        <select name="payment_id" required>

            <?php

            $payments = $conn->query("SELECT payment_id, payment_date, amount
                                      FROM payments
                                      ORDER BY payment_id");

            while ($payment = $payments->fetch_assoc()) {

            ?>

                <option value="<?php echo $payment["payment_id"]; ?>"
                    <?php
                    if ($payment["payment_id"] == $row["payment_id"]) {
                        echo "selected";
                    }
                    ?>>

                    Payment #<?php echo $payment["payment_id"]; ?>
                    - ₱<?php echo $payment["amount"]; ?>
                    - <?php echo $payment["payment_date"]; ?>

                </option>

            <?php

            }

            ?>

        </select>


        <label>Utility Bill:</label>

        <select name="bill_id" required>

            <?php

            $bills = $conn->query("SELECT bill_id, utility_type, billing_month, amount
                                   FROM utility_bills
                                   ORDER BY bill_id");

            while ($bill = $bills->fetch_assoc()) {

            ?>

                <option value="<?php echo $bill["bill_id"]; ?>"
                    <?php
                    if ($bill["bill_id"] == $row["bill_id"]) {
                        echo "selected";
                    }
                    ?>>

                    Bill #<?php echo $bill["bill_id"]; ?>
                    - <?php echo $bill["utility_type"]; ?>
                    - ₱<?php echo $bill["amount"]; ?>
                    - <?php echo date("F Y", strtotime($bill["billing_month"])); ?>

                </option>

            <?php

            }

            ?>

        </select>


        <label>Amount Paid:</label>

        <input type="number"
               name="amount_paid"
               step="0.01"
               value="<?php echo $row["amount_paid"]; ?>"
               required>


        <button type="submit" name="submit">Update Payment Detail</button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>