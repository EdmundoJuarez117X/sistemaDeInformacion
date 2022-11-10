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
        
            <title>Cursos</title>
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
                                <a class="" href="../../stripeInscrip/public/checkout.php">
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
                    <h1>Cursos</h1>
                    <div class="courses-catalogue">
                        <div class="my-courses">
                            <?php require_once '../../../controllers/ajax/cursos-eventos/users/mostrar-cursos.php' ?>
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
                    <div class="recent-updates">
                        <h2>Tus cursos</h2>
                        <div class="updates container-my-courses">
                            <div class="my-courses">
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                                <a href="">
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
                                </a>
                            </div>
                        </div>
                        <!--<div class="container-my-courses">
                            <div class="my-courses">
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
                        </div>-->
                    </div>
                    <!------------------------------- END OF top / top ------------------------>
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