<?php

include "../config/database.php";

if (isset($_POST["submit"])) {

    $lease_id = $_POST["lease_id"];
    $utility_type = $_POST["utility_type"];
    $billing_month = $_POST["billing_month"];
    $amount = $_POST["amount"];
    $bill_status = $_POST["bill_status"];

    $sql = "INSERT INTO utility_bills
            (lease_id, utility_type, billing_month, amount, bill_status)
            VALUES
            ('$lease_id', '$utility_type', '$billing_month', '$amount', '$bill_status')";

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

    <title>Add Utility Bill</title>

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

    <h1>Add Utility Bill</h1>

</div>

<div class="container">

    <form method="POST">

        <label>Lease:</label>

        <select name="lease_id" required>

            <option value="">Select Lease</option>

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

                <option value="<?php echo $lease["lease_id"]; ?>">

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

            <option value="">Select Utility</option>
            <option value="Electricity">Electricity</option>
            <option value="Water">Water</option>

        </select>


        <label>Billing Month:</label>

        <input
            type="date"
            name="billing_month"
            required
        >


        <label>Amount:</label>

        <input
            type="number"
            name="amount"
            step="0.01"
            required
        >


        <label>Bill Status:</label>

        <select name="bill_status" required>

            <option value="Unpaid">Unpaid</option>
            <option value="Paid">Paid</option>
            <option value="Pending">Pending</option>

        </select>


        <button type="submit" name="submit">
            Add Utility Bill
        </button>

        <a href="index.php">Cancel</a>

    </form>

</div>

</body>

</html>