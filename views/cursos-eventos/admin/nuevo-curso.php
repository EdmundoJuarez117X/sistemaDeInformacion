<?php

session_start();
if (empty($_SESSION["subMat"])) {
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
            <link rel="shortcut icon" type="image/x-icon" href="../../../img/loginImages/EducationSchool.svg" />
            
            <!-- FOR NAVBAR SUBMENUS -->
            <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        
            <title>Nuevo Curso</title>
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
                            <?php
                                if ($_SESSION["subMat"]=="ADM" or $_SESSION["subMat"] == "MST") {
                                    echo '
                                    <li class="">
                                        <a class="" href="../../dashboard/inicio.php">
                                            <span class="material-icons-sharp">grid_view</span>
                                            <h3>Dashboard</h3>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a class="dropdown-toggleCursos" href="#">
                                            <span class="material-icons-sharp">import_contacts</span>
                                            <h3>Cursos</h3>
                                            <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                        </a>
                                        <ul class="dropdown-menuCursos">
                                            <li>
                                                <a class="dropdown-item">
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
                                                    <span class="material-icons-sharp">receipt_long</span>
                                                    <h3>Reportes</h3>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="compras.php">
                                                    <span class="material-icons-sharp">paid</span>
                                                    <h3>Compras</h3>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="actividad.php">
                                                    <span class="material-icons-sharp">trending_up</span>
                                                    <h3>Actividad</h3>
                                                </a>
                                            </li>
                                        </ul>
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
                    <h1>Registrar Curso</h1>
                    <form action="../../../controllers/ajax/cursos-eventos/admin/registrar-curso.php" method="POST">
                        <div class="insights-form">
                            <div class="sales-form">
                                <span class="material-icons-sharp">post_add</span>
                                <h1>Completa el formulario y registra</h1>
                                <p>Nombre:
                                    <div><input type="text" id="course_name" required></div>
                                </p>
                                <p>Descripci??n:
                                    <textarea id="course_description" cols="30" rows="10" required></textarea>
                                </p>
                                <div class="fields-middle first-middle">
                                    <p>Requisitos:
                                        <textarea id="course_requirements" cols="30" rows="10" required></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Responsables:
                                        <textarea id="course_responsible" cols="30" rows="10" required></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Cantidad de participantes:
                                        <input type="number" id="total_participantes" placeholder="0" min="0" required>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Paticipantes registrados:
                                        <input type="text" placeholder="Campo no v??lido" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Costo unitario (MXN):
                                        <input type="number" id="costo_unitario" placeholder="m??nimo 10.00" min="10" step=".05" required>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Curso para:
                                        <select id="select_user" required>
                                            <option value="docente">Docente</option>
                                            <option value="alumno" selected>Alumno</option>
                                          </select>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Inicia el:
                                        <div class="date">
                                            <input type="date" id="date_initial" required>
                                        </div>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Finaliza el:
                                        <div class="date">
                                            <input type="date" id="date_end" required>
                                        </div>
                                    </p>
                                </div>
                                <div>
                                    <p>Estado del curso:
                                        <select id="select_status" required>
                                            <option value="activo" selected>activo</option>
                                          </select>
                                    </p>
                                </div>
                                
                                <input type="button" id="btn-register-course" class="btn-action-form" value="REGISTRAR">
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
                                    if($_SESSION["subMat"]=="ASP"){
                                        echo '' . $_SESSION["nombre_aspirante"] . " " . $_SESSION["apellido_paternoAspirante"] . '';
                                    }elseif($_SESSION["subMat"] == "Al"){
                                        echo '' . $_SESSION["nombre_alumno"] . " " . $_SESSION["apellido_paternoAlumno"] . '';
                                    }elseif($_SESSION["subMat"] == "PF"){
                                        echo '' . $_SESSION["nombre_padreDeFam"] . " " . $_SESSION["apellido_paternopadreDeFam"] . '';
                                    }elseif($_SESSION["subMat"] == "DOC"){
                                        echo '' . $_SESSION["nombre_docente"] . " " . $_SESSION["apellido_paternoDocente"] . '';
                                    }elseif($_SESSION["subMat"] == "ADM"){
                                        echo '' . $_SESSION["nombre_admin"] . " " . $_SESSION["apellido_paternoAdmin"] . '';
                                    }elseif($_SESSION["subMat"] == "MST"){
                                        echo '' . $_SESSION["nombre_master"] . " " . $_SESSION["apellido_paternoMaster"] . '';
                                    }else{
                                        echo 'Rol Desconocido';
                                    }
                                    ?>
                                </b></p>
                                <small class="text-muted">
                                    <?php 
                                        if($_SESSION["subMat"]=="ASP"){
                                            echo 'Aspirante';
                                        }elseif($_SESSION["subMat"] == "Al"){
                                            echo 'Alumno';
                                        }elseif($_SESSION["subMat"] == "PF"){
                                            echo 'Padre de Fam';
                                        }elseif($_SESSION["subMat"] == "DOC"){
                                            echo 'Docente';
                                        }elseif($_SESSION["subMat"] == "ADM"){
                                            echo 'Administrador';
                                        }elseif($_SESSION["subMat"] == "MST"){
                                            echo 'MASTER';
                                        }else{
                                            echo 'Rol Desconocido';
                                        }
                                    ?>
                                </small>
                            </div>
                            <div class="profile-photo">
                                <img src="../../../img/altindeximages/avatar.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <!------------------------------- END OF top / top ------------------------>
                    <div class="recent-updates notify-section">
                        <h2>Notificaciones</h2>
                            <div class="info-noticaciones-cursos" id="notificaciones-de-cursos">
                            </div>
                    </div> 
                </div>
            </div>
            <!-- Script for navbar arrows and show the elements -->
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
            <!-- SCRIPT DE AJAX -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <!-- SCRIPT DE SWEET ALERT -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- SCRIPT DE LAS FUNCIONES DE ADMINISTRADOR-->
            <script src="../../../js/cursos-eventos/admin/actions-admin.js"></script>
        </body>
    </html>