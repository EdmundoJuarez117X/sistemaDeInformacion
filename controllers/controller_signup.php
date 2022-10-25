<?php
//Preguntar si se ha presionado el boton de registrarse
if (!empty($_POST["btn_registrar"])) {
    //corroboramos que no estén vacios los campos
    if (!empty($_POST["nombre_persona"]) and !empty($_POST["apellido_paterno"]) and !empty($_POST["apellido_materno"]) and !empty($_POST["email_persona"]) and !empty($_POST["password_persona"])) {
        //Ejecutamos la sentencia SQL
        $correo = $_POST["email_persona"];

        $sql = $connection->query("SELECT * FROM persona WHERE email_persona = '$correo'");
            
        if ($datos = $sql->fetch_object()) {
            echo "<script>alert('Ese correo ya esta registrado')</script>";
            sleep(1);
            //Destruimos la sesion para evitar infiltrados al sitio web
            session_destroy();
        } else {
            //Guardamos los datos proporcionados por el formulario ya que el correo electrónico no esta registrado
            $nombre_persona = $_POST["nombre_persona"];
            $apellido_paterno = $_POST["apellido_paterno"];
            $apellido_materno = $_POST["apellido_materno"];
            $correo = $_POST["email_persona"];
            $password = $_POST["password_persona"];
            $date = date("Y-m-d H:i:s");

            //Ejecutamos la sentencia SQL
            $sql = $connection->query("INSERT INTO persona (nombre_persona, apellido_paterno, apellido_materno, email_persona, password_persona, f_creacion_persona, id_rol)
            VALUES('$nombre_persona', '$apellido_paterno', '$apellido_materno', '$correo', '$password','$date', '5')");
            //Obtenemos el registro de los datos y guardamos algunos para control de acceso y completar el perfil
            if ($datos = $sql === true) {

                //Ejecutamos una consulta para obtener los datos para la session
                $sql = $connection->query("SELECT * FROM persona WHERE email_persona = '$correo'");

                if ($datos = $sql->fetch_object()) {

                    $_SESSION["id_persona"] = $datos->id_persona;
                    $_SESSION["nombre_persona"] = $datos->nombre_persona;
                    $_SESSION["apellido_paterno"] = $datos->apellido_paterno;
                    //Redireccionamos al inicio del sitio web (dashboard)
                    header("location:./views/register/completeProfile.php");
                } else {
                    echo "<div class='alert alert-danger'>Algo salió mal</div>";
                    session_destroy();
                }
            } else {
                echo "<script>alert('Algo salió mal usuario no registrado :(')</script>";
                session_destroy();
            }
        }
    } else {
        //Campos vacíos
        echo "Se detectan campos vacíos, corrobora tu información :(";
    }
}
?>
