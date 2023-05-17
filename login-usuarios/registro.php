<?php

include ("conexion.php");
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre_usuario"];
    $contrasena = $_POST["contraseña"];

    // Consulta SQL para insertar los datos en la tabla "usuario"
    $sql = "INSERT INTO usuario (nombre_usuario, contraseña) VALUES ('$nombre', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
            header('Location: login.php');

    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
