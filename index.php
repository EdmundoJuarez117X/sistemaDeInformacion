<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="styles/css/style.css">
    <title>Inicio de Sesión</title>
</head>

<body>
    <img class="wave" src="img/wave.jpg" alt="">
    <div class="container">
        <div class="img">
            <img src="img/welcoming.svg" alt="">
        </div>
        <div class="login-container">
            <form method="post" action="index.php">
                <img class="avatar" src="img/avatar.svg" alt="login avatar">
                <h2>Bienvenido</h2>
                <?php
                // Conexión a la base de datos
                include "model/connection.php";
                // Controlador para acceder al login
                include "controllers/controller_login.php";
                ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h5>Correo Electrónico</h5>
                        <input class="input" name="email" type="text">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Contraseña</h5>
                        <input class="input" name="password" type="password">
                    </div>
                </div>
                <a href="#">¿Olvidaste la contraseña?</a>
                <input name="btn_ingresar" type="submit" class="btn" value="Iniciar Sesión">
            </form>
        </div>
    </div>
    <!-- Script para controlar los inputs del formulario -->
    <script type="text/javascript" src="js/main.js"></script>

</body>

</html>