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
    if($datas->num_rows > 0) {
        while($curso = $datas->fetch_assoc()) {
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
                            <?php
                                if ($_SESSION["subMat"] == "ASP" or $_SESSION["subMat"]=="DOC" or $_SESSION["subMat"] == "Al") {
                                    echo '
                                    <li class="active">
                                        <a class="" href="inicio.php">
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
                                }else if($_SESSION["subMat"] == "PF"){
                                    echo '
                                    <li class="active">
                                        <a class="" href="inicio.php">
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
                                }
                                else{
                                    echo '
                                    <li class="">
                                        <a class="" href="../../dashboard/inicio.php">
                                            <span class="material-icons-sharp">grid_view</span>
                                            <h3>Dashboard</h3>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a class="" href="../../stripeInscrip/public/checkout.php">
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
                                    ';
                                }
                            ?>
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
                                <h1><?=$curso['nombre_curso']?></h1>
                                <p>Nombre:
                                    <div><input type="text" value="<?=$curso['nombre_curso']?>" readonly></div>
                                </p>
                                <p>Descripción:
                                    <textarea cols="30" rows="10" readonly><?=$curso['descripcion_curso']?></textarea>
                                </p>
                                <div class="fields-middle first-middle">
                                    <p>Requisitos:
                                        <textarea cols="30" rows="10" readonly><?=$curso['requisitos_curso']?></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Responsables:
                                        <textarea cols="30" rows="10" readonly><?=$curso['responsables_curso']?></textarea>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Cantidad de participantes:
                                        <input type="number" value="<?=$curso['total_participantes']?>" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Participantes registrados (<a target="__blank" href="../../archivos-pdf-php/<?=$curso['rol_dirigido']?>s-registrados-pdf.php?cso='<?= $curso["id_curso"] ?>'">VER</a>):
                                        <input type="number" value="<?=$curso['participantes_registrados']?>" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Costo unitario (MXN):
                                        <input type="text" value="$<?=$curso['costo_unitario']?>" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Curso para:
                                        <input type="text" value="<?=$curso['rol_dirigido']?>" readonly>
                                    </p>
                                </div>
                                <div class="fields-middle first-middle">
                                    <p>Inicia el:
                                        <div class="date">
                                            <input type="date" value="<?=$curso['fecha_inicio_curso']?>" readonly>
                                        </div>
                                    </p>
                                </div>
                                <div class="fields-middle second-middle">
                                    <p>Finaliza el:
                                        <div class="date">
                                            <input type="date" value="<?=$curso['fecha_fin_curso']?>" readonly>
                                        </div>
                                    </p>
                                </div>
                                <p>Estado del curso:
                                    <div><input type="text" value="<?=$curso['estatus_curso']?>" readonly></div>
                                </p>
                                <div class="fields-middle third-middle">
                                    <p>
                                        <a href="portada-curso.php?cso=<?= $cso ?>" target="_blank">VER PORTADA</a>
                                    </p>
                                </div>
                                <button class="btn-action-form"> <a href="actualizar-curso.php?cso='<?=$curso["id_curso"]?>'">EDITAR</a></button>
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
                        <div class="updates" id="notificaciones-de-cursos">
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
<?php
        }
    }
?>