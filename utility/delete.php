```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $bill_id = $_GET["id"];

    try {

        $sql = "DELETE FROM utility_bills
                WHERE bill_id = $bill_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This utility bill cannot be deleted because it has an existing payment detail.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error deleting utility bill: " . $e->getMessage();

        }

    }

}

?>
