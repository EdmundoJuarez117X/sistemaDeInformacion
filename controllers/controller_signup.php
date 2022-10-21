<?php

    //Preguntar si se ha presionado el boton de registrarse
    if(!empty($_POST["btn_registrar"])){
        //corroboramos que no estén vacios los campos
        if (!empty($_POST["nombre_persona"] and !empty($_POST["apellido_paterno"]) and !empty($_POST["apellido_materno"]) and !empty($_POST["email_persona"]) and !empty($_POST["password_persona"]))) {
            //Guardamos los datos proporcionados por el formulario
            $nombre_persona = $_POST["nombre_persona"];
            $apellido_paterno = $_POST["apellido_paterno"];
            $apellido_materno = $_POST["apellido_materno"];
            $correo = $_POST["email_persona"];
            $password = $_POST["password_persona"];
            $date = date("Y-m-d H:i:s"); 
            //Ejecutamos la sentencia SQL
            $sql = $connection->query("INSERT INTO persona (nombre_persona, apellido_paterno, apellido_materno, email_persona, password_persona, f_creacion_persona, id_rol)
            VALUES('$nombre_persona', '$apellido_paterno', '$apellido_materno', '$correo', '$password','$date', '1')
            ");
            //Obtenemos el registro de los datos y guardamos algunos para control de acceso
            if ($datos=$sql === true) {
                //Redireccionamos al inicio del sitio web (dashboard)
                header("location:index.php");
            } else {
                echo "<script>alert('Algo salió mal usuario no registrado :(')</script>";
            }
            
        } else {
            //Campos vacíos
            echo "Escriba sobre los campos su informacion";
        }
        
    }
