<?php

include 'Menu/header.php';
include 'Menu/menu.php';

$host = "localhost";
$user = "root";
$password = "";
$dbname = "M7ListaContactos";

// Crea la conexión
$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id_contacto = mysqli_insert_id($conn);

$sql = "select nombre,numero,email,direccion,favorito,id_usuario,id_grupo from contactos";
$resultado = mysqli_query($conn, $sql);
?>

<div class="container">
    <br>
    <a href="NuevoContacto.php">Nou</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">nombre </th>                
                <th scope="col">numero </th>  
                <th scope="col">email </th>  
                <th scope="col">dirección </th>  
                <th scope="col">favorito </th>  

            </tr>
        </thead>
        <tbody>

            <?php
            
            
            while($conacto = mysqli_fetch_array($resultado)){
                echo "<tr>";
                echo "<td>" . $contacto['nombre'] . "</td>";
                echo "<td>" . $contacto['numero'] . "</td>";
                echo "<td>" . $contacto['email'] . "</td>";
                echo "<td>" . $contacto['dirección'] . "</td>";
                echo "<td>" . $contacto['favorito'] . "</td>";
                echo "</tr>";
            } 
            ?>

        </tbody>
    </table>
</div>