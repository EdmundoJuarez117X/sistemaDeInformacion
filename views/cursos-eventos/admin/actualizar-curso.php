<?php

    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }

    $cso = $_GET['cso'];
    include('../../../model/connection.php');
    $db = $connection;
    $query = "SELECT * FROM cursos WHERE cursos.id_curso = $cso;";
    $datas = $db->query($query);
    $curso = $datas->fetch_assoc();
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
        
            <title>Actualizar Curso</title>
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
                    <h1>Actualizar Curso</h1>
                    <form action="" method="">
                        <div class="insights-form">
                            <div class="sales-form">
                                <span class="material-icons-sharp">update</span>
                                <h1>Edita los campos y guarda los cambios</h1>
                                <p>Nombre:
                                    <div><input type="text" id="course_name" value="<?=$curso['nombre_curso']?>" required></div>
                                    <div><input type="text" id="id_course" class="input-id-curso" value="<?=$curso['id_curso']?>" required style="display:none"></div>
                                </p>
                                <p>Descripción:
                                    <textarea id="course_description" cols="30" rows="10" required><?=$curso['descripcion_curso']?></textarea>
                                </p>
                                <div class="fields-middle first-middle">
                                    <p>Requisitos:
                                        <textarea id="course_requirements" cols="30" rows="10" required><?=$curso['requisitos_curso']?></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Responsables:
                                        <textarea id="course_responsible" cols="30" rows="10" required><?=$curso['responsables_curso']?></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Cantidad de participantes:
                                        <input type="number" id="total_participantes" value="<?=$curso['total_participantes']?>" min="<?=$curso['participantes_registrados']?>" required>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Participantes registrados (<a target="__blank" href="../../archivos-pdf-php/<?=$curso['rol_dirigido']?>s-registrados-pdf.php?cso='<?= $curso["id_curso"] ?>'">VER</a>):
                                        <input type="text" id="participantes_registrados" value="<?=$curso['participantes_registrados']?>" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Costo unitario (MXN):
                                        <input type="number" id="costo_unitario" value="<?=$curso['costo_unitario']?>" min="<?php if($curso['participantes_registrados'] > 0) {echo $curso['costo_unitario']; } 
                                        else { echo 10; } ?>" step=".05" <?php if($curso['participantes_registrados'] > 0){echo "readonly";} ?>>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Curso para:
                                        <select id="select_user" required>
                                            <option value="<?=$curso['rol_dirigido']?>" select><?=$curso['rol_dirigido']?></option>
                                            <option value="docente">Docente</option>
                                            <option value="alumno">Alumno</option>
                                          </select>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Inicia el:
                                        <div class="date">
                                            <input type="date" id="date_initial" value="<?=$curso['fecha_inicio_curso']?>" required>
                                        </div>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Finaliza el:
                                        <div class="date">
                                            <input type="date" id="date_end" value="<?=$curso['fecha_fin_curso']?>" required>
                                        </div>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Estado del curso:
                                        <select id="select_status" required>
                                        <option value="<?=$curso['estatus_curso']?>" select><?=$curso['estatus_curso']?></option>
                                            <option value="activo">activo</option>
                                            <option value="inactivo">inactivo</option>
                                          </select>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Portada: <br><br>
                                    <a href="portada-curso.php?cso=<?= $cso ?>">VER PORTADA ACTUAL</a>
                                    </p>    
                                </div>

                                <button type="button" class="btn-action-form" id="btn-save-changes">GUARDAR</button>
                                
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
                    <!-- END OF RECENT UPDATES -->
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="../../../js/cursos-eventos/admin/actions-admin.js"></script>
        </body>
    </html>