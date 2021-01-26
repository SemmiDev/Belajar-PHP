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
$connection->beginTransaction();
$connection->exec("DELETE FROM students WHERE id = 3");
$connection->commit();