<?php
include '../CSS/estilo-login.css';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <!--Made with love by Mutiullah Samim -->

        <!--Bootsrap 4 CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    </head>
    <script>
    // Verifica si el parámetro 'failed' está en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const failed = urlParams.get('failed');

    // Si hay un parámetro 'failed', muestra la alerta
    if (failed) {
    alert('Usuario o contraseña incorrectos.');
    }
</script>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Iniciar Sesion</h3>

                </div>
                <div class="card-body">
                    <form method="POST" action="autoritzacio.php">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="usuario" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="contraseña" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" value="Entrar" name="enviar" class="btn float-right login_btn">
                        </div>
                    </form>
                    <form method="GET" action="registro1.php">
                        <div class="form-group">
                            <input type="submit" value="Registrarse" class="btn float-left register_btn">
                        </div>
                    </form>
                    <form method="GET" action="seleccion_usuarios.php">
                        <div class="form-group">
                            <input type="submit" value="Eliminar" class="btn float-right usuarios_btn">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>