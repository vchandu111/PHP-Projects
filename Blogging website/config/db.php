<?php

$host = 'localhost';
$db = "Blogging_Website_db";
$user = 'root';
$pass = 'Chaila@1628';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


try{
    $pdo = new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    throw new PDOException($e->getMessage(), $e->getCode());
}