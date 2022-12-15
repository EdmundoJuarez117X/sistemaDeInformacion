<?php

    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }
    require_once "../../../model/connection.php";
    $db = $connection;

    $id = $_GET['id'];
    
    if($_SESSION['subMat'] == "Al") {
        $id_user = $_SESSION['id_alumno'];
        $result = $db->query("SELECT * FROM alumno_curso INNER JOIN cursos 
        ON alumno_curso.id_curso = cursos.id_curso WHERE alumno_curso.id_alumno_curso = '$id'");

        if(!$result) {
            die("Error al obtener curso. Error: ". mysqli_error($db));
        }
        $curso = $result->fetch_assoc();

        $date = $curso['f_creacion_al_cur'];
        $idCompra =$curso['id_alumno_curso'];
        $user = "alumno";

    } else if($_SESSION['subMat'] == "DOC") {
        $id_user = $_SESSION['id_docente'];
        $result = $db->query("SELECT * FROM docente_curso INNER JOIN cursos 
        ON docente_curso.id_curso = cursos.id_curso WHERE docente_curso.id_docente_curso = '$id'");

        if(!$result) {
            die("Error al obtener curso. Error: ". mysqli_error($db));
        }
        $curso = $result->fetch_assoc();

        $date = $curso['f_creacion_doc_cur'];
        $idCompra =$curso['id_docente_curso'];
        $user = "docente";

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
                            <?php
                                if ($_SESSION["subMat"]=="DOC" or $_SESSION["subMat"] == "Al") {
                                    echo '
                                    <li class="">
                                        <a class="" href="../../dashboard/inicio.php">
                                            <span class="material-icons-sharp">grid_view</span>
                                            <h3>Dashboard</h3>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a class="dropdown-toggleCursos">
                                            <span class="material-icons-sharp">import_contacts</span>
                                            <h3>Cursos</h3>
                                            <span class="material-icons-sharp arrow_down second-arrow">keyboard_arrow_down</span>
                                        </a>
                                        <ul class="dropdown-menuCursos">
                                            <li>
                                                <a class="dropdown-item" href="cursos.php">
                                                    <span class="material-icons-sharp">import_contacts</span>
                                                    <h3>Cursos</h3>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="mis-cursos.php">
                                                    <span class="material-icons-sharp">history</span>
                                                    <h3>Mis cursos</h3>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="CloseSession">
                                        <a href="../../../controllers/controller_logout.php">
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
                    <h1>Acerca de...</h1>
                    <div class="courses-catalogue">
                        <div class="my-courses">
                            <div class="info-mis-cursos">
                                <h1><?= $curso['nombre_curso'] ?></h1>
                                <p class="descripcion-del-curso"><?= $curso['descripcion_curso']?></p>
                                <div class="left--section">
                                    <p><strong>Inicia: </strong><br><?= $curso['fecha_inicio_curso']?></p>
                                </div>
                                <div class="right--section">
                                    <p><strong>Finaliza: </strong><br><?= $curso['fecha_fin_curso']?></p>
                                </div>
                                <div class="left--section">
                                    <p><strong>Requisitos: </strong><br><?= $curso['requisitos_curso']?></p>
                                </div>
                                <div class="right--section">
                                    <p><strong>Responsables: </strong><br><?= $curso['responsables_curso']?></p>
                                </div>
                                <div class="left--section">
                                    <p><strong>Estado de curso: </strong><br><?= $curso['estatus_curso']?></p>
                                </div>
                                <div class="right--section">
                                    <p><strong>Fecha de pago: </strong><br><?= $date ?></p>
                                </div>
                                <div class="left--section">
                                    <p><strong>ID de pago: </strong><br><?= $idCompra ?></p>
                                </div>
                                <div class="right--section">
                                    <p><strong>Accesos comprados: </strong><br><?= $curso['cantidad_boletines']?></p>
                                </div>
                                <div class="left--section">
                                    <p><strong>Costo unitario: </strong><br>$<?= $curso['costo_unitario']?></p>
                                </div>
                                <div class="right--section">
                                    <p><strong>Descargar:</strong><br>
                                        <span class="material-icons-sharp" style="color:#47ABE2;font-weight:600;">download</span>
                                        <a style="color:#47ABE2;font-weight:600;" href="../../archivos-pdf-php/ticket-<?=$user?>.php?cra=<?= $idCompra ?>" target="_blank">TICKET</a>
                                    </p>
                                </div>
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
                    <div class="recent-updates">
                        <h2><a href="mis-cursos.php">Todos tus cursos</a></h2>
                        <div class="updates container-my-courses">
                            <div class="my-courses" id="my-courses-user"></div>
                        </div>
                    </div>
                    <!------------------------------- END OF top / top ------------------------>
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
            <script src="../../../js/cursos-eventos/user/actions-user.js"></script>
        </body>
    </html>