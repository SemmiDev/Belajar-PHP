<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'services/Service.php';

$id = $_GET["id"];
$result = query("SELECT * FROM student WHERE id=$id")[0];

if (isset($_POST["submit"])) {

    if(change($_POST) > 0 ) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
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
    <title>UPDATE STUDENT</title>
</head>
<body>
<h1>UPDATE STUDENT</h1>
<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" id="id" value="<?= $result["id"] ?> ">
<input type="hidden" name="oldImage" value="<?= $result["image"]; ?>">

    <ul>
        <li>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= $result["name"] ?>" required/>
        </li>
        <li>
            <label for="identifier">NIM</label>
            <input type="text" name="identifier" id="identifier"  value="<?= $result["identifier"] ?>" required/>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"  value="<?= $result["email"] ?>" required/>
        </li>
        <li>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone"  value="<?= $result["phone"] ?>" required/>
        </li>
        <li>
            <label for="major">Major</label>
            <input type="text" name="major" id="major"  value="<?= $result["major"] ?>" required/>
        </li>
        <li>
            <label for="image">Image</label><br>
            <img src="images/<?php echo $result['image'] ?>" style="width: 75px; height: 90px"/>
            <input type="file" name="image" id="image">
        </li>
        <li>
            <button type="submit" name="submit" id="submit">UPDATE</button>
        </li>
    </ul>
</form>
</body>
</html>