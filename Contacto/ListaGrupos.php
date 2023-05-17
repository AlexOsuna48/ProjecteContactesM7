<?php
session_start();

include '../Menu/menu.php';
include '../login-usuarios/conexion.php';
include '../CSS/estilo-listaGrupos.css';

// Comprobamos si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
	header('Location: login.php');
	exit();
}



// Obtiene el id_usuario del usuario que está conectado
$id_usuario = $_SESSION['id_usuario'];


$query = "SELECT grupos.id_grupo, grupos.nombre FROM grupos ";
// Verificar si ocurrió un error en la consulta
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
	die("Error en la consulta: " . mysqli_error($conn));
}
?>


<br>
<a href="Grupos.php" class="boton">Nuevo</a>
<br>

<div class="container-scroll">
	<table>
    	<thead>
        	<tr>
            	<th scope="col">ID</th>
            	<th scope="col">Nombre</th>     	 
            	<th scope="col">Eliminar</th>   

        	</tr>
    	</thead>

<?php
if ($resultado) {
	if (mysqli_num_rows($resultado) > 0) {
    	while ($grupos = mysqli_fetch_assoc($resultado)) {
        	echo "<tr>";
        	echo "<td>" . $grupos["id_grupo"] . "</td>";
        	echo "<td>" . $grupos["nombre"] . "</td>";
        	echo "<td><a href='deleteGrupos.php?id_grupo=" . $grupos['id_grupo'] . "'><img src='../papelera.png' class='left'></a></td>";


        	echo "</tr>";
    	}
	}
}
?>

   	 
	</table>
</div>
</body>
</html>
