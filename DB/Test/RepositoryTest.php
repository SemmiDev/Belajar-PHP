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


$connection  = getConnection();
$repository = new \Repository\StudentRepositoryImpl($connection);

$sammi = new \Model\Student(100,"sammidev","1231","sam","32341");
$repository->insert($sammi);
$students = $repository->findAll();

var_dump($students);
$connection = null;