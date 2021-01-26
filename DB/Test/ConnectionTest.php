<?php

$host = "localhost";
$port = 3306;
$database = "BELAJAR";
$username = "root";
$password = "";

try {
    $connection = new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
    echo "SUCCESS" . PHP_EOL;
    // close connection
    $connection = null;
}catch (PDOException $exception) {
    echo "FAILED " . $exception->getMessage() . PHP_EOL;
}