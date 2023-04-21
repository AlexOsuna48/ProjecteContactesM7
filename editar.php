<?php
session_start();
include 'Menu/header.php';
include 'Menu/menu.php';
include 'CSS/estilo-NuevoContacto.css';
include 'login-usuarios/conexion.php';


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
    $id_grupo = $_POST['id_grupo'];

    // Actualiza los datos del contacto en la base de datos
    $sql = "UPDATE contactos SET nombre='$nombre', numero='$numero', email='$email', direccion='$direccion', favorito=$favorito, id_grupo=$id_grupo WHERE id_contacto=$id_contacto";
    mysqli_query($conn, $sql);

    // Redirige de vuelta a la lista de contactos
    header('Location: ListaContactos.php');
    exit;
}

?>

        <br>

                <div class="container">
        <h2>Editar contacto</h2>
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
                    <input type="checkbox" class="form-check-input" name="favorito" <?php if ($contacto['favorito'] == 1) {echo 'checked';} ?>>
                    <label class="form-check-label" for="favorito">Favorito</label>
                </div>
                <div class="form-group">
                    <label for="id_grupo">Grupo</label>
                    <select class="form-control" name="id_grupo">
                    <?php
                    // Muestra los grupos disponibles en un menú desplegable
                    $sql = "SELECT * FROM grupos";
                    $resultado = mysqli_query($conn, $sql);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $selected = $fila['id_grupo'] == $contacto['id_grupo'] ? 'selected' : '';
                        echo "<option value='{$fila['id_grupo']}' $selected>{$fila['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>