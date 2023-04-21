<?php

include ("conexion.php");

session_start();

$nombre = $_POST["username"];
$pass = $_POST["password"];

$sql = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre' and contraseña = '$pass'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $_SESSION['id_usuario'] = $fila['id_usuario'];
    $_SESSION['nombre_usuario'] = $fila['nombre_usuario'];
    header('Location: ../ListaContactos.php');
    exit();
} else {
    echo 'usuario no valido';
    exit();
}

?>
