<?php

include "../config/database.php";

if (!isset($_GET["id"])) {
    die("No tenant ID was provided.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM tenants WHERE tenant_id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Tenant not found.");
}

$row = $result->fetch_assoc();


if (isset($_POST["submit"])) {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $contact_number = $_POST["contact_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $sql = "UPDATE tenants SET
            first_name = '$first_name',
            last_name = '$last_name',
            contact_number = '$contact_number',
            email = '$email',
            address = '$address'
            WHERE tenant_id = $id";

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

    <title>Edit Tenant</title>

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

        input {
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

    <h1>Edit Tenant</h1>

</div>

<div class="container">

    <form method="POST">

        <label>First Name:</label>
        <input type="text"
               name="first_name"
               value="<?php echo $row['first_name']; ?>"
               required>


        <label>Last Name:</label>
        <input type="text"
               name="last_name"
               value="<?php echo $row['last_name']; ?>"
               required>


        <label>Contact Number:</label>
        <input type="text"
               name="contact_number"
               value="<?php echo $row['contact_number']; ?>"
               required>


        <label>Email:</label>
        <input type="email"
               name="email"
               value="<?php echo $row['email']; ?>">


        <label>Address:</label>
        <input type="text"
               name="address"
               value="<?php echo $row['address']; ?>">


        <button type="submit" name="submit">
            Update Tenant
        </button>

        <a href="index.php">
            Cancel
        </a>

    </form>

</div>

</body>

</html>