<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome API -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" cossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="styles/css/stylev2.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulario de inicio de sesion -->
                <form method="post" action="altindex.php" class="sign-in-form">
                    <h2 class="title">Iniciar Sesión</h2>
                    <?php
                    // Conexión a la base de datos
                    include "model/connection.php";
                    // Controlador para acceder al login
                    include "controllers/controller_login.php";
                    ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Correo Electrónico" name="email" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="password" required>
                    </div>
                    <input type="submit" name="btn_ingresar" value="Iniciar Sesión" class="btn solid">

                    <p class="social-text">O acceder con una red social</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <!-- Formulario de registro -->
                <form method="post" action="altindex.php" class="sign-up-form">
                    <h2 class="title">Registrarse</h2>
                    <?php
                    // Conexión a la base de datos
                    include "model/connection.php";
                    // Controlador para acceder al login
                    include "controllers/controller_signup.php";
                    ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombre" name="nombre_persona" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Apellido Paterno" name="apellido_paterno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Apellido Materno" name="apellido_materno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Correo electrónico" name="email_persona" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="password_persona" required>
                    </div>
                    <input type="submit" name="btn_registrar" value="Registrarse"  class="btn solid">

                    <p class="social-text">O acceder con una red social</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¿Aspirante o Padre de Familia?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Pariatur voluptatibus numquam omnis, asperiores
                        est quia molestias vel error voluptatem maiores!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">Registrarse</button>
                </div>
                <img src="img/altindeximages/log.svg" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.</p>
                    <button class="btn transparent" id="sign-in-btn">Iniciar Sesión</button>
                </div>
                <img src="img\altindeximages\register.svg" class="image" alt="">
            </div>
        </div>
    </div>
    <!-- Script para controlar los efectos visuales-->
    <script src="js/app.js"></script>
</body>

</html>