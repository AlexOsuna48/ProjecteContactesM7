<body>

    <?php
    session_start();
    include '../login-usuarios/conexion.php';
    include '../Menu/menu.php';
    include '../CSS/estilo-NuevoContacto.css';
    
    //Comprueba si se han enviado los datos y si existen estos campos se enviara los datos introducidos
    if (isset($_POST['nombre']) && isset($_POST['numero']) && isset($_POST['email']) && isset($_POST['direccion'])) {
        
        //Son variables para los campos del formulario para insertar los datos
        $nombre = $_POST['nombre'];
        $numero = $_POST['numero'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $favorito = isset($_POST['favorito']) && $_POST['favorito'] == 'Si' ? 1 : 0;

        // Obtiene el id_usuario del usuario que esta conectado
        $id_usuario = $_SESSION['id_usuario'];

        //Inserta en la tabla Contactos los valores que hemos introducido en el formulario
        $sql = "INSERT INTO contactos(nombre, numero, email, direccion, favorito, id_usuario) VALUES('$nombre', '$numero', '$email', '$direccion', '$favorito', '$id_usuario')";

        if (mysqli_query($conn, $sql)) {
            
            //Crea el ID del nuevo contacto 
            $id_contacto = mysqli_insert_id($conn);
            
            // Para que pueda seleccionar varios grupos 
            if (isset($_POST['grupo'])) {
                //Mira la id del grupo seleccionado para luego inserte en la tabla Contactos_Grupos
                foreach ($_POST['grupo'] as $id_grupo) {
                    $sql = "INSERT INTO contactos_grupos(id_contacto, id_grupo) VALUES('$id_contacto', '$id_grupo')";
                    mysqli_query($conn, $sql);
                }
            }
            
            //Mensaje si ha introducido los datos correctamente 
            echo "<script>alert('Los datos se han insertado correctamente.')</script>";
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
                <strong>Marcar como Favorito:
                    <input type="radio" name="favorito" value="Si"/> Si
                    <input type="radio" name="favorito" value="No"/> No
                </strong>
                <p></p>

                <label for="grupo">Grupo:</label>
                <select name="grupo[]" multiple >
                    <?php
                    
                    //Selecciona todos los datos de la tabla grupos 
                    $query_grupos = "SELECT * FROM grupos";
                    //Se guarda los datos anteriores en la variable $resultado_grupos
                    $resultado_grupos = mysqli_query($conn, $query_grupos);
                    //Lee cada registro de $resulta_grupos
                    while ($grupo = mysqli_fetch_array($resultado_grupos)) {
                        //Imprime los valores seleccionados y cada opcion tiene id_grupo y nombre 
                        echo "<option value=\"" . $grupo['id_grupo'] . "\">" . $grupo['nombre'] . "</option>";
                    }
                    ?>
                </select>
                <div style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Agregar Contacto</button>
                </div>
            </form>
        </div>
    </div>
</body>
