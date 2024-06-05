<?php

$host = 'localhost';
$dbname = 'cm';
$username = 'root';
$password = "Chaila@1628";

// PDO options for error handling and connection persistence
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throws exceptions on error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetches data as associative array
    PDO::ATTR_EMULATE_PREPARES => false, // uses native prepared statements
    PDO::ATTR_PERSISTENT => true // enables persistent connections
];

/**
 * function to get a PDO connection
 * 
 * return PDO
 * 
 * 
 */

 function getConnection(){
    global $host,$dbname,$username,$password,$options;

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $username,$password,$options);
        echo "Successfully connected to DB";
    } catch (PDOException $e) {
        //throw $th;
        echo "Failed to connect";
        return null;
    }
 }