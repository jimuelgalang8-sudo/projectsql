```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $lease_id = $_GET["id"];

    try {

        $sql = "DELETE FROM leases
                WHERE lease_id = $lease_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This lease cannot be deleted because it has related payments or utility bills.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error deleting lease: " . $e->getMessage();

        }

    }

}

?>
```
