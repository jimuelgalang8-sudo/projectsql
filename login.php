<?php

session_start();

include "config/database.php";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users
            WHERE username = '$username'
            AND password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["full_name"] = $user["full_name"];

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid username or password.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login - Apartment Management System</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;

            display: flex;
            justify-content: center;
            align-items: center;

            height: 100vh;
        }

        .login-box {
            width: 350px;
            background-color: white;

            padding: 30px;

            box-shadow: 0 0 10px #cccccc;

            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: #666666;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;

            margin-top: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;

            box-sizing: border-box;

            border: 1px solid #cccccc;
        }

        button {
            width: 100%;

            margin-top: 20px;

            padding: 10px;

            background-color: #333333;
            color: white;

            border: none;

            cursor: pointer;
        }

        button:hover {
            background-color: #555555;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

    <div class="login-box">

        <h1>Apartment Management System</h1>

        <p>Admin Login</p>

        <?php

        if (isset($error)) {

            echo "<div class='error'>$error</div>";

        }

        ?>

        <form method="POST">

            <label>Username:</label>

            <input type="text" name="username" required>

            <label>Password:</label>

            <input type="password" name="password" required>

            <button type="submit" name="login">
                Login
            </button>

        </form>

    </div>

</body>

</html>