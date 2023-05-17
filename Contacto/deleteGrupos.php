<?php
include '../login-usuarios/conexion.php';

// Verifica si se recibió el parámetro id_contacto
if (isset($_GET['id_grupo'])) {
	$id_grupo = $_GET['id_grupo'];

	// Elimina primero los registros relacionados en la tabla "contactos_grupos"
	$sql = "DELETE FROM contactos_grupos WHERE id_grupo = $id_grupo";
	if (mysqli_query($conn, $sql)) {
    	// Si se eliminaron los registros de la tabla "contactos_grupos", se procede a eliminar el registro de la tabla "contactos"
    	$sql = "DELETE FROM grupos WHERE id_grupo = $id_grupo";
    	if (mysqli_query($conn, $sql)) {
        	header('Location: ListaContactos.php');
    	} else {
        	echo "Error al eliminar el grupo: " . mysqli_error($conn);
    	}
	} else {
    	echo "Error al eliminar los registros relacionados en la tabla 'grupos': " . mysqli_error($conn);
	}
} else {
	echo "No se recibió el parámetro id_grupo";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
