<?php

    session_start();

    //Preguntar si se ha presionado el boton de iniciar sesion
    if(!empty($_POST["btn_ingresar"])){
        //corroboramos que no estén vacios los campos
        if (!empty($_POST["email"] and !empty($_POST["password"]))) {
            //Guardamos los datos proporcionados por el formulario
            $correo = $_POST["email"];
            $password = $_POST["password"];
            //Ejecutamos la sentencia SQL
            $sql = $connection->query("select * from persona where email_persona = '$correo' and password_persona = '$password'");
            //Obtenemos el registro de los datos y guardamos algunos para control de acceso
            if ($datos=$sql->fetch_object()) {
                $_SESSION["id_persona"]=$datos->id_persona;
                $_SESSION["nombre_persona"]=$datos->nombre_persona;
                $_SESSION["apellido_paterno"]=$datos->apellido_paterno;
                //Redireccionamos al inicio del sitio web (dashboard)
                header("location:inicio.php");
            } else {
                echo "<div class='alert alert-danger'>Correo o Contraseña incorrectos</div>";
            }
            
        } else {
            //Campos vacíos
            echo "Correo o Contraseña no ingresados";
        }
        
    }
?>