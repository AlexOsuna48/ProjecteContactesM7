<?php
session_start(); // Iniciar la sesión

include '../Menu/menu.php';
include '../login-usuarios/conexion.php';
include '../CSS/estilo-grupos.css';

if (isset($_POST['nombre'])) {
	$nombre = $_POST['nombre'];
	// Obtiene el id_usuario del usuario que está conectado    
	$id_usuario = $_SESSION['id_usuario'];

	// Asignar un valor al campo "id_grupo"
	$id_grupo = mysqli_insert_id($conn);

	$sql = "INSERT INTO grupos (id_grupo, nombre) VALUES ('$id_grupo', '$nombre')";

	if (mysqli_query($conn, $sql)) {
    	echo "<script>alert('Los datos se han insertado correctamente.')</script>";
	} else {
    	echo "Error al insertar los datos: " . mysqli_error($conn);
	}
}
?>

<div class="contenedor">
	<div class="contenido">
    	<h2>Nuevo Grupo</h2>
    	<form action="Grupos.php" method="post">
        	<div class="nombre">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" id="nombre">
        	</div>
        	<div style="text-align: right;">
            	<button type="submit" class="btn btn-primary">Agregar Grupos</button>
        	</div>
    	</form>
	</div>
</div>
