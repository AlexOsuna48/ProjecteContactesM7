<?php
session_start();
include '../Menu/header.php';
include '../Menu/menu.php';
include '../CSS/estilo-editar.css';
include '../login-usuarios/conexion.php';

// Obtiene el id del contacto que se va a editar
$id_contacto = $_GET['id_contacto'];

// Realiza una consulta para obtener los datos del contacto a editar
$sql = "SELECT * FROM contactos WHERE id_contacto = $id_contacto";
$resultado = mysqli_query($conn, $sql);
$contacto = mysqli_fetch_assoc($resultado);

// Verifica si se ha enviado el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Obtiene los datos actualizados del formulario
	$nombre = $_POST['nombre'];
	$numero = $_POST['numero'];
	$email = $_POST['email'];
	$direccion = $_POST['direccion'];
	$favorito = isset($_POST['favorito']) ? 1 : 0;

	// Actualiza los datos del contacto en la base de datos
	$sql = "UPDATE contactos SET nombre='$nombre', numero='$numero', email='$email', direccion='$direccion', favorito=$favorito WHERE id_contacto=$id_contacto";
	mysqli_query($conn, $sql);

	// Elimina las relaciones anteriores entre el contacto y los grupos
	$sql = "DELETE FROM contactos_grupos WHERE id_contacto = $id_contacto";
	mysqli_query($conn, $sql);

	// Obtiene los grupos seleccionados actualmente
	$grupos_seleccionados = isset($_POST['grupo']) ? $_POST['grupo'] : array();

	// Agrega las nuevas relaciones entre el contacto y los grupos seleccionados
	foreach ($grupos_seleccionados as $id_grupo) {
    	$sql = "INSERT INTO contactos_grupos (id_contacto, id_grupo) VALUES ($id_contacto, $id_grupo)";
    	mysqli_query($conn, $sql);
	}

	// Redirige de vuelta a la lista de contactos
	header('Location: ListaContactos.php');
	exit;
}
?>

<br>

<div class="container">
<<<<<<< HEAD
	<strong><h2>Editar contacto</h2></strong>
	<form method="POST">
    	<div class="form-group">
        	<label for="nombre">Nombre</label>
        	<input type="text" class="form-control" name="nombre" value="<?php echo $contacto['nombre']; ?>">
    	</div>
    	<div class="form-group">
        	<label for="numero">Número de teléfono</label>
        	<input type="text" class="form-control" name="numero" value="<?php echo $contacto['numero']; ?>">
    	</div>
    	<div class="form-group">
        	<label for="email">Correo electrónico</label>
        	<input type="email" class="form-control" name="email" value="<?php echo $contacto['email']; ?>">
    	</div>
    	<div class="form-group">
        	<label for="direccion">Dirección</label>
        	<input type="text" class="form-control" name="direccion" value="<?php echo $contacto['direccion']; ?>">
	</div>
	<div class="form-group form-check">
	<input type="checkbox" class="form-check-input" name="favorito" <?php
         	if ($contacto['favorito'] == 1) {
             	echo 'checked';
         	}
         	?>>
	<label class="form-check-label" for="favorito">Favorito</label>
	</div>
	<div class="form-group">
	<label for="grupo">Grupo</label>
	<select name="grupo[]" multiple>
	<?php
	// Obtener todos los grupos
	$query_grupos = "SELECT * FROM grupos";
	$resultado_grupos = mysqli_query($conn, $query_grupos);
            	// Obtener los grupos asociados al contacto
        	$query_grupos_contacto = "SELECT id_grupo FROM contactos_grupos WHERE id_contacto = $id_contacto";
        	$resultado_grupos_contacto = mysqli_query($conn, $query_grupos_contacto);
        	$grupos_previos = array();

        	while ($grupo_contacto = mysqli_fetch_assoc($resultado_grupos_contacto)) {
            	$grupos_previos[] = $grupo_contacto['id_grupo'];
        	}

        	// Mostrar opciones de grupos con la selección adecuada
        	while ($grupo = mysqli_fetch_assoc($resultado_grupos)) {
            	$selected = in_array($grupo['id_grupo'], $grupos_previos) ? 'selected' : '';
            	echo "<option value=\"" . $grupo['id_grupo'] . "\" $selected>" . $grupo['nombre'] . "</option>";
        	}
        	?>
    	</select>
	</div>

	<button type="submit" class="btn btn-primary" id="btn-guardar">Guardar cambios</button>
</form>
=======
    <strong><h2>Editar contacto</h2></strong>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $contacto['nombre']; ?>">
        </div>
        <div class="form-group">
            <label for="numero">Número de teléfono</label>
            <input type="text" class="form-control" name="numero" value="<?php echo $contacto['numero']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" value="<?php echo $contacto['email']; ?>">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" value="<?php echo $contacto['direccion']; ?>">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="favorito" <?php
            if ($contacto['favorito'] == 1) {
                echo 'checked';
            }
            ?>>
            <label class="form-check-label" for="favorito">Favorito</label>
        </div>
        <div class="form-group">
            <label for="id_grupo">Grupo</label>
            <select name="grupo[]" multiple>
                <?php
                //Selecciona todos los datos de la tabla grupos 
                $query_grupos = "SELECT * FROM grupos";
                //Se guarda los datos anteriores en la variable $resultado_grupos
                $resultado_grupos = mysqli_query($conn, $query_grupos);
                //Lee cada registro de $resulta_grupos
                while ($grupo = mysqli_fetch_array($resultado_grupos)) {
                    //Imprime los valores seleccionados y cada opcion tiene id_grupo y nombre 
                    echo "<option value=\"" . $grupo['id_grupo'] . "\">" . $grupo['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>


        <button type="submit" class="btn btn-primary" id="btn-guardar">Guardar cambios</button>

        <script>// Sirve para cuando le des al boton de guardar cambios salga una alerta con el mensaje de que se ha editado

            const btnGuardar = document.getElementById('btn-guardar');


            btnGuardar.addEventListener('click', () => {// Es el encargado de cuando le des clic al botón funcione

                alert('El contacto ha sido editado'); // Esto es lo que Muestra la alerta
            });
        </script>
    </form>
</div>
>>>>>>> 946da0cae0db9b061a36188384f7c10b1dd8c8c3
