<?php
//Control de acceso por roles
$Autorizacion = false;
session_start();
$url = '';
if (empty($_SESSION["subMat"])) {
    $Autorizacion = true;
    $url = '../index.php';
} else if ($_SESSION["subMat"] == "ASP") {
    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = false;
            // $url = 'aspOfertaAcadem/index.php';
        }

    } else if ($_SESSION["estatus_persona"] == "PROCADM") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = true;
            $url = 'stripeInscrip/pago/pagoExamAdm.php';
        }

    } else if ($_SESSION["estatus_persona"] == "PREINSC") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = true;
            $url = 'stripeInscrip/pago/pagoInscripcion.php';
        }
    }
} else if ($_SESSION["subMat"] == "PF") {
    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = false;
            // $url = 'padreFamiliaHijo/paFamHijo.php';
        }

    } else if ($_SESSION["estatus_persona"] == "ASIGNADO") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = true;
            $url = 'stripeInscrip/pago/pagoExamAdm.php';
        }

    } else if ($_SESSION["estatus_persona"] == "ASIGPREIN") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = true;
            $url = 'stripeInscrip/pago/pagoInscripcion.php';
        }

    }
} else if ($_SESSION["subMat"] == "Al") {

    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            // $Autorizacion = true;
            // $url = 'aspOfertaAcadem/index.php';
        }

    } else if ($_SESSION["estatus_persona"] == "PROCADM") {
        //Agregar que sucede 
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            // $Autorizacion = true;
            $Autorizacion = true;
            $url = 'stripeInscrip/pago/pagoInscripcion.php';
        }

    } else if ($_SESSION["estatus_persona"] == "INSCRITO") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = '../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            // $Autorizacion = true;
            $Autorizacion = false;
            // $url = 'aspOfertaAcadem/index.php';
        }

    }

} else if ($_SESSION["subMat"] == "DOC") {
    $Autorizacion = false;
} else if ($_SESSION["subMat"] == "ADM") {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time 
        session_destroy(); // destroy session data in storage
        $Autorizacion = true;
        $url = '../index.php';
    } else {
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        // $Autorizacion = true;
        $Autorizacion = false;

    }

} else if ($_SESSION["subMat"] == "MST") {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time 
        session_destroy(); // destroy session data in storage
        $Autorizacion = true;
        $url = '../index.php';
    } else {
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        // $Autorizacion = true;
        $Autorizacion = false;

    }
}
if ($Autorizacion == true) {
    //                   ./Views/
    header("location:./../$url");
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="../../styles/css/dashstyle.css">

    <link rel="shortcut icon" type="image/x-icon" href="./../../img/loginImages/EducationSchool.svg" />

    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>SISESCOLAR INICIO</title>


</head>

<body>
    <div class="container">
        <aside>
            <!-- LOGOTYPE DIV -->
            <div class="top">
                <div class="logo">
                    <!-- <img src="img/dashimgs/graduation.svg" alt="logotype"> -->
                    <span class="material-icons-sharp">school</span>
                    <h2>SIS<span class="primary">ESCOLAR</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <!-- END OF LOGOTYPE DIV -->
            <!-- SIDEBAR / NAVBAR CODE -->
            <div class="sidebar">
                <ul class="">
                    <!--
                        THE FOLLOWING CODE IS THE SAME AS THE PHP CODE INSERTION

                    <li class="active">
                        <a class="" href="inicio.php">
                            <span class="material-icons-sharp">grid_view</span>
                            <h3>Dashboard</h3>
                        </a>
                    </li> -->
                    <?php
                    if ($_SESSION["subMat"] == "ASP") {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="../stripeInscrip/pago/pagoExamAdm.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>
                            
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else if($_SESSION["subMat"] == "PF" and $_SESSION["estatus_persona"] == "ACTIVO"){
                        echo '
                            <li class="active">
                                <a class="" href="./../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="../padreFamiliaHijo/paFamHijo.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Asignar Hijo</h3>
                                </a>
                            </li>
                            
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    }else if ($_SESSION["subMat"] == "PF" and $_SESSION["estatus_persona"] == "ASIGPREIN") {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="">
                            <a class="" href="../stripeInscrip/pago/pagoExamAdm.php">
                                <span class="material-icons-sharp">person</span>
                                <h3>Inscripciones</h3>
                            </a>
                            </li>                
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "PF" and $_SESSION["estatus_persona"] == "ASIGPAG") {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                                                     
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "DOC") {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            
                            <li class="">
                                <a class="dropdown-toggleCursos">
                                    <span class="material-icons-sharp">import_contacts</span>
                                        <h3>Cursos</h3>
                                    <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menuCursos">
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/users/cursos.php">
                                            <span class="material-icons-sharp">import_contacts</span>
                                            <h3>Cursos</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/users/mis-cursos.php">
                                            <span class="material-icons-sharp">history</span>
                                            <h3>Mis cursos</h3>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "Al") {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            
                            <li class="">
                                <a class="dropdown-toggleCursos">
                                    <span class="material-icons-sharp">import_contacts</span>
                                        <h3>Cursos</h3>
                                    <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menuCursos">
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/users/cursos.php">
                                            <span class="material-icons-sharp">import_contacts</span>
                                            <h3>Cursos</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/users/mis-cursos.php">
                                            <span class="material-icons-sharp">history</span>
                                            <h3>Mis cursos</h3>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else {
                        echo '
                            <li class="active">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>   
                           
                            <li class="">
                                <a class="dropdown-toggle" href="#">
                                <span class="material-icons-sharp">add</span>
                                    <h3>Personal</h3>
                                    <span class="material-icons-sharp arrow_down first-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="./admmst/createAdm.php">
                                            <span class="material-icons-sharp">people</span>
                                            <h3>Admin/Master</h3>
                                        </a>
                                    </li>
                                    
                                    <!-- <li class="">
                                         <a class="" href="../stripeInscrip/pago/pagoExamAdm.php">
                                             <span class="material-icons-sharp">person</span>
                                             <h3>Inscripciones</h3>
                                         </a>
                                     </li>-->

                                    <!-- <li>
                                        <hr class="dropdown-divider">
                                    </li> -->

                                </ul>
                            </li>

                            <li class="">
                                <a class="dropdown-toggleCursos" href="#">
                                    <span class="material-icons-sharp">import_contacts</span>
                                    <h3>Cursos</h3>
                                    <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menuCursos">
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/admin/nuevo-curso.php">
                                            <span class="material-icons-sharp">add</span>
                                            <h3>Nuevo Curso</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/admin/historial.php">
                                            <span class="material-icons-sharp">history</span>
                                            <h3>Historial</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/admin/reporte.php">
                                            <span class="material-icons-sharp">receipt_long</span>
                                            <h3>Reportes</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/admin/compras.php">
                                            <span class="material-icons-sharp">paid</span>
                                            <h3>Compras</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../cursos-eventos/admin/actividad.php">
                                            <span class="material-icons-sharp">trending_up</span>
                                            <h3>Actividad</h3>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!--<li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>-->
                            <li class="">
                                <a class="" href="./../panelSeg/segAsp.php">
                                    <span class="material-icons-sharp">admin_panel_settings</span>
                                    <h3>Panel de Seguimiento</h3>
                                </a>
                            </li>
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    }
                    ?>

                    <!-- NAV BAR WITHOUT ROL CONTROL-->
                </ul>
            </div>
            <!-- END OF SIDEBAR / NAVBAR -->
        </aside>
        <!------------------- END OF ASIDE ---------------->
        <main>
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">people</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Alumnos</h3>
                            <div>
                                <h1 id="alumnosCantidad">0</h1>
                            </div>
                        </div>
                        <div class="progress">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                           
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!----------------------- END OF SALES ------------------->
                <div class="expenses">
                    <span class="material-icons-sharp">people</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Docentes</h3>
                            <h1 id="docentesCantidad">0</h1>
                        </div>
                        <div class="progress">
                            <div>
                                <canvas id="myChartDoc"></canvas>
                            </div>
                           
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!----------------------- END OF EXPENSES ------------------->
                <div class="income">
                    <span class="material-icons-sharp">family_restroom</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Padres de Familia</h3>
                            <h1 id="padresDeFamCantidad">0</h1>
                        </div>
                        <div class="progress">
                            <div>
                                <canvas id="myChartPadreDeFam"></canvas>
                            </div>
                            <!-- <svg class="svgCircle">
                                <circle cx='38' cy="38" r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div> -->
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!----------------------- END OF INCOME ------------------->
            </div>
            <!--------------------- END OF INSIGHTS ---------------------->
            <div class="recent-orders">
                <?php
                if ($_SESSION['subMat'] == "ADM" || $_SESSION['subMat'] == "MST") {
                    //Desmarcar cuando se ocupe la plantilla de Pedidos recientes con el script de js "orders.js"
                //     echo '
                //     <h2>Pedidos Recientes</h2>
                // <table>
                //     <thead>
                //         <tr>
                //             <th>Nombre del Producto</th>
                //             <th>N??mero del Producto</th>
                //             <th>M??todo de Pago</th>
                //             <th>Estado</th>
                //             <th></th>
                //         </tr>
                //     </thead>
                //     <tbody>
                //         <!--Example but now with js file
                //              <tr>
                //             <td>Foldable Mini Drone</td>
                //             <td>8564</td>
                //             <td>Due</td>
                //             <td class="warning">Pending</td>
                //             <td class="primary">Details</td>
                //         </tr>
                //     </tbody> -->
                // </table>
                // <a href="">Show All</a>
                //     ';
                } else if ($_SESSION['subMat'] == "ASP" AND $_SESSION['estatus_persona'] == "ACTIVO" ) {

                }
                ?>

            </div>
        </main>
        <!---------------------------- END OF MAIN ------------------->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler" id="darkbutton">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hola, <b>
                                <?php
                                if ($_SESSION["subMat"] == "ASP") {
                                    echo '' . $_SESSION["nombre_aspirante"] . " " . $_SESSION["apellido_paternoAspirante"] . '';
                                } elseif ($_SESSION["subMat"] == "Al") {
                                    echo '' . $_SESSION["nombre_alumno"] . " " . $_SESSION["apellido_paternoAlumno"] . '';
                                } elseif ($_SESSION["subMat"] == "PF") {
                                    echo '' . $_SESSION["nombre_padreDeFam"] . " " . $_SESSION["apellido_paternopadreDeFam"] . '';
                                } elseif ($_SESSION["subMat"] == "DOC") {
                                    echo '' . $_SESSION["nombre_docente"] . " " . $_SESSION["apellido_paternoDocente"] . '';
                                } elseif ($_SESSION["subMat"] == "ADM") {
                                    echo '' . $_SESSION["nombre_admin"] . " " . $_SESSION["apellido_paternoAdmin"] . '';
                                } elseif ($_SESSION["subMat"] == "MST") {
                                    echo '' . $_SESSION["nombre_master"] . " " . $_SESSION["apellido_paternoMaster"] . '';
                                } else {
                                    echo 'Rol Desconocido';
                                }
                                ?>
                            </b></p>
                        <small class="text-muted">
                            <?php
                            if ($_SESSION["subMat"] == "ASP") {
                                echo 'Aspirante';
                            } elseif ($_SESSION["subMat"] == "Al") {
                                echo 'Alumno';
                            } elseif ($_SESSION["subMat"] == "PF") {
                                echo 'Padre de Familia';
                            } elseif ($_SESSION["subMat"] == "DOC") {
                                echo 'Docente';
                            } elseif ($_SESSION["subMat"] == "ADM") {
                                echo 'Administrador';
                            } elseif ($_SESSION["subMat"] == "MST") {
                                echo 'MASTER';
                            } else {
                                echo 'Rol Desconocido';
                            }
                            ?>
                        </small>
                    </div>
                    <div class="profile-photo">
                        <a href="./../register/completeProfileDash.php">
                            <img src="./../../img/altindeximages/avatar.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!------------------------------- END OF top / top ------------------------>
            <?php
            if (isset($_SESSION["estatus_persona"])) {
                if($_SESSION["estatus_persona"] == "ACTIVO"){
                    echo '
                <div class="recent-updates">
                    <h2>Notificaciones</h2>
                    <div class="info-noticaciones-cursos" >
                    <p class="danger">No se ha realizado el pago de inscripci??n</p>
                    </div>
                </div>
                ';
                }
                
            }else if ($_SESSION['subMat'] == "Al" || $_SESSION['subMat'] == "DOC") {
                echo '
                <div class="recent-updates">
                    <h2>Notificaciones</h2>
                    <div class="info-noticaciones-cursos"  id="notificaciones-de-cursos"></div>
                </div>
                ';
            } else if ($_SESSION['subMat'] == "ADM" || $_SESSION['subMat'] == "MST") {
                echo '
                <div class="recent-updates">
                    <h2>Notificaciones</h2>
                    <div class="info-noticaciones-cursos"  id="notificaciones-de-cursos"></div>
                </div>
                ';
            }
            ?>
            <!-- END OF RECENT UPDATES -->
            <div class="sales-analytics">
                <?php
                if ($_SESSION['subMat'] == "ADM" || $_SESSION['subMat'] == "MST") {
                    //Desmarcar cuando se ocupen metricas para ventas
                //     echo '
                //     <h2>Metricas de Ventas</h2>
                // <div class="item online">
                //     <div class="icon">
                //         <span class="material-icons-sharp">shopping_cart</span>
                //     </div>
                //     <div class="right">
                //         <div class="info">
                //             <h3>Pedidos en l??nea</h3>
                //             <small class="text-muted">Ultimas 24 horas</small>
                //         </div>
                //         <h5 class="success">+39%</h5>
                //         <h3>3849</h3>
                //     </div>
                // </div>
                // <div class="item offline">
                //     <div class="icon">
                //         <span class="material-icons-sharp">local_mall</span>
                //     </div>
                //     <div class="right">
                //         <div class="info">
                //             <h3>Pedidos Presenciales</h3>
                //             <small class="text-muted">Ultimas 24 horas</small>
                //         </div>
                //         <h5 class="danger">+17%</h5>
                //         <h3>1100</h3>
                //     </div>
                // </div>
                // <div class="item customers">
                //     <div class="icon">
                //         <span class="material-icons-sharp">person</span>
                //     </div>
                //     <div class="right">
                //         <div class="info">
                //             <h3>Nuevos clientes</h3>
                //             <small class="text-muted">Ultimas 24 horas</small>
                //         </div>
                //         <h5 class="success">+25%</h5>
                //         <h3>849</h3>
                //     </div>
                // </div>
                // <!--<div class="item add-product">
                //     <div>
                //         <span class="material-icons-sharp">add</span>
                //         <h3>Agregar Producto</h3>
                //     </div>
                // </div>-->
                //     ';
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Script for navbar arrows and show the elements -->

    <script>
        $('.dropdown-toggle').click(function () {
            $('aside .sidebar ul .dropdown-menu').toggleClass("show");

            $('aside .sidebar ul .first-arrow').toggleClass("rotate");
        });
        $('aside .sidebar ul li').click(function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>

    <script>
        $('.dropdown-toggleCursos').click(function () {
            $('aside .sidebar ul .dropdown-menuCursos').toggleClass("show");
            $('aside .sidebar ul .second-arrow').toggleClass("rotate");
        });
        $('aside .sidebar ul li').click(function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>

    
    <script src="../../js/dashboard/inicio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    if ($_SESSION['subMat'] == "ASP" || $_SESSION['subMat'] == "PF") {
        echo '
        <script id="alumnosChart"></script>
        <script id="docentesChart"></script>
        <script id="padresDeFamChart"></script>
        <script src="../../js/dashboardAnalytics/alumnos.js"></script>
        ';
    }else if ($_SESSION['subMat'] == "Al" || $_SESSION['subMat'] == "DOC") {
        echo '
        <script id="alumnosChart"></script>
        <script id="docentesChart"></script>
        <script id="padresDeFamChart"></script>
        <script src="../../js/dashboardAnalytics/alumnos.js"></script>
        ';
    } else if ($_SESSION['subMat'] == "ADM" || $_SESSION['subMat'] == "MST") {
        echo ' 
        <script src="../../js/dashboard/cargar-cursos-proximos.js"></script>
        <script id="alumnosChart"></script>
        <script id="docentesChart"></script>
        <script id="padresDeFamChart"></script>
        <script src="../../js/dashboardAnalytics/alumnos.js"></script>
        
        <script src="../../js/dashboard/cargar-cursos-proximos.js"></script>
        ';
        // echo '
        // <script src="../../js/dashboard/orders.js"></script>
        // ';
    }
    ?>

</body>

</html>