<?php
session_start();

include 'login-usuarios/conexion.php';
include 'Menu/header.php';
include 'Menu/menu.php';
include 'CSS/estilo-NuevoContacto.css';

if (isset($_POST['nombre']) && isset($_POST['numero']) && isset($_POST['email']) && isset($_POST['direccion'])) {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $favorito = isset($_POST['favorito']) && $_POST['favorito'] == 'Si' ? 1 : 0;

    $id_usuario = $_SESSION['id_usuario'];

    $sql = "INSERT INTO contactos(nombre, numero, email, direccion, favorito, id_usuario) VALUES('$nombre', '$numero', '$email', '$direccion', '$favorito', '$id_usuario')";

    if (mysqli_query($conn, $sql)) {
        echo "Los datos se han insertado correctamente";
        $id_contacto = mysqli_insert_id($conn); //Obtener el ID del contacto insertado

        // Insertar las relaciones entre el contacto y los grupos
        if (isset($_POST['grupo'])) {
            foreach ($_POST['grupo'] as $id_grupo) {
                $sql = "INSERT INTO contactos_grupos(id_contacto, id_grupo) VALUES('$id_contacto', '$id_grupo')";
                mysqli_query($conn, $sql);
            }
        }
    } else {
        echo "Error al insertar los datos: " . mysqli_error($conn);
    }
}
?>

<div class="contenedor">
    <div class="contenido">
        <h2>Nuevo Contacto</h2>
        <form action="NuevoContacto.php" method="post">
            <div class="nombre">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre">
            </div>

            <div class="numero">
                <label for="numero">Numero</label>
                <input type="text" name="numero" id="numero">
            </div>

            <div class="numero">
                <label for="direccion">Email</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="numero">
                <label for="email">Dirección</label>
                <input type="text" name="direccion" id="direccion">
            </div>

            <p></p>
            Marcar como Favorito:
            <input type="radio" name="favorito" value="Si"/> Si
            <input type="radio" name="favorito" value="No"/> No
            <p></p>

            <label for="grupo">Grupo:</label>
            <select name="grupo[]" multiple>
                <?php
                $query_grupos = "SELECT * FROM grupos";
                $resultado_grupos = mysqli_query($conn, $query_grupos);
                while ($grupo = mysqli_fetch_array($resultado_grupos)) {
                    echo "<option value=\"" . $grupo['id_grupo'] . "\">" . $grupo['nombre'] . "</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn btn-primary">Agregar Contacto</button>
        </form>
    </div>
</div>