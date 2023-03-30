<?php
    
$host = "localhost";
$user = "root";
$password = "";
$dbname = "M7ListaContactos";

// Crea la conexión
$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>