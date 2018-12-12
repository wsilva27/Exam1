<?php
/* database init */
$host = "localhost:3306";
$db_name = "SOCCER";
$username = "root";
$password = "";

/* database connection */
try{
    $con = new \PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}catch(PDOException $e){
    echo "Connection error: $e->getMessage()";
}
?>
