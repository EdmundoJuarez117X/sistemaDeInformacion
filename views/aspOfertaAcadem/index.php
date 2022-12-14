<?php
session_start();
if (empty($_SESSION["subMat"])) {
    header("location:./../../index.php");
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!-- shorcut icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./../../img/loginImages/EducationSchool.svg" />
    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="../../styles/css/aspOfertAcad/aspOferAcad.css">
    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Ofeta Académica</title>


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
                    if ($_SESSION["subMat"] == "ASP" or $_SESSION["subMat"] == "DOC") {
                        echo '
                            <li class="">
                                <a class="" href="./../dashboard/inicio.php">
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
                            <!--<li class="">
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
                                </ul>
                            </li>-->
                            
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
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "PF") {
                        echo '
                            <li class="active">
                                <a class="" href="index.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="../stripeInscrip/pago/index.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>                            
                            <li class="">
                                <a class="" href="#">
                                    <span class="material-icons-sharp">mail_outline</span>
                                    <h3>Mensajes</h3>
                                    <span class="message-count">26</span>
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
                            <li class="active">
                                <a class="" href="index.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>

                            <li class="">
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
                                <a href="./../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                            ';
                    }
                    ?>

                </ul>
            </div>
            <!-- END OF SIDEBAR / NAVBAR -->
        </aside>
        <!------------------- END OF ASIDE ---------------->
        <main>
            <?php
            include('./../../model/connection.php')
                ?>
            <h1>Oferta Académica</h1>


            <div class="insights-form">
                <div class="sales-form">
                    <span class="material-icons-sharp">school</span>
                    <h1>Elige la escuela de tus sueños! 😃👍</h1>

                    <!-- <p>Descripción:
                            <textarea name="course_description" id="course_description" cols="30" rows="10"
                                required></textarea>
                        </p> -->
                    <?php
                    // $query = "SELECT * FROM `escuela`;";
                    // $result = mysqli_query($connection, $query);
                    ?>

                    <!-- <div class="fields-middle second-middle">
                        <p>Nombre de la escuela:
                            <select name="select_school" id="select_school" required>
                                <option value="">Selecciona una escuela</option>
                                <?php
                                // while ($row = mysqli_fetch_array($result)):
                                //     ;
                                // ?>
                                <option>
                                    <?php //echo $row[1]; ?>
                                </optiondwhile; ?>
                                <?php //endwhile;?>

                            </select>
                        </p>
                    </div> -->
                    <!-- End of School select option -->
                    <?php
                    $querySc = "SELECT * FROM `nivelEducativo`;";
                    $resultSc = mysqli_query($connection, $querySc);
                    ?>
                    <div class="">
                        <p>Escuela de Nivel Educativo</p>
                        <select name="select_nivelEdu" id="select_nivelEdu">
                            <option value="">Selecciona un nivel educativo</option>
                            <?php
                            while ($row = mysqli_fetch_array($resultSc)):
                                ;
                            ?>
                                <option>
                                    <?php echo $row[1]; ?>
                                </optiondwhile; ?>
                                <?php endwhile; ?>
                        </select>
                    </div>
                    <!-- End of nivel Educativo select option -->
                    <?php
                    $queryPe = "SELECT * FROM `periodoEscolar`;";
                    $resultPe = mysqli_query($connection, $queryPe);
                    ?>
                    <div class="">
                        <p>Periodo Escolar</p>
                        <select name="select_periodoE" id="select_periodoE">
                            <option value="">Selecciona un periodo escolar</option>
                            <?php
                            while ($row = mysqli_fetch_array($resultPe)):
                                ;
                            ?>
                            <option>
                                <?php echo $row[1]; ?>
                                </optiondwhile; ?>
                                <?php endwhile; ?>
                        </select>
                    </div>
                    <!-- End of Schoolar Period select option -->
                    <?php
                    $queryMe = "SELECT * FROM `modalidadEscolar`;";
                    $resultMe = mysqli_query($connection, $queryMe);
                    ?>
                    <div class="">
                        <p>Modalidad Escolar</p>
                        <select name="select_modalidadE" id="select_modalidadE">
                            <option value="">Selecciona un periodo académico</option>
                            <?php
                            while ($row = mysqli_fetch_array($resultMe)):
                                ;
                            ?>
                            <option>
                                <?php echo $row[1]; ?>
                                </optiondwhile; ?>
                                <?php endwhile; ?>
                        </select>
                    </div>
                    <!-- End of Schoolar modality select option -->
                    <button id="showData" class="btnSeg">Obtener Información</button>
                    <div id="table-container" class="container-schoolTables" style="overflow-y:scroll;">

                    </div>
                </div>
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
                    <p class="danger">No se ha realizado el pago de inscripción</p>
                    </div>
                </div>
                ';
                }
                
            }else{
                echo '
                <div class="recent-updates">
                <h2>Notificaciones</h2>
                <div class="info-noticaciones-cursos" id="notificaciones-de-cursos">
                </div>

            </div>
                ';
            }
            ?>
            
            <!-- END OF RECENT UPDATES -->
            <!-- <div class="sales-analytics">
                <h2>Otro apartado</h2>
            </div> -->
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

    <!-- SCRIPT JS -->
    <!-- <script src="../../js/dashboard/orders.js"></script> -->
    <script src="../../js/changeTheme/theme.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./../../js/aspAdmision/ajax-script.js"></script>
    <!-- SCRIPT DE LAS FUNCIONES DE ADMINISTRADOR-->
    <script src="../../js/notificaciones/actions-admin.js"></script>
</body>

</html>