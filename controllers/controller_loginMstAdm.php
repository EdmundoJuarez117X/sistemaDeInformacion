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

        //Ejecutamos la sentencia SQL
        $sql = $connection->query("SELECT * FROM administrador WHERE email_admin	='$email' AND password_admin='$md5EncryptionP4ss'");
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
            $url = '../../dashboard/inicio.php';

        } else {
            //Ejecutamos la sentencia SQL
            $sql = $connection->query("SELECT * FROM master WHERE email_master	='$email' AND password_master='$md5EncryptionP4ss'");
            //Obtenemos el registro de los datos y guardamos algunos para control de acceso
            if ($datos = $sql->fetch_object()) {
                $_SESSION["id_master"] = $datos->id_master;
                $_SESSION["subMat"] = $datos->subMatMst;
                $_SESSION["nombre_master"] = $datos->nombre_master;
                $_SESSION["apellido_paternoMaster"] = $datos->apellido_paternoMaster;
                $_SESSION["email_master"] = $datos->email_master;
                $_SESSION['LAST_ACTIVITY'] = time();

                $Autorizacion = true;
                $url = '../../dashboard/inicio.php';
            } else {
                echo "<script>
                //Sweet Alert 2 and locate to index
            let timerInterval
            Swal.fire({
                icon: 'error',
                title: 'Correo o contraseña incorrectos :(',
                html: 'Se actualizará en <b></b>.',
                timer: 1369,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    
                }
            });
                </script>";
                //echo "<div class='alert alert-danger'>Correo o Contraseña incorrectos</div>";
                session_destroy();
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