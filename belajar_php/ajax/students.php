<?php

require '../services/Service.php';

$keyword = $_GET["keyword"];

$sql = "SELECT * FROM student WHERE
          name LIKE '%$keyword%' OR
          identifier LIKE '%$keyword%' OR
          email LIKE '%$keyword%' OR
          phone LIKE '%$keyword%' OR
          phone LIKE '%$keyword%'
        ";

$students =  query($sql);
?>

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