<?php
session_start();
if (empty($_SESSION["id_persona"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS STYLESHEET-->
    <link rel="stylesheet" href="styles/css/dashstyle.css">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>Responsive Dashboard Using HTML CSS and Javascript</title>


</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <!-- <img src="img/dashimgs/graduation.svg" alt="logotype"> -->
                    <span class="material-icons-sharp logo">school</span>
                    <h2>SIS<span class="primary">ESCOLAR</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="#" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" class="">
                    <span class="material-icons-sharp">person</span>
                    <h3>Clientes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Ordenes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">message</span>
                    <h3>Mensajes</h3>
                    <span class="message-count">26</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Productos</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">report</span>
                    <h3>Reportes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Ajustes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">add</span>
                    <h3>Agregar Producto</h3>
                </a>
                <!-- <div>
                    <a class="nav-item nav-link text-justify ml-3 hover-primary" href="controllers/controller_logout.php">Cerrar Sesión</a>
                </div> -->
                <a href="controllers/controller_logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Cerrar Sesión</h3>
                </a>
            </div>
        </aside>
        <!------------------- END OF ASIDE ---------------->
        <main>
            <?php
            echo '<h1>' . $_SESSION["nombre_persona"] . " " . $_SESSION["apellido_paterno"] . '</h1>';
            ?>
            <!-- <h1>Dashboard</h1> -->
            <div class="date">
                <input type="date">
            </div>
            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales</h3>
                            <h1>$36,936</h1>
                        </div>
                        <div class="progress">
                            <svg>
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
                    <span class="material-icons-sharp">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>$3,141.6</h1>
                        </div>
                        <div class="progress">
                            <svg>
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
                    <span class="material-icons-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>$33,369</h1>
                        </div>
                        <div class="progress">
                            <svg>
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
            <div class="recent-order">
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>