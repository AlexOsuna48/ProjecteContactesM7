<?php
session_start();
include 'Menu/header.php';
include 'Menu/menu.php';
include 'CSS/estilo-editar.css';
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

    // Actualiza los datos del contacto en la base de datos
    $sql = "UPDATE contactos SET nombre='$nombre', numero='$numero', email='$email', direccion='$direccion', favorito=$favorito WHERE id_contacto=$id_contacto";
    mysqli_query($conn, $sql);

    $sql = "SELECT id_grupo FROM contactos_grupos WHERE id_contacto = $id_contacto";
    $resultado = mysqli_query($conn, $sql);
    $grupos_previos = array(); //Esto lo utilizamos para guardar los grupos con el SELECT
    while ($grupo_previo = mysqli_fetch_assoc($resultado)) {
        $grupos_previos[] = $grupo_previo['id_grupo'];
    }

    // Obtiene los grupos seleccionados actualmente
    $grupos_seleccionados = isset($_POST['grupo']) ? $_POST['grupo'] : array();

    // Agrega nuevas relaciones entre el contacto y los grupos seleccionados
    foreach ($grupos_seleccionados as $id_grupo) {
        if (!in_array($id_grupo, $grupos_previos)) {
            $sql = "INSERT INTO contactos_grupos (id_contacto, id_grupo) VALUES ($id_contacto, $id_grupo)";
            mysqli_query($conn, $sql);
        }
    }

    // Elimina las relaciones entre el contacto y los grupos que ya no están seleccionados
    foreach ($grupos_previos as $id_grupo) {
        if (!in_array($id_grupo, $grupos_seleccionados)) {
            $sql = "DELETE FROM contactos_grupos WHERE id_contacto = $id_contacto AND id_grupo = $id_grupo";
            mysqli_query($conn, $sql);
        }
    }

    // Actualiza los datos del contacto en la base de datos
    $sql = "UPDATE contactos SET nombre='$nombre', numero='$numero', email='$email', direccion='$direccion', favorito=$favorito WHERE id_contacto=$id_contacto";
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
                
                //Muestra todos los grupos
                $query_grupos = "SELECT * FROM grupos";
                $resultado_grupos = mysqli_query($conn, $query_grupos);
                while ($grupo = mysqli_fetch_array($resultado_grupos)) {
                    echo "<option value=\"" . $grupo['id_grupo'] . "\">" . $grupo['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>