<?php

$dbhost = "localhost"; 
$username = "root";
$password = "";
$database = "semestral";


$conn = new mysqli($dbhost, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$conn->set_charset("utf8");

?>
