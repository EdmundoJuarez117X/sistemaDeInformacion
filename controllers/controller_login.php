<?php

session_start();
//Booleano para permitir la redireccion
$Autorizacion = false;
//Url de la pagina a redirigir dependiendo del usuario que accede
$url = '';
//Preguntar si se ha presionado el boton de iniciar sesion
if (!empty($_POST["btn_ingresar"])) {
    //corroboramos que no estén vacios los campos
    if (!empty($_POST["email"] and !empty($_POST["password"]))) {
        //Guardamos los datos proporcionados por el formulario
        $email = $_POST["email"];
        $password = $_POST["password"];

        #md5 encryption
        $md5EncryptionP4ss = md5($password);
        //Ejecutamos la sentencia SQL
        $sql = $connection->query("SELECT * FROM aspirante WHERE email_aspirante='$email' AND password_aspirante='$md5EncryptionP4ss'");
        //Obtenemos el registro de los datos y guardamos algunos para control de acceso
        if ($datos = $sql->fetch_object()) {
            $_SESSION["id_aspirante"] = $datos->id_aspirante;
            $_SESSION["subMat"] = $datos->subMatAsp;
            $_SESSION["nombre_aspirante"] = $datos->nombre_aspirante;
            $_SESSION["apellido_paternoAspirante"] = $datos->apellido_paternoAspirante;
            $_SESSION["email_aspirante"] = $datos->email_aspirante;
            $_SESSION["estatus_persona"] = $datos->estatus_Aspirante;
            $_SESSION['LAST_ACTIVITY'] = time();

            $Autorizacion = true;
            $url = 'dashboard/inicio.php';
        } else {
            //Ejecutamos la sentencia SQL
            $sql = $connection->query("SELECT * FROM alumno WHERE email_alumno	='$email' AND password_alumno='$md5EncryptionP4ss'");
            //Obtenemos el registro de los datos y guardamos algunos para control de acceso
            if ($datos = $sql->fetch_object()) {
                $_SESSION["id_alumno"] = $datos->id_alumno;
                $_SESSION["subMat"] = $datos->subMatAl;
                $_SESSION["nombre_alumno"] = $datos->nombre_alumno;
                $_SESSION["apellido_paternoAlumno"] = $datos->apellido_paternoAlumno;
                $_SESSION["email_alumno"] = $datos->email_alumno;
                $_SESSION["estatus_persona"] = $datos->estatus_alumno;
                $_SESSION['LAST_ACTIVITY'] = time();

                $Autorizacion = true;
                $url = 'dashboard/inicio.php';
            } else {
                //Ejecutamos la sentencia SQL
                $sql = $connection->query("SELECT * FROM padreDeFamilia WHERE email_padreDeFam	='$email' AND password_padreDeFam='$md5EncryptionP4ss'");
                //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                if ($datos = $sql->fetch_object()) {
                    $_SESSION["id_padreDeFamilia"] = $datos->id_padreDeFamilia;
                    $_SESSION["subMat"] = $datos->subMatPF;
                    $_SESSION["nombre_padreDeFam"] = $datos->nombre_padreDeFam;
                    $_SESSION["apellido_paternopadreDeFam"] = $datos->apellido_paternopadreDeFam;
                    $_SESSION["email_padreDeFam"] = $datos->email_padreDeFam;
                    $_SESSION["estatus_persona"] = $datos->estatus_padreDeFam;
                    $_SESSION['LAST_ACTIVITY'] = time();

                    $Autorizacion = true;
                    $url = 'dashboard/inicio.php';
                } else {
                    //Ejecutamos la sentencia SQL
                    $sql = $connection->query("SELECT * FROM docente WHERE email_docente	='$email' AND password_docente='$password'");
                    //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                    if ($datos = $sql->fetch_object()) {
                        $_SESSION["id_docente"] = $datos->id_docente;
                        $_SESSION["subMat"] = $datos->subMatDoc;
                        $_SESSION["nombre_docente"] = $datos->nombre_docente;
                        $_SESSION["apellido_paternoDocente"] = $datos->apellido_paternoDocente;
                        $_SESSION["email_docente"] = $datos->email_docente;
                        $_SESSION['LAST_ACTIVITY'] = time();

                        $Autorizacion = true;
                        $url = 'dashboard/inicio.php';
                    } else {
                        //Ejecutamos la sentencia SQL
                        $sql = $connection->query("SELECT * FROM administrador WHERE email_admin	='$email' AND password_admin='$password'");
                        //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                        if ($datos = $sql->fetch_object()) {
                            $_SESSION["id_administrador"] = $datos->id_administrador;
                            $_SESSION["subMat"] = $datos->subMatAdm;
                            $_SESSION["nombre_admin"] = $datos->nombre_admin;
                            $_SESSION["apellido_paternoAdmin"] = $datos->apellido_paternoAdmin;
                            $_SESSION["email_admin"] = $datos->email_admin;
                            $_SESSION['LAST_ACTIVITY'] = time();

                            $Autorizacion = true;
                            //Redireccionamos al inicio del sitio web (dashboard)
                            header("location:./views/dashboard/inicio.php");

                        } else {
                            //Ejecutamos la sentencia SQL
                            $sql = $connection->query("SELECT * FROM master WHERE email_master	='$email' AND password_master='$password'");
                            //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                            if ($datos = $sql->fetch_object()) {
                                $_SESSION["id_master"] = $datos->id_master;
                                $_SESSION["subMat"] = $datos->subMatMst;
                                $_SESSION["nombre_master"] = $datos->nombre_master;
                                $_SESSION["apellido_paternoMaster"] = $datos->apellido_paternoMaster;
                                $_SESSION["email_master"] = $datos->email_master;
                                $_SESSION['LAST_ACTIVITY'] = time();

                                $Autorizacion = true;

                            } else {
                                echo "<div class='alert alert-danger'>Correo o Contraseña incorrectos</div>";
                                session_destroy();
                            }
                        }
                    }
                }
            }

        }
    } else {
        //Campos vacíos
        echo "Correo o Contraseña no ingresados";
    }
    if ($Autorizacion == true) {

        //Redireccionamos al enlace proporcionado dependiendoe el usuario
        header("location:./views/$url");
    }

}
?>