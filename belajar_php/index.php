<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'services/Service.php';

// pagination
$jumlahDataPerPage = 2;
$jumlahData = count(query("SELECT * FROM student"));
$jumlahPage = ceil($jumlahData / $jumlahDataPerPage);
$pageAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
$awalData = ( $jumlahDataPerPage * $pageAktif ) - $jumlahDataPerPage;

$students = query("SELECT * FROM student LIMIT $awalData, $jumlahDataPerPage");

    $index = 1;

//    if( isset($_POST["search"]) ) {
//        $students = search($_POST["keyword"]);
//        if ($students[0] == null) {
//            header("Location: datanotfound.php");
//        }
//    }

if(isset($_POST["search"]) ) {
    $students = search($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE</title>

    <style>
        .center{
            margin-left: auto;
            margin-right:auto;
        }

        td, p, a {
            text-align: center;
            text-decoration: none;
        }

    </style>
</head>
<body>
<h1><a href="logout.php">exit</a></h1>
    <h1 align="center">STUDENT LIST</h1>




<form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus placeholder="search..." autocomplete="off" id="keyword">
    <button type="submit" name="search" id="search">Search!</button>
</form>






<br><br>

<!-- navigasi -->
<a href="?page=1">awal</a>

<?php if( $pageAktif > 1 ) : ?>
    <a href="?page=<?= $pageAktif - 1; ?>">&laquo;</a>
<?php endif; ?>

<?php for( $i = 1; $i <= $jumlahPage; $i++ ) : ?>
    <?php   if( $i == $pageAktif ) : ?>
        <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
    <?php else : ?>
        <a href="?page=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if( $pageAktif < $jumlahPage ) : ?>
    <a href="?page=<?= $pageAktif + 1; ?>">&raquo;</a>
<?php endif; ?>

<a href="?page=<?= $jumlahPage; ?>">akhir</a>
<br>

<a href="add.php"><p>ADD STUDENT</p></a>

<br><br>

<div id="container">
    <table class="center" border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>NO</th>
            <th>ACTION</th>
            <th>IMAGE</th>
            <th>NIM</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>MAJOR</th>
            <th>CREATED AT</th>
        </tr>

        <?php foreach($students as $row): ?>
        <tr>
            <td><?= $index ?> </td>
            <td>
                <a href="change.php?id=<?= $row["id"]; ?>">CHANGE</a> |
                <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">DELETE</a>
            </td>
            <td><img src="images/<?= $row["image"] ?>" alt="sample" width="30" height="50"></td>
            <td><?= $row["identifier"] ?> </td>
            <td><?= $row["name"] ?> </td>
            <td><?= $row["email"] ?> </td>
            <td><?= $row["phone"] ?> </td>
            <td><?= $row["major"] ?> </td>
            <td><?= $row["created_at"] ?> </td>
        </tr>

        <?php $index++; ?>
        <?php endforeach; ?>
    </table>
</div>


<script src="script/script.js"></script>
</body>
</html>