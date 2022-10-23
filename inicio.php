<!-- <?php
        session_start();
        if (empty($_SESSION["id_persona"])) {
            header("location:index.php");
        }
        ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="styles/css/dashstyle.css">
    
    <!-- FOR NAVBAR SUBMENUS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <title>Responsive Dashboard Using HTML CSS and Javascript</title>


</head>

<body>
    <div class="contenedor">
        <aside>
            <!-- LOGOTYPE DIV -->
            <div class="topClass">
                <div class="logo">
                    <!-- <img src="img/dashimgs/graduation.svg" alt="logotype"> -->
                    <span class="material-icons-sharp logo">school</span>
                    <h2>SIS<span class="primary">ESCOLAR</span></h2>
                </div>
                <div class="closeClassBtn" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <!-- END OF LOGOTYPE DIV -->
            <!-- SIDEBAR / NAVBAR CODE -->
            <div class="sidebar">
                <ul class="">
                    <li class="active">
                        <a class="" href="#">
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
                    <li class="CloseSession">
                        <a href="controllers/controller_logout.php">
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
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date">
            </div>
            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">people</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Alumnos</h3>
                            <h1>3600</h1>
                        </div>
                        <div class="progress">
                            <svg class="svgCircle">
                                <circle cx='38' cy="38" r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
                <!----------------------- END OF SALES ------------------->
                <div class="expenses">
                    <span class="material-icons-sharp">people</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Docentes</h3>
                            <h1>300</h1>
                        </div>
                        <div class="progress">
                            <svg class="svgCircle">
                                <circle cx='38' cy="38" r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>16%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
                <!----------------------- END OF EXPENSES ------------------->
                <div class="income">
                    <span class="material-icons-sharp">family_restroom</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Padres de Familia</h3>
                            <h1>1369</h1>
                        </div>
                        <div class="progress">
                            <svg class="svgCircle">
                                <circle cx='38' cy="38" r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
                <!----------------------- END OF INCOME ------------------->
            </div>
            <!--------------------- END OF INSIGHTS ---------------------->
            <div class="recent-orders">
                <h2>Recent Oders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Foldable Mini Drone</td>
                            <td>8564</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Foldable Mini Drone</td>
                            <td>8564</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Foldable Mini Drone</td>
                            <td>8564</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Foldable Mini Drone</td>
                            <td>8564</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>Foldable Mini Drone</td>
                            <td>8564</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="">Show All</a>
            </div>
        </main>
        <!---------------------------- END OF MAIN ------------------->

        <div class="right">
            <div class="topClass">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>
                                <!-- <?php echo '<h1>' . $_SESSION["nombre_persona"] . " " . $_SESSION["apellido_paterno"] . '</h1>'; ?> -->
                            </b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./img/altindeximages/avatar.svg" alt="">
                    </div>
                </div>
            </div>
            <!------------------------------- END OF top / topClass ------------------------>
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./img/altindeximages/welcoming.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./img/altindeximages/teaching.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./img/altindeximages/undraw_page_not_found_re_e9o6.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./img/altindeximages/welcoming.svg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Myke Tyson</b> Received his order of
                                Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./img/altindeximages/avatar.svg" alt="">
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
</body>
</html>