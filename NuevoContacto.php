<?php
include 'login-usuarios/conexion.php';
include 'Menu/header.php';
include 'Menu/menu.php';
include 'CSS/estilo-NuevoContacto.css'
?>

<?php
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['nombre']) && isset($_POST['numero']) && isset($_POST['email']) && isset($_POST['direccion']) && isset($_POST['opciones'])) {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $grupo = $_POST['opciones'];
    $favorito = isset($_POST['favorito']) && $_POST['favorito'] == 'Si' ? 1 : 0;

    $sql = "INSERT INTO contactos(nombre, numero, email, direccion, favorito, id_grupo) VALUES('$nombre', '$numero', '$email', '$direccion', '$favorito', '$grupo')";

    if (mysqli_query($conn, $sql)) {
        echo "Los datos se han insertado correctamente";
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

         <label for="opciones">Elegir grupo
    <select id="opciones" name="opciones">
        <option value="">--</option>
        <?php
        $sql = "SELECT id_grupo, nombre FROM grupos";
        $resultado = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<option value=\"" . $row['id_grupo'] . "\">" . $row['nombre'] . "</option>";
        }
        ?>
    </select>
</label>

            <button type="submit" class="btn btn-primary">Agregar Contacto</button>
        </form>


    </div>