<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../index.php");
    }
    require_once("../../model/connection.php");
    $db = $connection;
    // inicio del objeto para guadar el contenido HTML en memoria
    ob_start();

    // obtenemos la fecha actual
    $fecha_actual = date("y-m-d");
    // obtenenmos el periodo que se seleccionó
    if(htmlspecialchars($_GET["pdo"]) == "op1") {
        $pdo = "Último mes";
        // Generar la query de los cursos que se encuentren desde la fecha actual hasta el perido
        $periodo = date("y-m-d",strtotime($fecha_actual."- 1 month"));
        //$query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$periodo 00:00:00' AND '$fecha_actual 23:59:59';";
        $query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$periodo 00:00:00' AND '$fecha_actual 23:59:59';";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op2") {
        $pdo = "Últimos seis  meses";
        // Generar la query de los cursos que se encuentren desde la fecha actual hasta el perido
        $periodo = date("y-m-d",strtotime($fecha_actual."- 6 month"));
        $query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$periodo 00:00:00' AND '$fecha_actual 23:59:59';";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op3") {
        $pdo = "Último año";
        // Generar la query de los cursos que se encuentren desde la fecha actual hasta el perido
        $periodo = date("y-m-d",strtotime($fecha_actual."- 1 year"));
        $query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$periodo 00:00:00' AND '$fecha_actual 23:59:59';";
    }
    if(htmlspecialchars($_GET["pdo"]) == "op4") {
        $pdo = htmlspecialchars($_GET["fchaI"]). " a ". htmlspecialchars($_GET["fchaF"]);
        // obtenemos las fechas
        $dInitial = $_GET['fchaI'];
        $dFinal = $_GET["fchaF"];
        // query mediante fechas filtradas
        $query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$dInitial 00:00:00' AND '$dFinal 23:59:59';";
    }
    // ejecutar la query
    $response = $db->query($query);
    // se ha ejecutado?
    if(!$response) {
        die("No se pudo generar la consulta --->". mysqli_error($db));
    }
    // existen campos registrados?
    if($response->num_rows > 0) {
        $activos = 0; // almacena los cursos activos
        $inactivos = 0; // almacena los cursos inactivos
        $total = 0; // almacena el total de curso
        while($datas = $response->fetch_assoc()) {
            if($datas['estatus_curso'] == "activo") {
                $activos ++;
            } else if($datas['estatus_curso'] == "inactivo") {
                $inactivos ++;
            }
            $total ++;
        }
    }
    // ejeuctar para mostrar en contenedor
    $result = $db->query($query);
    // se ha ejecutado ?
    if(!$result) {
        die("Error de consulta --> ". mysqli_error($db));
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../../img/loginImages/EducationSchool.svg" />
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
        margin-bottom: 30px;
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
        background: #F9F9F9;
        margin-bottom: 20px;
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
                    <p>Cursos activos: <strong> <?= $activos ?> </strong></p>
                    <p>Cursos finalizados: <strong> <?= $inactivos ?> </strong></p>
                    <p>Cantidad de cursos: <strong> <?= $total ?> </strong></p>
                </div>
                <div class="separator"></div>
                <!-- ======================== CONTENEDOR DE CURSOS ACTIVOS ======================= -->
                <div>
                    <p class='p-courses-info'>CURSOS</p>
                </div>

                <?php
                //existen datos registrados?
                if($result->num_rows > 0) {
                    // imprime cada campo en...
                    while($data = $result->fetch_assoc()) {
                ?>

                <div class='container-info-course'>
                    <p class='p-name-course-info'> <strong> <?= $data['nombre_curso'] ?> </strong></p>

                    <div class='first-middle'>
                        <p class='first-date-info'>
                            <strong>Inicia:</strong> <?= $data['fecha_inicio_curso'] ?>
                        </p>
                    </div>
                    <div class='second-middle'>
                        <p class='second-date-info'>
                            <strong>Finaliza:</strong> <?= $data['fecha_fin_curso'] ?>
                        </p>
                    </div>

                    <p class='p-description-course-info'><strong>Descripción:</strong> <?= $data['descripcion_curso'] ?> </p>

                    <p class='p-description-course-info'><strong>Requisitos:</strong> <?= $data['requisitos_curso'] ?> </p>

                    <p class='p-description-course-info'><strong>Responsables:</strong> <?= $data['responsables_curso'] ?> </p>
                    
                    <p class='p-description-course-info first-data'><strong>Curso exclusivamente para:</strong> <?= $data['rol_dirigido'] ?> </p>
                    <p class='p-description-course-info second-data'><strong>Estado del curso:</strong> <?= $data['estatus_curso'] ?> </p>
                    <p class='p-description-course-info'><strong>Cantidad de participantes:</strong> <?= $data['total_participantes'] ?> </p>
                    <p class='p-description-course-info'><strong>Paticipantes registrados:</strong> <?= $data['participantes_registrados'] ?> </p>
                    <p class='p-description-course-info'><strong>Costo unitario (MXN):</strong> $<?= $data['costo_unitario'] ?> </p>
                    <p class='p-description-course-info'><strong>Monto generado (MXN):</strong> $<?= ($data['costo_unitario']) * ($data['participantes_registrados']) ?> </p>
                </div>
                
                <?php
                    }
                }
                ?>
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