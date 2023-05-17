<?php
include '../login-usuarios/conexion.php';
include '../CSS/estilo-listaContactos.css';

// Aquí debes incluir la conexión a la base de datos
// Obtener la lista de usuarios desde la base de datos
$query = "SELECT * FROM usuario";
$resultado = mysqli_query($conn, $query);
?>
<br>
<a href="login.php" class="boton">Atras</a>
<br>
<div class="container-scroll">
    <table>
        <thead>
            <tr>
                <th scope="col">id_usuario</th>
                <th scope="col">Nombre</th>           	 
            </tr>
        </thead>
        <tbody>

<?php
// Si esta todo correcto muestra los contactos 
if ($resultado) {
    if (mysqli_num_rows($resultado) > 0) {
        while ($usuarios = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $usuarios["id_usuario"] . "</td>";
            echo "<td>" . $usuarios["nombre_usuario"] . "</td>";
            echo "<td><a href='eliminar_user.php?id_usuario=" . $usuarios['id_usuario'] . "'><img src='../papelera.png' class='centrada'></a>
</td>";
            echo "</tr>";
        }
    }
}
?>

        </tbody>
    </table>
</div>