<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" cossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/css/stylev2.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulario de inicio de sesion -->
                <form action="" class="sign-in-form">
                    <h2 class="title">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Correo" name="email" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="password" required>
                    </div>
                    <input type="submit" value="Iniciar Sesión" class="btn solid">

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
                <form action="" class="sign-up-form">
                    <h2 class="title">Registrarse</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombre" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Segundo Nombre">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Apellido Paterno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Apellido Materno" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" required>
                    </div>
                    <input type="submit" value="Registrarse" class="btn solid">

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
                        Voluptates quam nisi iusto placeat quasi repudiandae 
                        veritatis ea debitis.</p>
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
    <script src="js/app.js"></script>
</body>

</html>