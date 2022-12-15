<?php


// session_start();

if (empty($_SESSION["subMat"])) { //Si hay algun usuario intentando registrarse
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

        $f_creacion = date("Y-m-d H:i:s"); //Fecha actual, también sirve para el campo f_modificacion cuando se actualice un registro

        //Preguntamos si se necesita actualización o creacion desde 0
        if (isset($_SESSION["updateUser"])) {
            if ($_SESSION["updateUser"] == "activate") { //Actualizamos los datos
                if ($subMat == "ASP") { //Actualizamos aspirantes
                    //Obtenemos el correo de la persona para hacer movimientos de tipo update
                    $email_aspirante = $_SESSION["email_aspirante"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Aspirante)
                    $sqlAspID = $connection->query("SELECT * FROM `aspirante` WHERE `email_aspirante`='$email_aspirante'");
                    if ($datos = $sqlAspID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_aspirante = $datos->id_aspirante;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirA = "UPDATE direccionAspirante SET `calleAspirante`='$callePersona', `numeroCalleAspirante`='$numeroCallePersona', `coloniaAspirante`='$coloniaPersona', `estadoAspirante`='$estadoPersona', `ciudadAspirante`='$ciudadPersona', `codPostalAspirante`='$codPostalPersona' 
                         WHERE `id_aspirante` = '$id_aspirante';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirA) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlAUP = "UPDATE `aspirante` SET `segundo_nombreAspirante`='$seg_nombre_persona', `edad_Aspirante`='$edad',`genero_Aspirante`='$genero',`numero_tel_Aspirante`='$numero_telefonico',`fecha_nacimientoAspirante`='$fecha_nacimiento',`f_modificacion_Aspirante`='$f_creacion' 
                            WHERE `id_aspirante`='$id_aspirante'";
                            if ($datos = $connection->query($sqlAUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }
                    //Si los datos se envian entoncesid_persona
                } else if ($subMat == "PF") { //Actualizamos padres de familia
                    //Obtenemos el correo de la persona para hacer movimientos de tipo update
                    $email_padreDeFam = $_SESSION["email_padreDeFam"];
                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                    $sqlPFID = $connection->query("SELECT * FROM `padreDeFamilia` WHERE `email_padreDeFam`='$email_padreDeFam'");
                    if ($datos = $sqlPFID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_padreDeFamilia = $datos->id_padreDeFamilia;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirPF = "UPDATE `direccionPadreDeFamilia` SET `callePadreDeFam`='$callePersona', `numeroCallePadreDeFam`='$numeroCallePersona', `coloniaPadreDeFam`='$coloniaPersona', `estadoPadreDeFam`='$estadoPersona', `ciudadPadreDeFam`='$ciudadPersona', `codPostalPadreDeFam`='$codPostalPersona' 
                         WHERE `id_padreDeFamilia` = '$id_padreDeFamilia';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirPF) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlPFUP = "UPDATE `padreDeFamilia` SET `segundo_nombrepadreDeFam`='$seg_nombre_persona', `edad_padreDeFam`='$edad',`genero_padreDeFam`='$genero',`numero_tel_padreDeFam`='$numero_telefonico',`fecha_nacimientopadreDeFam`='$fecha_nacimiento',`f_modificacion_padreDeFam`='$f_creacion' 
                            WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
                            if ($datos = $connection->query($sqlPFUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }
                } else if ($subMat == "Al") { //Actualizamos alumnos
                    //Obtenemos el correo electrónico de las sesiones
                    $email_alumno = $_SESSION["email_alumno"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                    $sqlAlID = $connection->query("SELECT * FROM `alumno` WHERE `email_alumno`='$email_alumno'");
                    if ($datos = $sqlAlID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_alumno = $datos->id_alumno;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirAl = "UPDATE `direccionAlumno` SET `calleAlumno`='$callePersona', `numeroCalleAlumno`='$numeroCallePersona', `coloniaAlumno`='$coloniaPersona', `estadoAlumno`='$estadoPersona', `ciudadAlumno`='$ciudadPersona', `codPostalAlumno`='$codPostalPersona' 
                         WHERE `id_alumno` = '$id_alumno';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirAl) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlAlUP = "UPDATE `alumno` SET `segundo_nombreAlumno`='$seg_nombre_persona', `edad_Alumno`='$edad',`genero_Alumno`='$genero',`numero_tel_Alumno`='$numero_telefonico',`fecha_nacimientoAlumno`='$fecha_nacimiento',`f_modificacion_Alumno`='$f_creacion' 
                            WHERE `id_alumno`='$id_alumno'";
                            if ($datos = $connection->query($sqlAlUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }

                } else if ($subMat == "DOC") { //Actualizamos docentes
                    //Obtenemos el correo electrónico de las sesiones
                    $email_docente = $_SESSION["email_docente"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                    $sqlDocID = $connection->query("SELECT * FROM `docente` WHERE `email_docente`='$email_docente'");
                    if ($datos = $sqlDocID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_docente = $datos->id_docente;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirDoc = "UPDATE `direccionDocente` SET `calleDocente`='$callePersona', `numeroCalleDocente`='$numeroCallePersona', `coloniaDocente`='$coloniaPersona', `estadoDocente`='$estadoPersona', `ciudadDocente`='$ciudadPersona', `codPostalDocente`='$codPostalPersona' 
                         WHERE `id_docente` = '$id_docente';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirDoc) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlDocUP = "UPDATE `docente` SET `segundo_nombreDocente`='$seg_nombre_persona', `edad_Docente`='$edad',`genero_Docente`='$genero',`numero_tel_Docente`='$numero_telefonico',`fecha_nacimientoDocente`='$fecha_nacimiento',`f_modificacion_Docente`='$f_creacion' 
                            WHERE `id_docente`='$id_docente'";
                            if ($datos = $connection->query($sqlDocUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }

                } else if ($subMat == "ADM") { //Actualizamos admins
                    //Obtenemos el correo electrónico de las sesiones
                    $email_admin = $_SESSION["email_admin"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                    $sqlAdmID = $connection->query("SELECT * FROM `administrador` WHERE `email_admin`='$email_admin'");
                    if ($datos = $sqlAdmID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_administrador = $datos->id_administrador;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirAdm = "UPDATE `direccionAdministrador` SET `calleAdmin`='$callePersona', `numeroCalleAdmin`='$numeroCallePersona', `coloniaAdmin`='$coloniaPersona', `estadoAdmin`='$estadoPersona', `ciudadAdmin`='$ciudadPersona', `codPostalAdmin`='$codPostalPersona' 
                         WHERE `id_administrador` = '$id_administrador';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirAdm) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlAdmUP = "UPDATE `administrador` SET `segundo_nombreAdmin`='$seg_nombre_persona', `edad_Admin`='$edad',`genero_Admin`='$genero',`numero_tel_Admin`='$numero_telefonico',`fecha_nacimientoAdmin`='$fecha_nacimiento',`f_modificacion_Admin`='$f_creacion' 
                            WHERE `id_administrador`='$id_administrador'";
                            if ($datos = $connection->query($sqlAdmUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }

                } else if ($subMat == "MST") { //Actualizamos masters
                    //Obtenemos el correo electrónico de las sesiones
                    $email_master = $_SESSION["email_master"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                    $sqlMstID = $connection->query("SELECT * FROM `master` WHERE `email_master`='$email_master'");
                    if ($datos = $sqlMstID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_master = $datos->id_master;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirMst = "UPDATE `direccionMaster` SET `calleMaster`='$callePersona', `numeroCalleMaster`='$numeroCallePersona', `coloniaMaster`='$coloniaPersona', `estadoMaster`='$estadoPersona', `ciudadMaster`='$ciudadPersona', `codPostalMaster`='$codPostalPersona' 
                         WHERE `id_master` = '$id_master';";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirMst) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlMstUP = "UPDATE `master` SET `segundo_nombreMaster`='$seg_nombre_persona', `edad_Master`='$edad',`genero_Master`='$genero',`numero_tel_Master`='$numero_telefonico',`fecha_nacimientoMaster`='$fecha_nacimiento',`f_modificacion_Master`='$f_creacion' 
                            WHERE `id_master`='$id_master'";
                            if ($datos = $connection->query($sqlMstUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;

                            }
                        }

                    }

                }
            }
        } else { //Crear información desde 0
            //Analizamos el tipo de usuario
            if ($subMat == "ASP") {
                //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                $email_aspirante = $_SESSION["email_aspirante"];

                //Ejecutamos una sentencia SQL para obtener el id de la persona (Aspirante)
                $sqlAspID = $connection->query("SELECT * FROM aspirante WHERE email_aspirante='$email_aspirante'");
                if ($datos = $sqlAspID->fetch_object()) {
                    //Obtenemos el numero de telefono de la consulta
                    $id_aspirante = $datos->id_aspirante;

                    //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                    $sqlDirA = "INSERT INTO direccionAspirante (calleAspirante, numeroCalleAspirante, coloniaAspirante, estadoAspirante, ciudadAspirante	, codPostalAspirante, f_creacion_DirAspirante, id_aspirante)
                VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_aspirante')";
                    //Si los datos se envian entonces
                    if ($datos = $connection->query($sqlDirA) === true) {
                        usleep(136000);
                        //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                        $sqlAUP = "UPDATE `aspirante` SET `segundo_nombreAspirante`='$seg_nombre_persona', `edad_Aspirante`='$edad',`genero_Aspirante`='$genero',`numero_tel_Aspirante`='$numero_telefonico',`fecha_nacimientoAspirante`='$fecha_nacimiento',`f_modificacion_Aspirante`='$f_creacion' WHERE `id_aspirante`='$id_aspirante'";
                        if ($datos = $connection->query($sqlAUP) === true) {
                            //Autorizamos la redireccion a otro sitio (Dashboard)
                            $Autorizacion = true;
                            include '../../controllers/phpMailer/enviarCorreo.php';


                        }
                    }

                }
                //Si los datos se envian entoncesid_persona
            } else {
                if ($subMat == "Al") {
                    //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                    $email_alumno = $_SESSION["email_alumno"];

                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Aspirante)
                    $sqlAlID = $connection->query("SELECT * FROM `aspirante` WHERE `email_alumno`='$email_alumno'");
                    if ($datos = $sqlAlID->fetch_object()) {
                        //Obtenemos el numero de telefono de la consulta
                        $id_alumno = $datos->id_alumno;

                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                        $sqlDirAl = "INSERT INTO `direccionAlumno` (`calleAlumno`, `numeroCalleAlumno`, `coloniaAlumno`, `estadoAlumno`, `ciudadAlumno`, `codPostalAlumno`, `f_creacion_DirAlumno`, `id_alumno`
                        VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_alumno')";
                        //Si los datos se envian entonces
                        if ($datos = $connection->query($sqlDirAl) === true) {
                            usleep(136000);
                            //Ejecutamos la sentencia SQL para actualizar los datos del Aspirante
                            $sqlAlUP = "UPDATE `alumno` SET `segundo_nombreAlumno`='$seg_nombre_persona', `edad_Alumno`='$edad',`genero_Alumno`='$genero',`numero_tel_Alumno`='$numero_telefonico',`fecha_nacimientoAlumno`='$fecha_nacimiento',`f_modificacion_Alumno`='$f_creacion' WHERE `id_alumno`='$id_alumno'";
                            if ($datos = $connection->query($sqlAlUP) === true) {
                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                $Autorizacion = true;
                                include '../../controllers/phpMailer/enviarCorreoAl.php';


                            }
                        }

                    }
                } else {
                    if ($subMat == "PF") {
                        //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                        $email_padreDeFam = $_SESSION["email_padreDeFam"];

                        //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                        $sqlPFID = $connection->query("SELECT * FROM padreDeFamilia WHERE email_padreDeFam='$email_padreDeFam'");
                        if ($datos = $sqlPFID->fetch_object()) {
                            //Obtenemos el ID del usuario
                            $id_padreDeFamilia = $datos->id_padreDeFamilia;

                            //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                            $sqlDirPF = "INSERT INTO direccionPadreDeFamilia (callePadreDeFam, numeroCallePadreDeFam, coloniaPadreDeFam, estadoPadreDeFam, ciudadPadreDeFam	, codPostalPadreDeFam, f_creacion_DirPadreDeFam, id_padreDeFamilia)
                        VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_padreDeFamilia')";
                            //Si los datos se envian entonces
                            if ($datospf = $connection->query($sqlDirPF) === true) {
                                //Ejecutamos la sentencia SQL para actualizar los datos del Padre de Familia
                                $sqlUP = "UPDATE `padreDeFamilia` SET `segundo_nombrepadreDeFam`='$seg_nombre_persona', `edad_padreDeFam`='$edad',`genero_padreDeFam`='$genero',`numero_tel_padreDeFam`='$numero_telefonico',`fecha_nacimientopadreDeFam`='$fecha_nacimiento',`f_modificacion_padreDeFam`='$f_creacion' WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
                                if ($datos = $connection->query($sqlUP) === true) {
                                    //Autorizamos la redireccion a otro sitio (Dashboard)
                                    $Autorizacion = true;
                                    include '../../controllers/phpMailer/enviarCorreoPF.php';
                                }
                            }
                        }
                    } else {
                        if ($subMat == "DOC") {
                            //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                            $email_docente = $_SESSION["email_docente"];

                            //Ejecutamos una sentencia SQL para obtener el id de la persona (Padre de Familia)
                            $sqlDOCID = $connection->query("SELECT * FROM `docente` WHERE `email_docente`='$email_docente'");
                            if ($datos = $sqlDOCID->fetch_object()) {
                                //Obtenemos el ID del usuario
                                $id_docente = $datos->id_docente;

                                //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                                $sqlDirDOC = "INSERT INTO `direccionDocente` (`calleDocente`, `numeroCalleDocente`, `coloniaDocente`, `estadoDocente`, `ciudadDocente`, `codPostalDocente`, `f_creacion_DirDocente`, `id_docente`
                                VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_docente')";
                                //Si los datos se envian entonces
                                if ($datosDOC = $connection->query($sqlDirDOC) === true) {
                                    //Ejecutamos la sentencia SQL para actualizar los datos del Padre de Familia
                                    $sqlDOCUP = "UPDATE `padreDeFamilia` SET `segundo_nombreDocente`='$seg_nombre_persona', `edad_Docente`='$edad',`genero_Docente`='$genero',`numero_tel_Docente`='$numero_telefonico',`fecha_nacimientoDocente`='$fecha_nacimiento',`f_modificacion_Docente`='$f_creacion' WHERE `id_docente`='$id_docente'";
                                    if ($datos = $connection->query($sqlDOCUP) === true) {
                                        //Autorizamos la redireccion a otro sitio (Dashboard)
                                        $Autorizacion = true;
                                        include '../../controllers/phpMailer/enviarCorreoDoc.php';
                                    }
                                }
                            }
                        } else {
                            if ($subMat == "MST") {
                                //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                                $email_master = $_SESSION["email_master"];
                                //Ejecutamos una sentencia SQL para obtener el id de la persona (Master)
                                $sqlMSTID = $connection->query("SELECT * FROM `master` WHERE email_master='$email_master'");
                                if ($datosMst = $sqlMSTID->fetch_object()) {
                                    //Obtenemos el ID del usuario
                                    $id_master = $datosMst->id_master;

                                    //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                                    $sqlDirM = "INSERT INTO direccionMaster (`calleMaster`, `numeroCalleMaster`, `coloniaMaster`, `estadoMaster`, `ciudadMaster`, `codPostalMaster`, `f_creacion_DirMaster`, id_master)
                                VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_master')";
                                    //Si los datos se envian entonces
                                    if ($datosM = $connection->query($sqlDirM) === true) {
                                        //Ejecutamos la sentencia SQL para actualizar los datos del Master
                                        $sqlMU = "UPDATE `master` SET `segundo_nombreMaster`='$seg_nombre_persona', `edad_Master`='$edad',`genero_Master`='$genero',`numero_tel_Master`='$numero_telefonico',`fecha_nacimientoMaster`='$fecha_nacimiento',`f_modificacion_Master`='$f_creacion' WHERE `id_master`='$id_master'";
                                        if ($datosMU = $connection->query($sqlMU) === true) {
                                            //Autorizamos la redireccion a otro sitio (Dashboard)
                                            $Autorizacion = true;
                                            include '../../controllers/phpMailer/enviarCorreoMst.php';
                                        }
                                    }
                                }

                            } else {
                                if ($subMat == "ADM") {
                                    //Obtenemos el correo de la persona para hacer movimientos de tipo crud
                                    $email_admin = $_SESSION["email_admin"];
                                    //Ejecutamos una sentencia SQL para obtener el id de la persona (Administrador)
                                    $sqlADMID = $connection->query("SELECT * FROM administrador WHERE email_admin='$email_admin'");
                                    if ($datosAdm = $sqlADMID->fetch_object()) {
                                        //Obtenemos el ID del usuario
                                        $id_administrador = $datosAdm->id_administrador;

                                        //Ejecutamos la sentencia SQL para insertar los datos de Domicilio
                                        $sqlDirAdm = "INSERT INTO direccionAdministrador (`calleAdmin`, `numeroCalleAdmin`, `coloniaAdmin`, `estadoAdmin`, `ciudadAdmin`, `codPostalAdmin`, `f_creacion_DirAdmin`, id_administrador)
                                    VALUES('$callePersona', '$numeroCallePersona', '$coloniaPersona', '$estadoPersona', '$ciudadPersona','$codPostalPersona', '$f_creacion', '$id_administrador')";
                                        //Si los datos se envian entonces
                                        if ($datosA = $connection->query($sqlDirAdm) === TRUE) {
                                            //Ejecutamos la sentencia SQL para actualizar los datos del Master
                                            $sqlAU = "UPDATE `administrador` SET `segundo_nombreAdmin`='$seg_nombre_persona', `edad_Admin`='$edad',`genero_Admin`='$genero',`numero_tel_Admin`='$numero_telefonico',`fecha_nacimientoAdmin`='$fecha_nacimiento',`f_modificacion_Admin`='$f_creacion' 
                                        WHERE `id_administrador`='$id_administrador'";
                                            if ($datosAU = $connection->query($sqlAU) === true) {
                                                //Autorizamos la redireccion a otro sitio (Dashboard)
                                                $Autorizacion = true;
                                                include '../../controllers/phpMailer/enviarCorreoAdm.php';
                                            }
                                        }
                                    }
                                }
                            }
                        }

                    }
                }

            }
        }

    } else {
        //Campos vacíos
        echo "Se detectan campos vacíos, corrobora tu información :(";
    }
    if ($Autorizacion == true) {
        // header("location:../dashboard/inicio.php");
        echo "
                        <script>
                        let timerInterval
                        Swal.fire({
                            icon: 'success',
                            title: 'Todo está listo!',
                            html: 'Se actualizará en <b></b>.',
                            timer: 1369,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
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
                                location.href = '../dashboard/inicio.php';
                            }
                        }); </script>";
    }
}