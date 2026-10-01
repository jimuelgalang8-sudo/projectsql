<?php

include "../config/database.php";

if (isset($_POST["submit"])) {

    $payment_id = $_POST["payment_id"];
    $bill_id = $_POST["bill_id"];
    $amount_paid = $_POST["amount_paid"];

    $sql = "INSERT INTO payment_details
            (payment_id, bill_id, amount_paid)
            VALUES
            ('$payment_id', '$bill_id', '$amount_paid')";

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

    <title>Add Payment Detail</title>

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

    <h1>Add Payment Detail</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Payment:</label>

        <select name="payment_id" required>

            <option value="">Select Payment</option>

            <?php

            $payments = $conn->query("SELECT payment_id, payment_date, amount
                                      FROM payments
                                      ORDER BY payment_id");

            while ($payment = $payments->fetch_assoc()) {

            ?>

                <option value="<?php echo $payment["payment_id"]; ?>">

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

            <option value="">Select Utility Bill</option>

            <?php

            $bills = $conn->query("SELECT bill_id, utility_type, billing_month, amount
                                   FROM utility_bills
                                   ORDER BY bill_id");

            while ($bill = $bills->fetch_assoc()) {

            ?>

                <option value="<?php echo $bill["bill_id"]; ?>">

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

        <input type="number" name="amount_paid" step="0.01" required>


        <button type="submit" name="submit">Add Payment Detail</button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>