<?php

include 'login-usuarios/conexion.php';

// Verifica si se recibió el parámetro id_contacto
if (isset($_GET['id_contacto'])) {
    $id_contacto = $_GET['id_contacto'];
    
    //ELIMINA DATOS DE LA TABLA CONTACTO
    $sql = "DELETE FROM contactos WHERE id_contacto = $id_contacto";
    if (mysqli_query($conn, $sql)) {
        echo "Contacto eliminado correctamente";
    } else {
        echo "Error al eliminar el contacto: " . mysqli_error($conn);
    }
} else {
    echo "No se recibió el parámetro id_contacto";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);

?>