<?php
// PAGO DE EXAMEN DE ADMISION
//Control de acceso por roles
$Autorizacion = false;
session_start();
$url = '';
if (empty($_SESSION["subMat"])) {
    $Autorizacion = true;
    $url = './../../index.php';
} else if ($_SESSION["subMat"] == "ASP") {
    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // Ultima recarga fue hace más de 30 minutos
            session_unset(); // des-asignar valores a la session 
            session_destroy(); // destruir el almacenamiento de la session
            $Autorizacion = true;
            $url = './../../index.php'; //Regresa al index
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // Actualiza el ultimo tiempo de actividad
            $Autorizacion = true;
            $url = './../aspOfertaAcadem/index.php';
        }

    } else if ($_SESSION["estatus_persona"] == "PROCADM") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // Ultima recarga fue hace más de 30 minutos
            session_unset(); // des-asignar valores a la session 
            session_destroy(); // destruir el almacenamiento de la session
            $Autorizacion = true;
            $url = './../../index.php';
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = false;
            // $url = 'pago/index.php';
        }
    }
} else if ($_SESSION["subMat"] == "PF") {
    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = './../../index.php'; //Regresa al index
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = true;
            $url = './../dashboard/inicio.php'; //Regresa al index
        }

    } else if ($_SESSION["estatus_persona"] == "ASIGNADO") {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = './../../index.php'; //Regresa al index
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = false;
            // $url = './../dashboard/inicio.php'; //Regresa al index
        }

    }

} else if ($_SESSION["subMat"] == "Al") {

    if ($_SESSION["estatus_persona"] == "ACTIVO") {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time 
            session_destroy(); // destroy session data in storage
            $Autorizacion = true;
            $url = './../../index.php'; //Regresa al index
        } else {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $Autorizacion = false;
            // $url = 'aspOfertaAcadem/index.php';
        }

    } else if ($_SESSION["estatus_persona"] == /*Cambiar ese status por el deseado*/"PROCADM") {
        //Agregar que sucede 
        // $Autorizacion = true;
        // $url = 'stripeInscrip/pago/index.php';
    }

} else if ($_SESSION["subMat"] == "DOC") {


} else if ($_SESSION["subMat"] == "ADM") {

} else if ($_SESSION["subMat"] == "MST") {

}
if ($Autorizacion == true) {
    //                   ./Views/
    header("location:./../$url");
}

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>

    <title>Pago</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> -->


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"> 

    <!-- shorcut icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./../../img/loginImages/EducationSchool.svg" />
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="./../../../styles/css/stripePayment/stripeForm.css">-->
    <link rel="stylesheet" href="./../../../styles/css/stripePayment/stripeForm.css"> 
    <!-- <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css"> -->
    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />



</head>

<body>
    <div class="contenedor">
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
                            <li class="">
                                <a class="" href="../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>
                           
                            <li class="CloseSession">
                                <a href="./../../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "PF") {
                        echo '
                            <li class="">
                                <a class="" href="../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>     
                            <li class="">
                            <a class="dropdown-toggleCursos" href="#">
                                <span class="material-icons-sharp">import_contacts</span>
                                <h3>Cursos</h3>
                                <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                            </a>
                            <ul class="dropdown-menuCursos">
                                <li>
                                    <a class="dropdown-item" href="../../cursos-eventos/admin/nuevo-curso.php">
                                        <span class="material-icons-sharp">add</span>
                                        <h3>Nuego Curso</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../../cursos-eventos/admin/historial.php">
                                        <span class="material-icons-sharp">history</span>
                                        <h3>Historial</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../../cursos-eventos/admin/reporte.php">
                                        <span class="material-icons-sharp">receipt_long</span>
                                        <h3>Reportes</h3>
                                    </a>
                                </li>
                            </ul>
                            </li>                                        
                            <li class="CloseSession">
                                <a href="./../../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "Al") {
                        echo '
                            <li class="">
                                <a class="" href="../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="index.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
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
                                        <h3>Nuego Curso</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../../cursos-eventos/admin/historial.php">
                                        <span class="material-icons-sharp">history</span>
                                        <h3>Historial</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../../cursos-eventos/admin/reporte.php">
                                        <span class="material-icons-sharp">receipt_long</span>
                                        <h3>Reportes</h3>
                                    </a>
                                </li>
                            </ul>
                            </li>                                             
                            <li class="CloseSession">
                                <a href="./../../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                           
                            ';
                    } else if ($_SESSION["subMat"] == "DOC") {
                        echo '
                            <li class="">
                                <a class="" href="../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="index.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
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
                                            <h3>Nuego Curso</h3>
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
                                </ul>
                            </li>                                            
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            
                            ';

                    } else if ($_SESSION["subMat"] == "ADM") {
                        echo '
                            <li class="">
                                <a class="" href="index.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="../stripeInscrip/pago/index.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>                                             
                            <li class="CloseSession">
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';

                    } else {
                        echo '
                            <li class="">
                                <a class="" href="./../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>

                            <li class="active">
                                <a class="" href="../stripeInscrip/public/checkout.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Incripciones</h3>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Clientes</h3>
                                </a>
                            </li>
                            
                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">report</span>
                                    <h3>Reportes</h3>
                                </a>
                            </li>

                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">add</span>
                                    <h3>Agregar Producto</h3>
                                </a>
                            </li>

                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">settings</span>
                                    <h3>Ajustes</h3>
                                </a>
                            </li>

                            <li class="">
                                <a class="dropdown-toggle" href="#">
                                    <span class="material-icons-sharp">paid</span>
                                    <h3>Pagos</h3>
                                    <span class="material-icons-sharp arrow_down first-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="material-icons-sharp">credit_card</span>
                                            <h3>Tarjeta de Crédito</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="material-icons-sharp">local_atm</span>
                                            <h3>Efectivo</h3>
                                        </a>
                                    </li>

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
                                            <h3>Nuego Curso</h3>
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
                                </ul>
                            </li>
                            
                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="./../panelSeg/segAsp.php">
                                    <span class="material-icons-sharp">admin_panel_settings</span>
                                    <h3>Panel de Seguimiento</h3>
                                </a>
                            </li>
                            <li class="CloseSession">
                                <a href="./../../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';
                    }
                    ?>
                    <!-- <li class="">
                        <a class="" href="#">
                            <span class="material-icons-sharp">person</span>
                            <h3>Clientes</h3>
                        </a>
                    </li> -->
                    <!-- <li class="">
                        <a class="" href="#">
                            <span class="material-icons-sharp">report</span>
                            <h3>Reportes</h3>
                        </a>
                    </li> -->
                    <!-- <li class="">
                        <a class="" href="#">
                            <span class="material-icons-sharp">add</span>
                            <h3>Agregar Producto</h3>
                        </a>
                    </li> -->
                    <!-- <li class="">
                        <a class="" href="#">
                            <span class="material-icons-sharp">settings</span>
                            <h3>Ajustes</h3>
                        </a>
                    </li> -->
                    <!-- <li class="">
                        <a class="dropdown-toggle" href="#">
                            <span class="material-icons-sharp">paid</span>
                            <h3>Pagos</h3>
                            <span class="material-icons-sharp arrow_down first-arrow">keyboard_arrow_down</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="material-icons-sharp">credit_card</span>
                                    <h3>Tarjeta de Crédito</h3>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="material-icons-sharp">local_atm</span>
                                    <h3>Efectivo</h3>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li> 

                        </ul>
                    </li> -->
                    <!-- <li class="">
                        <a class="dropdown-toggleCursos" href="#">
                            <span class="material-icons-sharp">import_contacts</span>
                            <h3>Cursos</h3>
                            <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                        </a>
                        <ul class="dropdown-menuCursos">
                            <li>
                                <a class="dropdown-item" href="../cursos-eventos/nuevo-curso.php">
                                    <span class="material-icons-sharp">add</span>
                                    <h3>Nuego Curso</h3>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../cursos-eventos/historial.php">
                                    <span class="material-icons-sharp">history</span>
                                    <h3>Historial</h3>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="material-icons-sharp">receipt_long</span>
                                    <h3>Reportes</h3>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="">
                        <a class="" href="#">
                            <span class="material-icons-sharp">mail_outline</span>
                            <h3>Mensajes</h3>
                            <span class="message-count">26</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="./../panelSeg/segAsp.php">
                            <span class="material-icons-sharp">admin_panel_settings</span>
                            <h3>Panel de Seguimiento</h3>
                        </a>
                    </li>
                    <li class="CloseSession">
                        <a href="./../../controllers/controller_logout.php">
                            <span class="material-icons-sharp">logout</span>
                            <h3>Cerrar Sesión</h3>
                        </a>
                    </li> 
                
                NAV BAR WITHOUT ROL CONTROL-->
                </ul>
            </div>
            <!-- END OF SIDEBAR / NAVBAR -->
        </aside>
        <!------------------- END OF ASIDE ---------------->
        <main>
            <?php
            $emailPag = "";
                if ($_SESSION["subMat"] == "ASP") {
                    $emailPag = $_SESSION["email_aspirante"];

            } else if ($_SESSION["subMat"] == "PF") {
                $emailPag = $_SESSION['email_padreDeFam'];

            }

            ?>
            <form action="process.php" method="post" id="payment-form">

                <div class="insights-form">
                    <div class="sales-form">
                        <div>
                            <h1>Antes de pagar espera a que un agente de la escuela se comunique contigo</h1>
                            <h2 class="success">Pago de Exámen de Admisión</h2>
                        </div>

                        <label for="exampleInputEmail1">Correo de tu cuenta escolar</label>

                        <input type="email" required name="email" class="form-control" id="exampleInputEmail1"
                            placeholder="Correo electrónico" value="<?php echo $emailPag;?>">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Monto total</label>
                            <?php
                            include "./../../../model/connection.php"; //DB Connection
                            if ($_SESSION["subMat"] == "ASP") { //Busqueda de aspirante
                                $id_aspirante = $_SESSION["id_aspirante"];
                                //Ejecutamos la sentencia SQL
                                $sqlDatosPFH = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padreDeFamiliaHijo` 
                                WHERE `id_aspirante` = '$id_aspirante'");
                                //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                                if ($datos = $sqlDatosPFH->fetch_object()) {
                                    $id_padreDeFamilia = $datos->id_padreDeFamilia;
                                    $sqlDatosAdmisionIntereses = $connection->query("SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`, `id_especializacion` FROM `admisionInteresesAspirante` 
                                    WHERE `id_aspirante`= '$id_aspirante'");
                                    if ($datosAdmision = $sqlDatosAdmisionIntereses->fetch_object()) {
                                        $id_escuela = $datosAdmision->id_escuela;

                                        $sqlMontoBeca = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela 
                                        FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago 
                                        INNER JOIN aspirante_pago on pago.id_pago = aspirante_pago.id_pago
                                        WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion LIKE 'Beca Admisión%' AND aspirante_pago.id_aspirante='$id_aspirante' ORDER BY pago.f_creacion_pago DESC;");
                                        if ($datosMontoB = $sqlMontoBeca->fetch_object()) {
                                            define('monto', ($datosMontoB->monto));
                                            $_SESSION['id_pago'] = $datosMontoB->id_pago;
                                            $_SESSION['descripcion'] = $datosMontoB->descripcion;
                                            $_SESSION['moneda_concurrencia'] = $datosMontoB->moneda_concurrencia;
                                        } else {
                                            $sqlMonto = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago
                                            WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion='Exámen de Admisión' ORDER BY pago.f_creacion_pago DESC;");
                                            if ($datosMonto = $sqlMonto->fetch_object()) {
                                                define('monto', ($datosMonto->monto));
                                                $_SESSION['id_pago'] = $datosMonto->id_pago;
                                                $_SESSION['descripcion'] = $datosMonto->descripcion;
                                                $_SESSION['moneda_concurrencia'] = $datosMonto->moneda_concurrencia;
                                            } else {
                                                define('monto', 'Aún no se asigna un precio al pago, regrese más tarde');
                                            }
                                        }

                                        // $sqlMonto = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago
                                        // WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion='Exámen de Admisión' ORDER BY pago.f_creacion_pago DESC;");
                                        // if ($datosMonto = $sqlMonto->fetch_object()) {
                                        //     define('monto', ($datosMonto->monto));
                                        //     $_SESSION['id_pago'] = $datosMonto->id_pago;
                                        //     $_SESSION['descripcion'] = $datosMonto->descripcion;
                                        //     $_SESSION['moneda_concurrencia'] = $datosMonto->moneda_concurrencia;
                                        // } else {
                                        //     define('monto', 'Aún no se asigna un precio al pago, regrese más tarde');
                                        // }
                                    } else {
                                        define('monto', 'No asignado');
                                    }
                                } else {
                                    $sqlDatosAdmisionIntereses = $connection->query("SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`, `id_especializacion` FROM `admisionInteresesAspirante` 
                                    WHERE `id_aspirante`= '$id_aspirante'");
                                    if ($datosAdmision = $sqlDatosAdmisionIntereses->fetch_object()) {
                                        $id_escuela = $datosAdmision->id_escuela;
                                        $sqlMontoBeca = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela 
                                        FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago 
                                        INNER JOIN aspirante_pago on pago.id_pago = aspirante_pago.id_pago
                                        WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion LIKE 'Beca Admisión%' AND aspirante_pago.id_aspirante='$id_aspirante' ORDER BY pago.f_creacion_pago DESC;");
                                        if ($datosMontoB = $sqlMontoBeca->fetch_object()) {
                                            define('monto', ($datosMontoB->monto));
                                            $_SESSION['id_pago'] = $datosMontoB->id_pago;
                                            $_SESSION['descripcion'] = $datosMontoB->descripcion;
                                            $_SESSION['moneda_concurrencia'] = $datosMontoB->moneda_concurrencia;
                                        } else {
                                            $sqlMonto = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago
                                            WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion='Exámen de Admisión' ORDER BY pago.f_creacion_pago DESC;");
                                            if ($datosMonto = $sqlMonto->fetch_object()) {
                                                define('monto', ($datosMonto->monto));
                                                $_SESSION['id_pago'] = $datosMonto->id_pago;
                                                $_SESSION['descripcion'] = $datosMonto->descripcion;
                                                $_SESSION['moneda_concurrencia'] = $datosMonto->moneda_concurrencia;
                                            } else {

                                                define('monto', 'Aún no se asigna un precio al pago, regrese más tarde');
                                            }
                                        }

                                    }
                                }

                            } else if ($_SESSION["subMat"] == "PF") { //Busqueda de padre de familia
                                $id_padreDeFamilia = $_SESSION["id_padreDeFamilia"];
                                //Ejecutamos la sentencia SQL
                                $sqlDatosPFH = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padreDeFamiliaHijo` 
                                WHERE `id_padreDeFamilia` = '$id_padreDeFamilia'");
                                //Obtenemos el registro de los datos y guardamos algunos para control de acceso
                                if ($datos = $sqlDatosPFH->fetch_object()) {
                                    $id_aspirante = $datos->id_aspirante;
                                    $sqlDatosAdmisionIntereses = $connection->query("SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`, `id_especializacion` FROM `admisionInteresesAspirante` 
                                    WHERE `id_aspirante`= '$id_aspirante'");
                                    if ($datosAdmision = $sqlDatosAdmisionIntereses->fetch_object()) {
                                        $id_escuela = $datosAdmision->id_escuela;
                                        $sqlMontoBeca = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela 
                                        FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago 
                                        INNER JOIN aspirante_pago on pago.id_pago = aspirante_pago.id_pago
                                        WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion LIKE 'Beca Admisión%' AND aspirante_pago.id_aspirante='$id_aspirante' ORDER BY pago.f_creacion_pago DESC;");
                                        if ($datosMontoB = $sqlMontoBeca->fetch_object()) {
                                            define('monto', ($datosMontoB->monto));
                                            $_SESSION['id_pago'] = $datosMontoB->id_pago;
                                            $_SESSION['descripcion'] = $datosMontoB->descripcion;
                                            $_SESSION['moneda_concurrencia'] = $datosMontoB->moneda_concurrencia;
                                        } else {
                                            $sqlMonto = $connection->query("SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago
                                            WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='$id_escuela' AND pago.descripcion='Exámen de Admisión' ORDER BY pago.f_creacion_pago DESC;");
                                            if ($datosMonto = $sqlMonto->fetch_object()) {
                                                define('monto', ($datosMonto->monto));
                                                $_SESSION['id_pago'] = $datosMonto->id_pago;
                                                $_SESSION['descripcion'] = $datosMonto->descripcion;
                                                $_SESSION['moneda_concurrencia'] = $datosMonto->moneda_concurrencia;
                                            } else {

                                                define('monto', 'Aún no se asigna un precio al pago, regrese más tarde');
                                            }
                                        }
                                    } else {
                                        define('monto', 'Algo Salio mal');
                                    }
                                } else {
                                    define('monto', 'No asignado');
                                }
                                // $sqlPagoSearch = "SELECT pago.id_pago, pago.monto, pago.descripcion, pago.moneda_concurrencia, pago.f_creacion_pago, escuela_pago.id_escuela FROM pago INNER JOIN escuela_pago on pago.id_pago = escuela_pago.id_pago
                                // WHERE pago.estatus_pago='ACTIVO' AND escuela_pago.id_escuela='5' AND pago.descripcion='Exámen de Admisión' ORDER BY pago.f_creacion_pago DESC;";
                            }

                            // const monto = intval($valorMonto);
                            ?>
                            <input style="display:grid;" type="number" required name="totalX" class="unselectable"
                                id="exampleInputPasswordX" placeholder="$<?php echo monto ?>" pattern="[0-9]+"
                                title="Precio total a pagar" readonly="readonly">

                        </div>
                        <div><input class="unselectable" type="number" value="<?php echo monto ?>" name="total"
                                id="exampleInputPassword1" readonly="readonly" hidden></div>

                        <label for="card-element">Tarjeta de crédito o debito</label>

                        <div id="card-element">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors -->
                        <div id="card-errors"></div>

                        <?php
                        if (monto != 'Aún no se asigna un precio al pago, regrese más tarde') {
                            if (monto != 'Algo Salio mal') {
                                if (monto != 'No asignado') {
                                    echo '<button class="btn-action-form">Pagar</button>';
                                }
                            }
                        }
                        ?>
                        <input type="hidden" class="form-control" required name="paymethod_id" value="stripe">
                        <br>

                    </div>
                </div>
            </form>
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
                                echo 'Padre de Fam';
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
                        <img src="./../../../img/altindeximages/avatar.svg" alt="">
                    </div>
                </div>
            </div>
            <!------------------------------- END OF top / top ------------------------>
            <div class="recent-updates">
                <h2>Publicidad</h2>

            </div>
            <!-- END OF RECENT UPDATES -->
            <div class="sales-analytics">
                <h2>Otro apartado</h2>
                <!-- <div class="item online">
                                    <div class="icon">
                                        <span class="material-icons-sharp">shopping_cart</span>
                                    </div>
                                    <div class="right">
                                        <div class="info">
                                            <h3>Pedidos en línea</h3>
                                            <small class="text-muted">Last 24 Hours</small>
                                        </div>
                                        <h5 class="success">+39%</h5>
                                        <h3>3849</h3>
                                    </div>
                                </div>
                                <div class="item offline">
                                    <div class="icon">
                                        <span class="material-icons-sharp">local_mall</span>
                                    </div>
                                    <div class="right">
                                        <div class="info">
                                            <h3>Pedidos Presenciales</h3>
                                            <small class="text-muted">Last 24 Hours</small>
                                        </div>
                                        <h5 class="danger">+17%</h5>
                                        <h3>1100</h3>
                                    </div>
                                </div>
                                <div class="item customers">
                                    <div class="icon">
                                        <span class="material-icons-sharp">person</span>
                                    </div>
                                    <div class="right">
                                        <div class="info">
                                            <h3>Nuevos clientes</h3>
                                            <small class="text-muted">Last 24 Hours</small>
                                        </div>
                                        <h5 class="success">+25%</h5>
                                        <h3>849</h3>
                                    </div>
                                </div>
                                <div class="item add-product">
                                    <div>
                                        <span class="material-icons-sharp">add</span>
                                        <h3>Agregar Producto</h3>
                                    </div>
                                </div> -->
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
            $(this).addClass("active").siblings().removeClass("ae");
        });
    </script>

    <!-- SCRIPT JS -->
    <!-- <script src="../../js/dashboard/orders.js"></script> -->
    <script src="../../../js/changeTheme/theme.js"></script>


    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="charge.js"></script>

</body>

</html>