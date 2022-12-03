<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISESCOLAR Sistema de Gestion de Instituciones.">
    <!-- FontAwesome API -->
    <script src="https://kit.fontawesome.com/73f1291dca.js" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="styles/css/stylev2.css">
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Acceso al Sistema Escolar</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulario de inicio de sesion -->
                <form id="login_form" name="form1" method="post" class="sign-in-form">
                    <h2 class="title">Iniciar Sesión</h2>
                    <?php
                    // Conexión a la base de datos
                    include "model/connection.php";
                    // Controlador para acceder al login
                    include "controllers/controller_login.php";
                    ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="email_log" placeholder="Correo Electrónico" name="email" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_log" placeholder="Contraseña" name="password" required>
                        <i class="far fa-eye" id="togglePassword_log" style="margin-left: 360px; margin-top:-60px; cursor: pointer;"></i>
                    </div>
                    <input type="submit" name="btn_ingresar" value="Iniciar Sesión" id="login" class="btn solid">

                    <p class="social-text">O acceder con una red social</p>
                    <div class="social-media">
                        <a href="#" class="social-icon" aria-label="Login with Facebook now!">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Login with Twitter now!">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Login with Google now!">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Login with Linkedin now!">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <!-- Formulario de registro -->
                <form id="register_form" name="form1" method="post" class="sign-up-form">
                    <h2 class="title">Registrarse</h2>
                    
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nombre_persona" placeholder="Primer Nombre" name="nombre_persona" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="apellido_paterno" placeholder="Apellido Paterno" name="apellido_paterno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="apellido_materno" placeholder="Apellido Materno" name="apellido_materno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" id="email" placeholder="Correo electrónico" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" required >
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" placeholder="Contraseña" name="password" required>
                        <i class="far fa-eye" id="togglePassword" style="margin-left: 360px; margin-top:-60px; cursor: pointer;"></i>
                    </div>
                    <div class="input-field">
                    <i class="fas fa-user"></i>
                        <select class="input-field" id="aspdoc" name="aspdoc" required>
                            <option value="">¿Aspirante o Padre de Familia?</option>
                            <option value = "aspirante">Aspirante</option>
                            <option value = "padredefamilia">Padre de Familia</option>
                        </select>
                    </div>
                    <input type="submit" name="btn_registrar" value="Registrarse" id="register" class="btn solid">

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
                    <p>¿Cansado de hacer fila en la institución?
                        Ingresa ahora e inscríbete en solo unos instántes!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">Registrarse</button>
                </div>
                <img src="img/loginImages/log.svg" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Ingresa tu información en este apartado si ya estás registrado! ;)</p>
                    <button class="btn transparent" id="sign-in-btn">Iniciar Sesión</button>
                </div>
                <img src="img/loginImages/register.svg" class="image" alt="">
            </div>
        </div>
    </div>
    <!-- JQuery Ajax -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Script para controlar los efectos visuales-->
    <script src="js/app.js"></script>
    <script src="js/register/register.js"></script>
    <!-- Gestion de contraseña para el formulario de login -->
    <script>
        const togglePassword = document.querySelector('#togglePassword_log');
        const password = document.querySelector('#password_log');
        togglePassword.addEventListener('click', function (e) {
        // toggle the typtogglee attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        // this.classList.add('fa-eye-slash');
        });
        $(document).ready(function() {

        $("#togglePassword_log").click(function() {

            if ($("#togglePassword_log").hasClass("far fa-eye")) {  //check the class
                $("#togglePassword_log").removeClass( "far fa-eye" ).addClass( "fa fa-eye-slash" );
            }else if($("#togglePassword_log").hasClass("fa fa-eye-slash")){
                $("#togglePassword_log").removeClass( "fa fa-eye-slash" ).addClass( "far fa-eye" );
            }
          
        });

        });
    </script>
    <!-- Gestion de contraseña para el formulario de registro -->
    <script>
        const togglePasswordSignUp = document.querySelector('#togglePassword');
        const passwordSignUp = document.querySelector('#password');
        togglePasswordSignUp.addEventListener('click', function (e) {
        // toggle the typtogglee attribute
        const type = passwordSignUp.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordSignUp.setAttribute('type', type);
        // toggle the eye slash icon
        // this.classList.add('fa-eye-slash');
        });
        $(document).ready(function() {

        $("#togglePassword").click(function() {

            if ($("#togglePassword").hasClass("far fa-eye")) {  //check the class
                $("#togglePassword").removeClass( "far fa-eye" ).addClass( "fa fa-eye-slash" );
            }else if($("#togglePassword").hasClass("fa fa-eye-slash")){
                $("#togglePassword").removeClass( "fa fa-eye-slash" ).addClass( "far fa-eye" );
            }
          
        });

        });
    </script>

</body>
</html>   







