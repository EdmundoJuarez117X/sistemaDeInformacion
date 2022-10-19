<?php
    session_start();
    if(empty($_SESSION["id_persona"])){
        header("location:altindex.php");
    }
?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <div>
        <?php
            echo $_SESSION["nombre_persona"] . " ". $_SESSION["apellido_paterno"];
        ?>
        <a class="nav-item nav-link text-justify ml-3 hover-primary" href="controllers/controller_logout.php">Cerrar Sesión</a>
    </div>
</body>

</html>