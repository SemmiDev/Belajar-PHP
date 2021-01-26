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
$username = "sammidev'; #";
$password = "sammidev";

$sql = "SELECT * FROM ADMIN WHERE username = :username AND password = :password";
$statement = $connection->prepare($sql);
$statement->bindParam("username", $username);
$statement->bindParam("password", $password);
$statement->execute();

$success = false;
$find_user = null;

foreach ($statement as $row) {
    $success = true;
    $find_user = $row['username'];
}

if ($success) {
    echo "LOGIN SUCCESSFULLY -> " . $find_user . PHP_EOL;
}else {
    echo "LOGIN FAILED" . PHP_EOL;
}

$connection = null;


// PREPARE INDEX

$username = "sammidev";
$connection = getConnection();
$sql = "SELECT * FROM ADMIN WHERE username = ? AND password = ?";
$statement = $connection->prepare($sql);
$statement->bindParam(1, $username);
$statement->bindParam(2, $password);
$statement->execute();

$success = false;
$find_user = null;
foreach ($statement as $row) {
    // sukses
    $success = true;
    $find_user = $row["username"];
}

if ($success) {
    echo "LOGIN SUCCESSFULLY -> " . $find_user . PHP_EOL;
} else {
    echo "LOGIN FAILED" . PHP_EOL;
}

$connection = null;

// PREPARE INDEX WITHOUT BIND
$connection = getConnection();
$sql = "SELECT * FROM ADMIN WHERE username = ? AND password = ?";
$statement = $connection->prepare($sql);
$statement->execute([$username, $password]);

$success = false;
$find_user = null;
foreach ($statement as $row) {
    $success = true;
    $find_user = $row["username"];
}

if ($success) {
    echo "LOGIN SUCCESSFULLY -> " . $find_user . PHP_EOL;
} else {
    echo "LOGIN FAILED" . PHP_EOL;
}


// PREPARED NON QUERY
$username = "sammidev2";
$password = "sammidev2";
$connection = getConnection();
$sql = "INSERT INTO ADMIN(username, password) VALUES (:username, :password)";
$statement = $connection->prepare($sql);
$statement->bindParam("username", $username);
$statement->bindParam("password", $password);
$statement->execute();

$connection = null;
