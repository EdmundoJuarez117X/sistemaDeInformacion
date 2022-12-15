<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../index.php");
    }
    // inicio del objeto para guadar el contenido HTML en memoria
    ob_start();

    $cra = $_GET['cra'];
    require_once("../../model/connection.php");
    $db = $connection;

    $query = "SELECT * 
    FROM docente_curso INNER JOIN docente ON docente_curso.id_docente = docente.id_docente
    INNER JOIN cursos ON docente_curso.id_curso = cursos.id_curso 
    WHERE docente_curso.id_docente_curso = '$cra';";
    $result = $db->query($query);
    if(!$result) {
        die("No se pudo ejecutar la consulta ---> ". mysqli_error($db));
    }
    if($result->num_rows > 0) {
        while($compra = $result->fetch_assoc()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../../img/loginImages/EducationSchool.svg" />
    <!--<link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">-->
    <title>Ticket</title>
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
    .primary {
        color: #47ABE2;
    }
    .container-info-pdf {
        margin: 0 auto;
        width: 100%;
        text-align: center;
        justify-content: center;
        padding: 5px 0;
    }
    .container-info-pdf .text-about-course {
        margin-bottom: 0px;
    }
    .text-about-course h1 {
        font-size: 35px;
        margin-bottom: -10px;
    }
    .text-about-course p {
        font-size: 13px;
    }
    .separator {
        width:100%;
        height:1px;
        background:black;
        margin-top:30px;
    }
    .info-logotipo {
        font-size: 13px;
        color: grey;
    }
    .info-logotipo span {
        color: #47ABE2;
        font-weight: 500;
        font-size:13px;
        font-family: 'poppins', sans-serif;
    }
    .container-logtipo-stripe {
        margin-top:323px;
    }
</style>
<body>
    <div class="container-info-pdf">
        <h2>SIS<span class="primary">ESCOLAR</span></h2>
        <div class="text-about-course">
            <h1> <?= $compra['nombre_curso'] ?> </h1>
            
        </div>
        <div class="separator"></div>
        <div class="info-ticket">
            <p>ID de compra: <?= $compra['id_docente_curso'] ?></p>

            <div class="separator"></div>

            <h3>Datos del docente</h3>

            <p>ID de docente: <?= $compra['id_docente'] ?></p>

            <p>Nombre: 
                <?= $compra['nombre_docente']." ".$compra['segundo_nombreDocente']." ".$compra['apellido_paternoDocente']." ".$compra['apellido_maternoDocente'] ?>
            </p>

            <p>Correo: <?= $compra['email_docente'] ?></p>

            <p>Teléfono: <?= $compra['numero_tel_Docente'] ?></p>

            <div class="separator"></div>

            <p>Fecha de compra: <?= $compra['f_creacion_doc_cur'] ?></p>

            <p>Costo unitario de curso (MXN): $<?= $compra['costo_unitario'] ?></p>

            <p>Total de compras: <?= $compra['cantidad_boletines'] ?></p>

            <p>Costo total (MXN): $<?= ($compra['cantidad_boletines']) * ($compra['costo_unitario']) ?></p>

            <div class="container-logtipo-stripe">
                <p class="info-logotipo">Información validada por <span>Stripe</span></p>
                <p style="font-size:12px;color:grey;">www.stripe.com<p>
            </div>
        </div>
    </div>
</body>
</html>
<?php
        }
    } else {
        echo "Datos no encontrados";
    }
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
    $dompdf->stream("usuarios _registrados.pdf", array("Attachment" => false)); // --> si  no requiere abrir otra pestaña y descargarlo automáticamente, remplazar el false por true


?>