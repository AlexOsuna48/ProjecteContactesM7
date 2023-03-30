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

if (isset($_POST['nombre']) && isset($_POST['numero']) && isset($_POST['email']) && isset($_POST['direccion'])) {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO contactos(nombre,numero,email,favorito) VALUES('nombre','numero','email','direccion','favorito')";
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
                <label for="numero">Email</label>
                <input type="text" name="direccion" id="direccion">
            </div>

            <div class="numero">
                <label for="numero">Dirección</label>
                <input type="text" name="email" id="email">
            </div>

            <p></p>
            Marcar como Favorito:
            <input type="radio" name="Si/No" value="Si/No"/> Si
            <input type="radio" name="Si/No" value="Si/No"/> No
            <p></p>

            <button type="submit" class="btn btn-primary">Agregar Contacto</button>
        </form>


    </div>