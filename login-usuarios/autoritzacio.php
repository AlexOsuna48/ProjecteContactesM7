<?php

include ("conexion.php");

session_start();

//Guarda en una variable el nombre y la contraseña que hemos introducido en el formulario
$nombre = $_POST["username"];
$pass = $_POST["password"];

//Aqui busca si el usuario y la contraseña coinciden con el que esta en la base de datos 
$sql = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre' and contraseña = '$pass'";
$resultado = mysqli_query($conn, $sql);

//Aqui le estamos diciendo que si el usuario y la contraseña existe, nos lleve a la pagina de ListaContactos.php, si no es valido nos pondra que el usuario no es valido
if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $_SESSION['id_usuario'] = $fila['id_usuario'];
    $_SESSION['nombre_usuario'] = $fila['nombre_usuario'];
    header('Location: ../Contacto/ListaContactos.php');
    exit();
} else {
 header('Location: login.php?failed=true');    exit();
}

?>
