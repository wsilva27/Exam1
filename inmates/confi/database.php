<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host=$servername;dbname=jail", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$conn = null;
?>
