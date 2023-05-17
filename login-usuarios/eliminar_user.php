<?php
include 'conexion.php';


if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Eliminar los registros de la tabla contactos_grupos relacionados con los contactos del usuario
    $query = "DELETE cg FROM contactos_grupos cg
              INNER JOIN contactos c ON cg.id_contacto = c.id_contacto
              WHERE c.id_usuario = $id_usuario";
    mysqli_query($conn, $query);

    // Eliminar los contactos del usuario
    $query = "DELETE FROM contactos WHERE id_usuario = $id_usuario";
    mysqli_query($conn, $query);

    // Eliminar el usuario de la tabla usuario
    $query = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirigir nuevamente a la página seleccion_usuarios.php después de la eliminación exitosa
        header("Location: seleccion_usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conn);
    }
}
?>


