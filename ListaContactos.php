<html>
    <body>

        <?php
        session_start();
        
        include 'Menu/menu.php';
        include 'login-usuarios/conexion.php';
        include 'CSS/estilo-listaContactos.css';

// Comprobamos si el usuario ha iniciado sesión
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: login.php');
            exit();
        }

// Para obtener el id_usuario del usuario que esta conectado 
        $id_usuario = $_SESSION['id_usuario'];

// En esta consulta lo que queremos hacer es que muestre el nombre, numero, email, direccion, favorito 
// y el grupo pero que en el grupo se muestre en la misma fila que el contacto y no en una nueva  
        $sql = "SELECT c.id_contacto, c.nombre, c.numero, c.email, c.direccion, c.favorito, 
        (SELECT GROUP_CONCAT(g.nombre SEPARATOR ', ') 
         FROM contactos_grupos cg 
         JOIN grupos g ON cg.id_grupo = g.id_grupo 
         WHERE cg.id_contacto = c.id_contacto) AS grupos 
        FROM contactos c 
        WHERE c.id_usuario = $id_usuario 
        ORDER BY c.id_contacto";

// En esta consulta es para actualizar los números de miembros de cada grupo
        $sql_update = "UPDATE grupos g
               LEFT JOIN (SELECT id_grupo, COUNT(*) AS num_miembros FROM contactos_grupos GROUP BY id_grupo) cg
               ON g.id_grupo = cg.id_grupo
               SET g.num_miembros = IFNULL(cg.num_miembros, 0)";

// Ejecutar la consulta
        $resultado_update = mysqli_query($conn, $sql_update);

// Comprobar si se ha actualizado correctamente
        if (!$resultado_update) {
            echo "Error al actualizar los números de miembros: " . mysqli_error($conn);
        }



        $resultado = mysqli_query($conn, $sql);

// Comprovamos si hay algun error entre la base de datos y la consulta
        if (!$resultado) {
            // Si hay un error, muestra el mensaje de error de MySQL
            echo "Error: " . mysqli_error($conn);
        }
        ?>

        <div class="container">
            <br>
            <a href="NuevoContacto.php" class="boton">Nuevo</a>
            <br>
            <br>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>                
                        <th scope="col">Número</th>  
                        <th scope="col">Email</th>  
                        <th scope="col">Dirección</th>  
                        <th scope="col">Favorito</th> 
                        <th scope="col">Grupo</th>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // Si esta todo correcto muestra los contactos en formato tabla
                    if ($resultado) {
                        if (mysqli_num_rows($resultado) > 0) {
                            while ($contacto = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $contacto["nombre"] . "</td>";
                                echo "<td>" . $contacto["numero"] . "</td>";
                                echo "<td>" . $contacto["email"] . "</td>";
                                echo "<td>" . $contacto["direccion"] . "</td>";
                                echo "<td>" . ($contacto["favorito"] == 1 ? "Si" : "No") . "</td>";
                                echo "<td>" . $contacto["grupos"] . "</td>";

                                echo "<td><a href= 'delete.php?id_contacto=" . $contacto['id_contacto'] . "'> Eliminar </a></td>";
                                echo "<td><a href='editar.php?id_contacto=" . $contacto['id_contacto'] . "'>Editar</a></td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </body>
</html>