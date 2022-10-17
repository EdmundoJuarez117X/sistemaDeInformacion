<?php

    session_start();
    if(!empty($_POST["btn_ingresar"])){
        if (!empty($_POST["email"] and !empty($_POST["password"]))) {
            $correo = $_POST["email"];
            $password = $_POST["password"];
            
            $sql = $connection->query("select * from persona where email_persona = '$correo' and password_persona = '$password'");
            if ($datos=$sql->fetch_object()) {
                $_SESSION["id_persona"]=$datos->id_persona;
                $_SESSION["nombre_persona"]=$datos->nombre_persona;
                $_SESSION["apellido_paterno"]=$datos->apellido_paterno;
                header("location:inicio.php");
            } else {
                echo "<div class='alert alert-danger'>Acceso Denegado</div>";
            }
            
        } else {
            echo "Correo o Contraseña no ingresados";
        }
        
    }
?>