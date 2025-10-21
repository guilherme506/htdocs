<?php
$host = "localhost"; 
$user = "root";
$password = "";
$dbname = "morango";

$conn = mysqli_connect(
    $host, 
    $user,
    $password,
    $dbname
);
if (!$conn) {
    die("Conexão Falhou! " . 
        mysqli_connect_error());
}
?>