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
$sql = "SELECT name,price FROM product";
$statement = $connection->query($sql);

foreach ($statement as $row) {
    $name = $row["name"];
    $price = $row["price"];

    echo "Name : $name" . PHP_EOL;
    echo "Price : $price" . PHP_EOL;
}

$connection = null;