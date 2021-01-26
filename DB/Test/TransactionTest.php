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

$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam1@test.com', 'hi1')");
$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam2@test.com', 'hi2')");
$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam3@test.com', 'hi3')");
$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam4@test.com', 'hi4')");
$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam5@test.com', 'hi5')");

$connection->commit();

$connection = null;



// rollback
$connection = getConnection();

$connection->beginTransaction();

$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam6@test.com', 'hi6')");
$connection->exec("INSERT INTO ADMIN(username, password) VALUES ('sam7@test.com', 'hi7')");

$connection->rollBack();

$connection = null;





