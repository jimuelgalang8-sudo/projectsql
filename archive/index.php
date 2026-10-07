<?php

include "../config/database.php";

$search = "";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
}

$sql = "SELECT * FROM archive
        WHERE record_type LIKE '%$search%'
           OR record_id LIKE '%$search%'
           OR record_details LIKE '%$search%'
           OR archived_at LIKE '%$search%'
        ORDER BY archive_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

    <title>Archive - Apartment Management System</title>

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
            margin-bottom: 30px;
        }

        .top h1 {
            margin: 0 0 10px 0;
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

            white-space: nowrap;
        }

        td {
            padding: 12px;

            border-bottom: 1px solid #eeeeee;

            white-space: nowrap;
        }

        tr:hover {
            background-color: #f8f8f8;
        }

        /* MOBILE */

        @media (max-width: 800px) {

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

                bottom: auto;

                left: auto;

                right: auto;

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

        .menu a i {
    margin-right: 10px;
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
            <i class="bi bi-house-door"></i>
             Dashboard
        </a>

        <a href="../tenants/index.php">
            <i class="bi bi-people"></i>
             Tenants
        </a>

        <a href="../units/index.php">
            <i class="bi bi-building"></i>
             Units
        </a>

        <a href="../leases/index.php">
            <i class="bi bi-file-earmark-text"></i>
             Leases
        </a>

        <a href="../payments/index.php">
            <i class="bi bi-cash-stack"></i>
             Payments
        </a>

        <a href="../utilities/index.php">
            <i class="bi bi-lightbulb"></i>
             Utility Bills
        </a>

        <a href="../payment_details/index.php">
            <i class="bi bi-link-45deg"></i>
             Payment Details
        </a>

        <a href="index.php" class="active">
            <i class="bi bi-archive"></i>
             Archive
        </a>

        <a href="../logout.php" class="logout">
            <i class="bi bi-box-arrow-right"></i>
             Logout
        </a>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="main">


    <div class="top">

        <h1>Archive</h1>

        <p>
            View archived records
        </p>

    </div>


    <div class="toolbar">

        <form method="GET" class="search-form">

            <input
                type="text"
                name="search"
                placeholder="Search archive..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button type="submit">
                Search
            </button>

            <a href="index.php" class="clear">
                Clear
            </a>

        </form>

    </div>


    <div class="table-container">

        <table>

            <tr>

                <th>Archive ID</th>

                <th>Record Type</th>

                <th>Record ID</th>

                <th>Record Details</th>

                <th>Archived At</th>

            </tr>


            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <tr>

                <td>
                    <?php echo $row["archive_id"]; ?>
                </td>

                <td>
                    <?php echo $row["record_type"]; ?>
                </td>

                <td>
                    <?php echo $row["record_id"]; ?>
                </td>

                <td>
                    <?php echo $row["record_details"]; ?>
                </td>

                <td>
                    <?php echo $row["archived_at"]; ?>
                </td>

            </tr>

            <?php

                }

            } else {

                echo "<tr>";
                echo "<td colspan='5' style='text-align:center;'>No archived records found.</td>";
                echo "</tr>";

            }

            ?>

        </table>

    </div>


</div>


</body>

</html>