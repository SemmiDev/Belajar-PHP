<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'services/Service.php';

if (isset($_POST["submit"])) {

    if(tambah($_POST) > 0 ) {
        echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
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
    <title>ADD STUDENT</title>
</head>
<body>
<h1>ADD STUDENT</h1>
<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </li>
        <li>
            <label for="identifier">NIM</label>
            <input type="text" name="identifier" id="identifier" required>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </li>
        <li>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" required>
        </li>
        <li>
            <label for="major">Major</label>
            <input type="text" name="major" id="major" required>
        </li>
        <li>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </li>

        <li>
            <button type="submit" name="submit" id="submit">SUBMIT</button>
        </li>
    </ul>
</form>
</body>
</html>