<?php

session_start();

if (empty($_SESSION["id_persona"])) {
    header("location:../../index.php");
}

//Preguntar si se ha presionado el boton de registarse
if (!empty($_POST["btn_completarPerfil"])) {
    //corroboramos que NO estén vacios los campos
    if (
        !empty($_POST["callePersona"]) and !empty($_POST["numeroCallePersona"])
        and !empty($_POST["coloniaPersona"]) and !empty($_POST["estadoPersona"])
        and !empty($_POST["ciudadPersona"]) and !empty($_POST["codPostalPersona"])
        and !empty($_POST["fecha_nacimiento"]) and !empty($_POST["genero"])
        and !empty($_POST["rol"]) and !empty($_POST["numero_telefonico"])
    ) {
        //Obtenemos los datos del formulario
        $callePersona = $_POST["callePersona"];
        $numeroCallePersona = $_POST["numeroCallePersona"];
        $coloniaPersona = $_POST["coloniaPersona"];
        $estadoPersona = $_POST["estadoPersona"];
        $ciudadPersona = $_POST["ciudadPersona"];
        $codPostalPersona = $_POST["codPostalPersona"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $genero = $_POST["genero"];
        $rol = $_POST["rol"];
        $numero_telefonico = $_POST["numero_telefonico"];
        

        //Obtenemos el id de la persona con la session activa
        $id_persona = $_SESSION["id_persona"];

        //Calculamos la edad con la fecha de nacimiento proporcionada
        $fecha_nacimientoE = new DateTime($fecha_nacimiento); //Convertimos las fechas a un formato reconocible por php
        $ahora = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $ahora->diff($fecha_nacimientoE); //Obtenemos la diferencia de tiempo para convertirla en la edad
        $edad = $diferencia->format("%y");

        $f_creacion = date("Y-m-d H:i:s");
        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
        $sql = $connection->query("INSERT INTO direccionPersona (callePersona, numeroCallePersona, coloniaPersona, estadoPersona, ciudadPersona, codPostalPersona, f_creacion_DirPersona, id_persona )
            VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_persona')");
        //Si los datos se envian entonces
        if ($datos = $sql === true) {
            sleep(1);
            //Ejecutamos la sentencia SQL para insertar los datos de Telefono
            $sql = $connection->query("INSERT INTO telefono (numero_telefonico, f_creacion_tel)
            VALUES('$numero_telefonico', '$f_creacion')");
            echo "<script>alert('$numero_telefonico')</script>";

            //Si los datos se envian entonces
            if ($datos = $sql === true) {
                sleep(1);
                //Obtenemos el ID del telefono
                //Ejecutamos una consulta para obtener los datos para la session
                $sql = $connection->query("SELECT * FROM telefono WHERE numero_telefonico = '$numero_telefonico'");

                if ($datos = $sql->fetch_object()) {
                    //Obtenemos el numero de telefono de la consulta
                    $id_telefono = $datos->id_telefono;
                    
                    //Ejecutamos la sentencia SQL para insertar los datos de TelefonoPersona
                    $sql = $connection->query("INSERT INTO persona_telefono (tipo_tel, numero_telefonico, f_creacion_persona_telefono, id_persona, id_telefono)
                    VALUES('Móvil','$numero_telefonico', '$f_creacion','$id_persona','$id_telefono')");

                    //Si los datos se envian entonces
                    if ($datos = $sql === true) {
                        sleep(1);
                        //Ejecutamos la sentencia SQL para actualizar los datos de persona
                        $sql = $connection->query("UPDATE `persona` SET `edad_persona` = '$edad', `genero` = '$genero', `fecha_nacimiento` = '$fecha_nacimiento', `id_rol` = '$rol' WHERE `persona`.`id_persona` = '$id_persona';");
                         
                        //Si los datos se envian entonces
                         if($datos = $sql === true){
                            echo "<div class='alert alert-danger'>Bienvenido</div>";
                            //Redireccionamos al inicio del sitio web (dashboard)
                            header("location:../dashboard/inicio.php");
                         }else{
                            echo "<div class='alert alert-danger'>Algo salió mal persona</div>";
                            session_destroy();
                         }
                    } else {
                        echo "<div class='alert alert-danger'>Algo salió mal </div>";
                        session_destroy();
                    }
                } else {
                    echo "<div class='alert alert-danger'>Algo salió mal Telefono ID</div>";
                    session_destroy();
                }
            } else {
                echo "<script>alert('Algo salió mal perfil no completado :(')</script>";
                session_destroy();
            }
        } else {
            echo "<script>alert('Algo salió mal perfil no completado :(')</script>";
            session_destroy();
        }
    } else {
        //Campos vacíos
        echo "Se detectan campos vacíos, corrobora tu información :(";
    }
}
