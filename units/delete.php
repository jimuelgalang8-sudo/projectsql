```php
<?php

include "../config/database.php";

if (isset($_GET["id"])) {

    $unit_id = $_GET["id"];

    try {

        $sql = "DELETE FROM units
                WHERE unit_id = $unit_id";

        $conn->query($sql);

        header("Location: index.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {

            echo "<script>";

            echo "alert('This unit cannot be deleted because it has an existing lease.');";

            echo "window.location.href='index.php';";

            echo "</script>";

            exit();

        } else {

            echo "Error deleting unit: " . $e->getMessage();

        }

    }

}

?>
```
