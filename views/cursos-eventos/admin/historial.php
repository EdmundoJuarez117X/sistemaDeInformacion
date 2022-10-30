<?php
session_start();
if (empty($_SESSION["id_persona"])) {
    header("location:../../../index.php");
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
            <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
            
            <!-- FOR NAVBAR SUBMENUS -->
            <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        
            <title>Historial de cursos</title>
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
                            <li class="">
                                <a class="" href="../../dashboard/inicio.php">
                                    <span class="material-icons-sharp">grid_view</span>
                                    <h3>Dashboard</h3>
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
                                </ul>
                            </li>
                            <li class="active">
                                <a class="dropdown-toggleCursos" href="#">
                                    <span class="material-icons-sharp">import_contacts</span>
                                    <h3>Cursos</h3>
                                    <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menuCursos">
                                    <li>
                                        <a class="dropdown-item" href="nuevo-curso.php">
                                            <span class="material-icons-sharp">add</span>
                                            <h3>Nuego Curso</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="material-icons-sharp">history</span>
                                            <h3>Historial</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="reporte.php">
                                            <span class="material-icons-sharp">report</span>
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
                                <a class="" href="../../panelSeg/segAsp.php">
                                    <span class="material-icons-sharp">admin_panel_settings</span>
                                    <h3>Panel de Seguimiento</h3>
                                </a>
                            </li>
                            <li class="CloseSession">
                                <a href="../../../controllers/controller_logout.php">
                                    <span class="material-icons-sharp">logout</span>
                                    <h3>Cerrar Sesión</h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END OF SIDEBAR / NAVBAR -->
                </aside>
                <!------------------- END OF ASIDE ---------------->
                <main>
                    <h1>Historial</h1>
                    <p>Oprima sobre el nombre del curso para ver la información completa u oprima sobre
                        el total de accesos registrados para ver los usuarios.
                    </p>
                    <!--------------------- END OF INSIGHTS ---------------------->
                    <!--------------------- HISTORIAL ---------------------->
                    <!--<button id="showData" class="btnSeg">Mostrar todos los cursos</button>-->
                    <div class="insights-table">
                            <table class="table-fixed">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Accesos <br> totales</th>
                                        <th>Accesos <br> registrados</th>
                                        <th>Costo <br> unitario</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th>Activar<br>Desactivar</th>
                                    </tr>
                                </thead>
                                <tbody id="table-container">
                                    <?php require_once '../../../controllers/ajax/cursos-eventos/show-datas-table.php' ?>
                                </tbody>
                            </table>
                    </div>
                    <!--------------------- FIN HISTORIAL ---------------------->
                </main>
                <!---------------------------- END OF MAIN ------------------->
                <div class="right">
                    <div class="top">
                        <button id="menu-btn">
                            <span class="material-icons-sharp">menu</span>
                        </button>
                        <div class="theme-toggler">
                            <span class="material-icons-sharp active">light_mode</span>
                            <span class="material-icons-sharp">dark_mode</span>
                        </div>
                        <div class="profile">
                            <div class="info">
                                <p>Hola, <b>
                                <?php echo '' . $_SESSION["nombre_persona"] . " " . $_SESSION["apellido_paterno"] . ''; ?>
                                    </b></p>
                                <small class="text-muted">Admin</small>
                            </div>
                            <div class="profile-photo">
                                <img src="../../../img/altindeximages/avatar.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <!------------------------------- END OF top / top ------------------------>
                    <div class="recent-updates">
                        <h2>Actualizaciones Recientes</h2>
                        <div class="updates">
                            <div class="update">
                                <div class="profile-photo">
                                    <img src="../../../img/altindeximages/welcoming.svg" alt="">
                                </div>
                                <div class="message">
                                    <p><b>Myke Tyson</b> Received his order of
                                        Night lion tech GPS drone.</p>
                                    <small class="text-muted">2 Minutes Ago</small>
                                </div>
                            </div>
                            <div class="update">
                                <div class="profile-photo">
                                    <img src="../../../img/altindeximages/teaching.svg" alt="">
                                </div>
                                <div class="message">
                                    <p><b>Myke Tyson</b> Received his order of
                                        Night lion tech GPS drone.</p>
                                    <small class="text-muted">2 Minutes Ago</small>
                                </div>
                            </div>
                            <div class="update">
                                <div class="profile-photo">
                                    <img src="../../../img/altindeximages/undraw_page_not_found_re_e9o6.svg" alt="">
                                </div>
                                <div class="message">
                                    <p><b>Myke Tyson</b> Received his order of
                                        Night lion tech GPS drone.</p>
                                    <small class="text-muted">2 Minutes Ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Script for navbar arrows and show the elements -->
            <script>
                $('.dropdown-toggle').click(function(){
                    $('aside .sidebar ul .dropdown-menu').toggleClass("show");
                    $('aside .sidebar ul .first-arrow').toggleClass("rotate");
                });
                $('aside .sidebar ul li').click(function(){
                    $(this).addClass("active").siblings().removeClass("active");
                });
            </script>
            <script>
                $('.dropdown-toggleCursos').click(function() {
                    $('aside .sidebar ul .dropdown-menuCursos').toggleClass("show");
                    $('aside .sidebar ul .second-arrow').toggleClass("show");
                });
                $('aside .sidebar ul li').click(function() {
                        $(this).addClass("active").siblings().removeClass("active");
                    });
            </script>
            <!-- SCRIPT JS -->
            <script src="../../../js/dashboard/inicio.js"></script>
        </body>
    </html>