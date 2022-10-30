<?php
    session_start();
    if (empty($_SESSION["id_persona"])) {
        header("location:../../index.php");
    }

    // obtenenmos el periodo que se seleccionó
    if(htmlspecialchars($_GET["pdo"]) == "op1") {
        $pdo = "Último mes";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op2") {
        $pdo = "Últimos seis  meses";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op3") {
        $pdo = "Último año";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op4") {
        $pdo = htmlspecialchars($_GET["fchaI"]). " a ". htmlspecialchars($_GET["fchaF"]);
    }

    // inicio del objeto para guadar el contenido HTML en memoria
    ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">-->
    <title>Reporte de cursos <?= $pdo ?></title>
</head>
<style>
    body {
        font-family: 'poppins', sans-serif;
    }
    h2{
        color: #000;
        font-weight: bolder;
        font-size: 19px;
        margin-bottom: -10px;
    }
    p {
        font-size: 13px;
    }
    .container-info-pdf .primary {
        color: #47ABE2;
    }
    .container-info-pdf {
        margin: auto;
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    .container-info-pdf .separator {
        width:100%;
        height: 1px;
        background: rgb(190, 190, 190);
        margin-top: 30px;
    }
    .container-info-pdf .text-about-course h1 {
        font-size: 35px;
        margin-bottom: -10px;
    }
    .container-info-pdf .text-about-course p {
        font-size: 13px;
    }
    .container-info-course {
        width: 97%;
        margin: auto;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 12px;
        background: #eee;
    }
    .container-reportes-cursos .p-courses-info {
        font-size: 18px;
        font-weight: bold;
    }
    .container-reportes-cursos .p-resume-course {
        font-size:18px;
        font-weight: bold;
    }
    .container-info-course .p-name-course-info {
        text-align: center;
        font-size: 16px;
    }
    .container-info-course .first-middle {
        width: 50%;
        float: left;
        text-align: left;
    }
    .container-info-course .second-middle {
        width: 50%;
        float: left;
        text-align: right;
    }
    .container-info-course .p-description-course-info {
        text-align: justify;
    }
</style>
<body>
    <div class="container-info-pdf">
        <h2>SIS<span class="primary">ESCOLAR</span></h2>
            <div class="text-about-course">
                <p><?= date('y-m-d'); ?></p>
                <h1> Reporte de cursos</h1>
                <p> <?= $pdo ?> </p>
            </div>
            <div class="separator"></div>
            <div class='container-reportes-cursos'>
                <div class='fields-middle third-middle'>
                    <p class='p-resume-course'>RESUMEN</p>
                    <p>Cursos activos: <strong> 8 </strong></p>
                    <p>Cursos finalizados: <strong> 10 </strong></p>
                    <p>Cursos cancelados: <strong> 3 </strong></p>
                </div>
                <div class="separator"></div>
                <!-- ======================== CONTENEDOR DE CURSOS ACTIVOS ======================= -->
                <div>
                    <p class='p-courses-info'>CURSOS ACTIVOS</p>
                </div>
                <div class='container-info-course'>
                    <p class='p-name-course-info'> <strong> Curso de Verano </strong></p>

                    <div class='first-middle'>
                        <p class='first-date-info'>
                            <strong>Inicia:</strong> 25/12/2022
                        </p>
                    </div>
                    <div class='second-middle'>
                        <p class='second-date-info'>
                            <strong>Finaliza:</strong> 01/01/2023
                        </p>
                    </div>

                    <p class='p-description-course-info'><strong>Descripción:</strong>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <p class='p-description-course-info'><strong>Requisitos:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>

                    <p class='p-description-course-info'><strong>Responsables:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>
                    
                    <p class='p-description-course-info first-data'><strong>Curso exclusivamente para:</strong> Alumnos</p>
                    <p class='p-description-course-info second-data'><strong>Estado del curso:</strong> activo</p>
                    <p class='p-description-course-info'><strong>Cantidad de participantes:</strong> 32</p>
                    <p class='p-description-course-info'><strong>Paticipantes registrados:</strong> 30</p>
                    <p class='p-description-course-info'><strong>Costo unitario (MXN):</strong> $32.50</p>
                    <p class='p-description-course-info'><strong>Monto generado (MXN):</strong> $975.00</p>
                </div>
            <div class="separator"></div>
                <!-- ======================== CONTENEDOR DE CURSOS INACTIVOS ======================= -->
                <div>
                    <p class='p-courses-info'>CURSOS FINALIZADOS</p>
                </div>
                <div class='container-info-course'>
                    <p class='p-name-course-info'> <strong> Curso de Verano </strong></p>

                    <div class='first-middle'>
                        <p class='first-date-info'>
                            <strong>Inicia:</strong> 25/12/2022
                        </p>
                    </div>
                    <div class='second-middle'>
                        <p class='second-date-info'>
                            <strong>Finaliza:</strong> 01/01/2023
                        </p>
                    </div>

                    <p class='p-description-course-info'><strong>Descripción:</strong>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <p class='p-description-course-info'><strong>Requisitos:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>

                    <p class='p-description-course-info'><strong>Responsables:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>
                    
                    <p class='p-description-course-info first-data'><strong>Curso exclusivamente para:</strong> Alumnos</p>
                    <p class='p-description-course-info second-data'><strong>Estado del curso:</strong> Inactivo</p>
                    <p class='p-description-course-info'><strong>Cantidad de participantes:</strong> 32</p>
                    <p class='p-description-course-info'><strong>Paticipantes registrados:</strong> 30</p>
                    <p class='p-description-course-info'><strong>Costo unitario (MXN):</strong> $32.50</p>
                    <p class='p-description-course-info'><strong>Monto generado (MXN):</strong> $975.00</p>
                </div>
            <div class="separator"></div>
                <!-- ======================== CONTENEDOR DE CURSOS CANCELADOS ======================= -->
                <div>
                    <p class='p-courses-info'>CURSOS CANCELADOS</p>
                </div>
                <div class='container-info-course'>
                    <p class='p-name-course-info'> <strong> Curso de Verano </strong></p>

                    <div class='first-middle'>
                        <p class='first-date-info'>
                            <strong>Inicia:</strong> 25/12/2022
                        </p>
                    </div>
                    <div class='second-middle'>
                        <p class='second-date-info'>
                            <strong>Finaliza:</strong> 01/01/2023
                        </p>
                    </div>

                    <p class='p-description-course-info'><strong>Descripción:</strong>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <p class='p-description-course-info'><strong>Requisitos:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>

                    <p class='p-description-course-info'><strong>Responsables:</strong>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua.
                    </p>
                    
                    <p class='p-description-course-info first-data'><strong>Curso exclusivamente para:</strong> Alumnos</p>
                    <p class='p-description-course-info second-data'><strong>Estado del curso:</strong> Cancelado</p>
                    <p class='p-description-course-info'><strong>Cantidad de participantes:</strong> 32</p>
                    <p class='p-description-course-info'><strong>Paticipantes registrados:</strong> 30</p>
                    <p class='p-description-course-info'><strong>Costo unitario (MXN):</strong> $32.50</p>
                    <p class='p-description-course-info'><strong>Monto generado (MXN):</strong> $975.00</p>
                </div>
            </div>
    </div>
</body>
</html>
<?php
    // cierre de objeto
    $html = ob_get_clean();
    // requerimos el archivo autoload de la librería de DOMPDF
    require_once '../../lib/DOMPDF/vendor/autoload.php';
    
    // referencia al espacio de nombres Dompdf
    use Dompdf\Dompdf;
    // instanciamos y usamos la clase de DOMPDF
    $dompdf = new Dompdf();

    // en caso de imprimir imágenes, habilitar el siguiente código
    /*$options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);*/

    // asignamos el html en memoria para convertirlo en PDF
    $dompdf->loadHtml($html);

    /* --------- Configurar el tamaño y la orientación del papel ----------- */
    // lo guardamos para mostrarlo verticalmente
    $dompdf->setPaper('letter');
    //$dompdf->setPaper('A4', 'landscape');  // ---> funcional para documentos horizontales

    // Renderizar el HTML como PDF
    $dompdf->render();

    // Salida del PDF generado al navegador
    $dompdf->stream("reporte_cursos_".$pdo.".pdf", array("Attachment" => false)); // --> si  no requiere abrir otra pestaña y descargarlo automáticamente, remplazar el false por true


?>