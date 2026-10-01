<?php

include "../config/database.php";

$search = "";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
}

$sql = "SELECT * FROM tenants
        WHERE first_name LIKE '%$search%'
        OR last_name LIKE '%$search%'
        OR contact_number LIKE '%$search%'
        OR email LIKE '%$search%'
        OR address LIKE '%$search%'
        ORDER BY tenant_id ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tenants - Apartment Management System</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6f8;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;

            left: 0;
            top: 0;

            width: 240px;
            height: 100vh;

            background-color: #222;

            color: white;

            padding: 25px 15px;
        }

        .logo {
            text-align: center;

            font-size: 20px;
            font-weight: bold;

            margin-bottom: 35px;
        }

        .menu a {
            display: block;

            color: #dddddd;

            text-decoration: none;

            padding: 13px 15px;

            margin-bottom: 5px;

            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #444;

            color: white;
        }

        .menu .active {
            background-color: #444;

            color: white;
        }

        .logout {
            position: absolute;

            bottom: 25px;

            left: 15px;
            right: 15px;

            background-color: #333;

            text-align: center;
        }

        /* MAIN CONTENT */

        .main {
            margin-left: 240px;

            padding: 35px;
        }

        .top {
            margin-bottom: 25px;
        }

        .top h1 {
            margin: 0 0 8px 0;
        }

        .top p {
            color: #666;

            margin: 0;
        }

        /* TOOLBAR */

        .toolbar {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .search-form {
            display: flex;

            gap: 10px;
        }

        .search-form input {
            width: 300px;

            padding: 10px;

            border: 1px solid #cccccc;

            border-radius: 5px;
        }

        button {
            padding: 10px 18px;

            background-color: #333;

            color: white;

            border: none;

            border-radius: 5px;

            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .clear {
            padding: 10px 18px;

            background-color: #eeeeee;

            color: #333;

            text-decoration: none;

            border-radius: 5px;
        }

        .add-button {
            padding: 10px 18px;

            background-color: #333;

            color: white;

            text-decoration: none;

            border-radius: 5px;
        }

        .add-button:hover {
            background-color: #555;
        }

        /* TABLE */

        .table-container {
            background-color: white;

            padding: 20px;

            border-radius: 8px;

            box-shadow: 0 2px 8px #dddddd;

            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            background-color: #333;

            color: white;

            padding: 12px;

            text-align: left;
        }

        td {
            padding: 12px;

            border-bottom: 1px solid #eeeeee;
        }

        tr:hover {
            background-color: #f8f8f8;
        }

        .edit {
            color: #333;

            text-decoration: none;

            margin-right: 10px;
        }

        .delete {
            color: #c0392b;

            text-decoration: none;
        }

        /* MOBILE */

        @media (max-width: 900px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;

                padding: 25px;
            }

            .toolbar {
                display: block;
            }

            .search-form {
                margin-bottom: 15px;
            }

        }

        @media (max-width: 600px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;
            }

            .logout {
                position: relative;

                left: auto;
                right: auto;
                bottom: auto;

                margin-top: 20px;
            }

            .main {
                margin-left: 0;

                padding: 20px;
            }

            .search-form {
                display: block;
            }

            .search-form input {
                width: 100%;

                margin-bottom: 10px;
            }

        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        APARTMENT<br>
        MANAGEMENT

    </div>


    <div class="menu">

        <a href="../dashboard.php">
            🏠 Dashboard
        </a>

        <a href="index.php" class="active">
            👤 Tenants
        </a>

        <a href="../units/index.php">
            🏢 Units
        </a>

        <a href="../leases/index.php">
            📄 Leases
        </a>

        <a href="../payments/index.php">
            💵 Payments
        </a>

        <a href="../utilities/index.php">
            💡 Utility Bills
        </a>

        <a href="../payment_details/index.php">
            🔗 Payment Details
        </a>

        <a href="../logout.php" class="logout">
            🚪 Logout
        </a>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="main">


    <div class="top">

        <h1>Tenants</h1>

        <p>
            Manage tenant information
        </p>

    </div>


    <div class="toolbar">


        <form method="GET" class="search-form">

            <input
                type="text"
                name="search"
                placeholder="Search tenants..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button type="submit">
                Search
            </button>

            <a href="index.php" class="clear">
                Clear
            </a>

        </form>


        <a href="add.php" class="add-button">
            + Add Tenant
        </a>


    </div>


    <div class="table-container">

        <table>

            <tr>

                <th>ID</th>

                <th>First Name</th>

                <th>Last Name</th>

                <th>Contact</th>

                <th>Email</th>

                <th>Address</th>

                <th>Action</th>

            </tr>


            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <tr>

                <td>
                    <?php echo $row["tenant_id"]; ?>
                </td>

                <td>
                    <?php echo $row["first_name"]; ?>
                </td>

                <td>
                    <?php echo $row["last_name"]; ?>
                </td>

                <td>
                    <?php echo $row["contact_number"]; ?>
                </td>

                <td>
                    <?php echo $row["email"]; ?>
                </td>

                <td>
                    <?php echo $row["address"]; ?>
                </td>

                <td>

                    <a
                        href="edit.php?id=<?php echo $row["tenant_id"]; ?>"
                        class="edit"
                    >
                        Edit
                    </a>

                    <a
                        href="delete.php?id=<?php echo $row["tenant_id"]; ?>"
                        class="delete"
                        onclick="return confirm('Are you sure you want to delete this tenant?');"
                    >
                        Delete
                    </a>

                </td>

            </tr>

            <?php

                }

            } else {

                echo "<tr>";
                echo "<td colspan='7' style='text-align:center;'>No tenants found.</td>";
                echo "</tr>";

            }

            ?>

        </table>

    </div>


</div>


</body>

</html>