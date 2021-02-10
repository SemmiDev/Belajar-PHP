<?php
    require_once 'services/Service.php';

    if (isset($_POST["register"])) {
        if (signUp($_POST) > 0) {
            echo "
                <script>
                    alert('SUCCESS');
                    document.location.href = 'login.php';
                </script>
            ";
        }else {
            $conn = $conn = mysqli_connect("localhost","root","","belajar_php");
            echo mysqli_error($conn);
        }
    }

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORM REGISTRATION</title>
    <style>
        label {
            display: block;
        }

    </style>
</head>
<body>

<form action="" method="post">
    <ul>
        <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </li>
        <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" required>
        </li>
        <li>
            <button type="submit" id="register" name="register">Sign Up</button>
        </li>
    </ul>
</form>

</body>
</html>