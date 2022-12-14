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

    <!-- CLASIC CSS STYLESHEET-->
    <!-- <link rel="stylesheet" href="../../../styles/css/dashstyle.css"> -->

    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/loginImages/EducationSchool.svg" />

    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Creación de Usuarios</title>
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
                    if ($_SESSION["subMat"] == "ADM" or $_SESSION["subMat"] == "MST") {
                        echo '
                                    <li class="">
                                        <a class="" href="../../dashboard/inicio.php">
                                            <span class="material-icons-sharp">grid_view</span>
                                            <h3>Dashboard</h3>
                                        </a>
                                    </li>
                                    
                                    <li class="active">
                                <a class="dropdown-toggle" href="#">
                                <span class="material-icons-sharp">add</span>
                                    <h3>Personal</h3>
                                    <span class="material-icons-sharp arrow_down first-arrow">keyboard_arrow_down</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="material-icons-sharp">people</span>
                                            <h3>Administradores</h3>
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
                                    <a class="dropdown-item" href="./../../cursos-eventos/admin/nuevo-curso.php">
                                        <span class="material-icons-sharp">add</span>
                                        <h3>Nuevo Curso</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./../../cursos-eventos/admin/historial.php">
                                        <span class="material-icons-sharp">history</span>
                                        <h3>Historial</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./../../cursos-eventos/admin/reporte.php">
                                        <span class="material-icons-sharp">receipt_long</span>
                                        <h3>Reportes</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./../../cursos-eventos/admin/compras.php">
                                        <span class="material-icons-sharp">paid</span>
                                        <h3>Compras</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./../../cursos-eventos/admin/actividad.php">
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
            <h1>Agregar Personal</h1>
            <form id="register_form" name="form1" method="post" class="sign-up-form">
                <div class="insights-form">
                    <div class="sales-form">
                        <h2 class="title">Datos de la persona</h2>

                        <div class="input-field">
                            <p>Primer Nombre:
                                <input type="text" id="nombre_persona" name="nombre_persona" required>
                            </p>
                        </div>
                        <div class="input-field">
                            <p>Apellido Paterno:
                                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                            </p>
                        </div>
                        <div class="input-field">
                            <p>Apellido Materno:
                                <input type="text" id="apellido_materno" name="apellido_materno" required>
                            </p>
                        </div>
                        <div class="input-field">
                            <p>Correo Electrónico
                                <input type="text" id="email" name="email"
                                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}"
                                    required>
                            </p>
                        </div>
                        <div class="input-field">
                            <p>Contraseña:
                                <i class="far fa-eye" id="togglePassword"
                                    style="margin-left: 10px;  cursor: pointer;">Mostrar/Ocultar</i>
                                <input style="
                                width: 100%;
                                border: 0.1rem solid;
                                height: 23px;
                                border-radius: 26px;
                                display: grid;" type="password" id="password" name="password" required>

                            </p>
                        </div>
                        <div class="input-field">
                            <p>Seleccionar un rol para el usuario:
                                <select class="input-field" id="mstadm" name="mstadm" required>
                                    <option value="">¿Master o Administrador?</option>
                                    <option value="master">Master</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </p>
                        </div>
                        <input type="submit" name="btn_registrar" value="Registrar" id="register"
                            class="btn-action-form">
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
                        <a href="./../../register/completeProfileDash.php">
                            <img src="../../../img/altindeximages/avatar.svg" alt="">
                        </a>
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
            $('aside .sidebar ul .second-arrow').toggleClass("show");
        });
        $('aside .sidebar ul li').click(function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>
    <!-- Script para registro -->
    <script src="./../../../js/register/regmastadm.js"></script>
    <!-- Gestion de contraseña para el formulario de registro -->
    <script>
        const togglePasswordSignUp = document.querySelector('#togglePassword');
        const passwordSignUp = document.querySelector('#password');
        togglePasswordSignUp.addEventListener('click', function (e) {
            // toggle the typtogglee attribute
            const type = passwordSignUp.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordSignUp.setAttribute('type', type);
            // toggle the eye slash icon
            // this.classList.add('fa-eye-slash');
        });
        $(document).ready(function () {

            $("#togglePassword").click(function () {

                if ($("#togglePassword").hasClass("far fa-eye")) {  //check the class
                    $("#togglePassword").removeClass("far fa-eye").addClass("fa fa-eye-slash");
                } else if ($("#togglePassword").hasClass("fa fa-eye-slash")) {
                    $("#togglePassword").removeClass("fa fa-eye-slash").addClass("far fa-eye");
                }

            });

        });
    </script>
    <!-- SCRIPT JS -->
    <script src="../../../js/dashboard/inicio.js"></script>
    <!-- SCRIPT DE AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- SCRIPT DE LAS FUNCIONES DE ADMINISTRADOR-->
    <script src="../../../js/cursos-eventos/admin/actions-admin.js"></script>
</body>

</html>