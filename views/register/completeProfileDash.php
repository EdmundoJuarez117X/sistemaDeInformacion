<?php
session_start();
if (empty($_SESSION["subMat"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="es-Mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="../../styles/css/completeProfile/comProfileDash.css">
    <!-- shorcut icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./../../img/loginImages/EducationSchool.svg" />
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JQuery Ajax -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Acceso al Sistema Escolar</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup" id="comProfileForm">
                <!-- Formulario de registro -->
                <?php
            // Conexión a la base de datos
            include "../../model/connection.php";
            // Controlador para acceder al login
            include "../../controllers/controller_completeProfile.php";
            ?>


            </div>
        </div>
    </div>

    <!-- Carga del formulario con AJAX -->
    <script src="./../../js/completeProfileDash/showProfileData.js"></script>
    
</body>

</html>