<?php

    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }

    // conocer qué rol ha ingresado
    if($_SESSION['subMat'] == "Al") {
        $matricula = "Al";
    } else if($_SESSION['subMat'] == "DOC") {
        $matricula = "DOC";
    }
    // obtener el id del curso
    $id = $_GET['cso'];

    require_once "../../../model/connection.php";
    $db = $connection;
    $result = $db->query("SELECT * FROM cursos WHERE cursos.id_curso = $id;");
    if(!$result) {
        die("Error al obtener curso. Error: ". mysqli_error($db));
    }
    
    $curso = $result->fetch_assoc();
    // obtener el rol para el curso
    if($curso['rol_dirigido'] == "alumno") {
        $clave = "Al";
    } else if($curso['rol_dirigido'] == "docente") {
        $clave = "DOC";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- shorcut icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./../../../img/loginImages/EducationSchool.svg" />
    <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
    <title>Comprar curso</title>
</head>
<body>
    <div class="container-stripe">
        <div class="container-info-compra">
                <?php 
                    if($matricula == $clave) {
                        require_once "info-curso.php";
                    } else {
                        require_once "curso-no-disponible.php";
                    }
                ?>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../../../js/cursos-eventos/user/charge.js"></script>
</body>
</html>