```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $tenant_id = $_GET["id"];

    try {

        $sql = "DELETE FROM tenants
                WHERE tenant_id = $tenant_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This tenant cannot be deleted because they have an existing lease.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error deleting tenant: " . $e->getMessage();

        }

    }

}

?>
```
