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
$sql = <<< SQL
    INSERT INTO students(id,name,nim,email,phone) 
    VALUES('1','sammidev','0000000000','sammidev@gmail.com','08122323423');
SQL;

$connection->exec($sql);
$connection = null;