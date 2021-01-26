<?php

function getConnection()
{
    $host = "localhost";
    $port = "3306";
    $database = "BELAJAR";
    $username = "root";
    $password = "";

    return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
}

$connection = getConnection();

$username = "admin'; #";
$password = "salah gak peduli";
$sql = "SELECT * FROM ADMIN WHERE username = '$username' AND password = '$password';";

echo $sql . PHP_EOL;

$statement = $connection->query($sql);

$success = false;
$find_user = null;
foreach ($statement as $row) {
// sukses
$success = true;
$find_user = $row["username"];
}

if ($success) {
echo "Sukse login : " . $find_user . PHP_EOL;
} else {
echo "Gagal login" . PHP_EOL;
}

$connection = null;
