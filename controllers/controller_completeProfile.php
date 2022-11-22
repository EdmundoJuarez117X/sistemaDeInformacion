<?php


if (empty($_SESSION["subMat"])) {
    header("location:../../index.php");
}
$Autorizacion = false;

//Preguntar si se ha presionado el boton de registarse
if (!empty($_POST["btn_completarPerfil"])) {
    //corroboramos que NO estén vacios los campos
    if (
        !empty($_POST["callePersona"]) 
        and !empty($_POST["numeroCallePersona"]) and !empty($_POST["coloniaPersona"]) 
        and !empty($_POST["estadoPersona"]) and !empty($_POST["ciudadPersona"]) 
        and !empty($_POST["codPostalPersona"]) and !empty($_POST["fecha_nacimiento"]) 
        and !empty($_POST["genero"]) and !empty($_POST["numero_telefonico"])
    ) {
        //Obtenemos los datos del formulario
        $seg_nombre_persona = $_POST["seg_nombre_persona"];
        $callePersona = $_POST["callePersona"];
        $numeroCallePersona = $_POST["numeroCallePersona"];
        $coloniaPersona = $_POST["coloniaPersona"];
        $estadoPersona = $_POST["estadoPersona"];
        $ciudadPersona = $_POST["ciudadPersona"];
        $codPostalPersona = $_POST["codPostalPersona"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $genero = $_POST["genero"];
        $numero_telefonico = $_POST["numero_telefonico"];
        

        //Obtenemos la submatrícula de la persona con la session activa
        $subMat = $_SESSION["subMat"];
        
        //Calculamos la edad con la fecha de nacimiento proporcionada
        $fecha_nacimientoE = new DateTime($fecha_nacimiento); //Convertimos las fechas a un formato reconocible por php
        $ahora = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $ahora->diff($fecha_nacimientoE); //Obtenemos la diferencia de tiempo para convertirla en la edad
        $edad = $diferencia->format("%y");

        $f_creacion = date("Y-m-d H:i:s");

        //Analizamos el tipo de usuario
        if($subMat == "ASP"){
            //Obtenemos el correo de la persona para hacer movimientos de tipo crud
            $email_aspirante = $_SESSION["email_aspirante"];

            //Ejecutamos una sentencia SQL para obtener el id de la persona (Aspirante)
            $sqlAspID = $connection->query("SELECT * FROM aspirante WHERE email_aspirante='$email_aspirante'");
            if ($datos = $sqlAspID->fetch_object()) {
                //Obtenemos el numero de telefono de la consulta
                $id_aspirante  = $datos->id_aspirante;

                //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                $sql = $connection->query("INSERT INTO direccionaspirante (calleAspirante, numeroCalleAspirante, coloniaAspirante, estadoAspirante, ciudadAspirante	, codPostalAspirante, f_creacion_DirAspirante, id_aspirante)
                VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_aspirante')");
                //Si los datos se envian entonces
                if ($datos = $sql === true) {
                    sleep(1);
                    //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                    $sql = $connection->query("UPDATE `aspirante` SET `segundo_nombreAspirante`='$seg_nombre_persona', `edad_Aspirante`='$edad',`genero_Aspirante`='$genero',`numero_tel_Aspirante`='$numero_telefonico',`fecha_nacimientoAspirante`='$fecha_nacimiento',`f_modificacion_Aspirante`='$f_creacion' WHERE `id_aspirante`='$id_aspirante'");
                    if($datos = $sql === true){
                        //Autorizamos la redireccion a otro sitio (Dashboard)
                        $Autorizacion = true;
                     }
                }

            }
        //Si los datos se envian entoncesid_persona
        }else{
            if($subMat == "PF"){
                    //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                $email_padreDeFam = $_SESSION["email_padreDeFam"];

                //Ejecutamos una sentencia SQL para obtener el id de la persona (Aspirante)
                $sqlPFID = $connection->query("SELECT * FROM padredefamilia WHERE email_padreDeFam='$email_padreDeFam'");
                if ($datos = $sqlPFID->fetch_object()) {
                    //Obtenemos el ID del usuario
                    $id_padreDeFamilia   = $datos->id_padreDeFamilia ;

                   
                        //Ejecutamos la sentencia SQL para actualizar los datos del Padre de Familia
                        $sql = $connection->query("UPDATE `padredefamilia` SET `segundo_nombrepadreDeFam`='$seg_nombre_persona', `edad_padreDeFam`='$edad',`genero_padreDeFam`='$genero',`numero_tel_padreDeFam`='$numero_telefonico',`fecha_nacimientopadreDeFam`='$fecha_nacimiento',`f_modificacion_padreDeFam`='$f_creacion' WHERE `id_padreDeFamilia`='$id_padreDeFamilia'");
                        if($datos = $sql === true){
                            //Autorizamos la redireccion a otro sitio (Dashboard)
                            $Autorizacion = true;
                        }
                }
            }
        }
    } else {
        //Campos vacíos
        echo "Se detectan campos vacíos, corrobora tu información :(";
    }
    if($Autorizacion == true){
        header("location:../dashboard/inicio.php");
    }
}
