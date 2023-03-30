<?php

include ("conexion.php");

$nombre = $_POST["username"];
$pass = $_POST["password"];



    $sql = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre' and contraseña = '$pass'";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        
        header('Location: ../ListaContactos.php');
        exit();
    } else {
        echo 'usuario no valido';
        exit();
    }
?>