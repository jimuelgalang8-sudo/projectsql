```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $payment_detail_id = $_GET["id"];

    try {

        $sql = "DELETE FROM payment_details
                WHERE payment_detail_id = $payment_detail_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        echo "Error deleting payment detail: " . $e->getMessage();

    }

}

?>
