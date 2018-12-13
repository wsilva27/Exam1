<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "soccer";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Error occurred:" . $e->getMessage());
}