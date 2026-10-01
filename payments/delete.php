```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $payment_id = $_GET["id"];

    try {

        $sql = "DELETE FROM payments
                WHERE payment_id = $payment_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This payment cannot be deleted because it has an existing payment detail.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error deleting payment: " . $e->getMessage();

        }

    }

}

?>