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
        
            <title>Acerca del curso</title>
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

                                    <!-- <li>
                                        <hr class="dropdown-divider">
                                    </li> -->

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
                                        <a class="dropdown-item" href="historial.php">
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
                    <h1>Acerca del curso...</h1>
                        <div class="insights-form">
                            <div class="sales-form">
                                <span class="material-icons-sharp">info</span>
                                <h1>Curso 1</h1>
                                <p>Nombre:
                                    <div><input type="text" value="Curso 1" readonly></div>
                                </p>
                                <p>Descripción:
                                    <textarea cols="30" rows="10" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut abore et dolore magna aliqua.
                                    </textarea>
                                </p>
                                <div class="fields-middle first-middle">
                                    <p>Requisitos:
                                        <textarea cols="30" rows="10" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </textarea>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Responsables:
                                        <textarea cols="30" rows="10" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </textarea>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Cantidad de participantes:
                                        <input type="text" value="10" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Participantes registrados (<a target="__blank" href="../../archivos-pdf-php/usuarios-registrados-pdf.php">VER</a>):
                                        <input type="text" value="5" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Costo unitario (MXN):
                                        <input type="text" value="$50.00" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Curso para:
                                        <input type="text" value="Alumnos" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Inicia el:
                                        <div class="date">
                                            <input type="date" value="14/01/2022" readonly>
                                        </div>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Finaliza el:
                                        <div class="date">
                                            <input type="date" value="16/02/2022" readonly>
                                        </div>
                                    </p>
                                </div>
                                <p>Estado del curso:
                                    <div><input type="text" value="Activo" readonly></div>
                                </p>
                                <div class="fields-middle third-middle">
                                    <p>
                                        <a href="https://cdn.pixabay.com/photo/2017/01/24/09/20/learn-2004905_960_720.png" target="_blank">VER PORTADA</a>
                                    </p>
                                </div>
                                <button class="btn-action-form"> <a href="actualizar-curso.php">EDITAR</a></button>
                            </div>
                        </div>
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
                    <!-- END OF RECENT UPDATES -->
                    <div class="sales-analytics">
                        <h2>Metricas de Ventas</h2>
                        <div class="item online">
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