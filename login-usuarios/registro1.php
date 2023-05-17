<?php
include '../CSS/estilo-login.css';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
    <head>
        <title>Login Page</title>
        <!--Made with love by Mutiullah Samim -->

        <!--Bootsrap 4 CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>

        <div class="container">

            <div class="d-flex justify-content-center h-100">
               
                <div class="card">
                    <div class="card-header">
                        <h3>Registrar un nuevo usuario</h3>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="registro.php">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nombre_usuario" placeholder="usuario" required>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" name="contraseña" placeholder="contraseña" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" value="Entrar" name="enviar" class="btn float-right login_btn">
                                 <br>
                <a href="login.php" class="btn float-left register_btn">Atras</a>
                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>