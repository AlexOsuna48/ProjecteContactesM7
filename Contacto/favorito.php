<html>
    <body>

        <?php
        session_start();
        include '../login-usuarios/conexion.php';
        include '../CSS/estilo-favorito.css';
        include '../Menu/menu.php';
//Comprueba si el usuario ha iniciado sesión
//Obtiene el id_usuario del usuario actualmente conectado
        $id_usuario = $_SESSION['id_usuario'];

        $id_contacto = mysqli_insert_id($conn);

        //Hacemos una consulta para mostrar solo las columnas que solo tenga SI en Favoritos dependiendo del usuario
        $sql = "select nombre, numero, email, direccion, favorito from mostrar_fav WHERE id_usuario = $id_usuario";
        $resultado = mysqli_query($conn, $sql);
        if (!$resultado) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        ?>

        <div class="container">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre </th>                
                        <th scope="col">Número </th>  
                        <th scope="col">Email </th>  
                        <th scope="col">Dirección </th>  
                        <th scope="col">Favorito </th> 
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //Aqui mostramos los datos de cada contacto en una tabla 
                    while ($contacto = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $contacto['nombre'] . "</td>";
                        echo "<td>" . $contacto['numero'] . "</td>";
                        echo "<td>" . $contacto['email'] . "</td>";
                        echo "<td>" . $contacto['direccion'] . "</td>";
                        echo "<td>" . ($contacto['favorito'] == 1 ? 'Si' : 'No') . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </body>
</html