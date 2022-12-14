<?php
session_start();
if (empty($_SESSION["subMat"]) or $_SESSION["subMat"] == "PF" or $_SESSION["subMat"] == "ASP" or $_SESSION["subMat"] == "DOC") {
    header("location:./../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="../../styles/css/panelSeg/segAsp.css">
    <!-- shorcut icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./../../img/loginImages/EducationSchool.svg" />
    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Seguimiento de Aspirantes</title>


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
                    <!-- NAV BAR WITH ROL CONTROL -->
                    <?php
                    if ($_SESSION["subMat"] == "ADM") {
                        echo '
                            <li class="">
                                <a class="" href="./../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>
                            <!--<li class="">
                                <a class="" href="../stripeInscrip/public/checkout.php">
                                    <span class="material-icons-sharp">person</span>
                                    <h3>Inscripciones</h3>
                                </a>
                            </li>-->
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
                                    <h3>Cerrar Sesi??n</h3>
                                </a>
                            </li>
                            ';
                    } else if ($_SESSION["subMat"] == "MST") {
                        echo '
                            <li class="">
                                <a class="" href="./../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
                                </a>
                            </li>

                           <!-- <li class="">
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
                            </li>-->

                            <li class="">
                                <a class="dropdown-toggle" href="#">
                                <span class="material-icons-sharp">add</span>
                                    <h3>Personal</h3>
                                    <span class="material-icons-sharp arrow_down first-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="./../dashboard/admmst/createAdm.php">
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
                            <li class="active">
                                <a class="" href="#">
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
                </ul>
            </div>
            <!-- END OF SIDEBAR / NAVBAR -->
        </aside>
        <!------------------- END OF ASIDE ---------------->
        <main>
            <h1>Panel de Seguimiento</h1>
            <!--------------------- END OF INSIGHTS ---------------------->
            <button id="showData" class="btnSeg">Mostrar a todos los Aspirantes</button>
            <div id="table-container" class="recent-orders">
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
                        <p>Hola,
                            <b>
                                <?php
                                if ($_SESSION["subMat"] == "ADM") {
                                    echo '' . $_SESSION["nombre_admin"] . " " . $_SESSION["apellido_paternoAdmin"] . '';
                                } elseif ($_SESSION["subMat"] == "MST") {
                                    echo '' . $_SESSION["nombre_master"] . " " . $_SESSION["apellido_paternoMaster"] . '';
                                } else {
                                    echo 'Rol Desconocido';
                                }
                                ?>
                            </b>
                        </p>
                        <small class="text-muted">
                            <?php
                            if ($_SESSION["subMat"] == "ADM") {
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
            <div class="recent-updates">

                <!-- <h2>Actualizaciones Recientes</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./../../img/altindeximages/welcoming.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./../../img/altindeximages/teaching.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./../../img/altindeximages/undraw_page_not_found_re_e9o6.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- END OF RECENT UPDATES -->
            <div class="sales-analytics">
                <!-- <h2>Metricas de Ventas</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Pedidos en l??nea</h3>
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
                            <h3>Pedidos presenciales</h3>
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
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>

    <!-- SCRIPT JS -->
    <script src="../../js/dashboard/inicio.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="./../../js/segAsp/ajax-script.js"></script>
</body>

</html>