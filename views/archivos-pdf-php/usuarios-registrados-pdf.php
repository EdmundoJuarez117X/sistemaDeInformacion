<?php
    session_start();
    if (empty($_SESSION["id_persona"])) {
        header("location:../../index.php");
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
    <title>Usuarios Registrados</title>
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
    .container-info-pdf .table-register-user {
        font-size: 13px;
        width: 100%;
        text-align: center;
        padding: 5px 10px;
        border-radius: 25px;
        background-color: #eee;
        margin: auto;
    }
    tr th {
        height: 2.5rem;
    }
    .table-register-user tr td {
        height: 2rem;
    }
</style>
<body>
    <div class="container-info-pdf">
        <h2>SIS<span class="primary">ESCOLAR</span></h2>
            <div class="text-about-course">
                <h1> Curso de Verano </h1>
                <p>Personas que adquirieron el curso.</p>
            </div>
            <<table class="table-register-user">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo Electrónico</th>
                    <th>Número telefónico</th>
                    <th>ID de compra</th>
                    <th>Estado de compra</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Alejandro</td>
                    <td>Ramírez</td>
                    <td>Tirado</td>
                    <td>a.ramirezt@upam.edu.mx</td>
                    <td>2213646439</td>
                    <td>cg_564654fdfh_dfgf54df</td>
                    <td>PAGADO</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Daniel</td>
                    <td>Ramírez</td>
                    <td>Flores</td>
                    <td>correo1@mail.com</td>
                    <td>2213646439</td>
                    <td>cg_56hdfjn_4df</td>
                    <td>PAGADO</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MArco</td>
                    <td>Sánchez</td>
                    <td>Rosas</td>
                    <td>correo1@mail.com</td>
                    <td>4578986532</td>
                    <td>cg_safsdfh_dfgfsa4654sdf</td>
                    <td>PAGADO</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Gerónimo</td>
                    <td>Torres</td>
                    <td>Prado</td>
                    <td>correo3@mail.com</td>
                    <td>2213545489</td>
                    <td>cg_5fdg54fh_dsd64df</td>
                    <td>PAGADO</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Manuel</td>
                    <td>Matamoros</td>
                    <td>Pérez</td>
                    <td>correo4@mail.com</td>
                    <td>2213545489</td>
                    <td>cg_5fdg54fh_dsd64df</td>
                    <td>PAGADO</td>
                </tr>
            </table>
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
    $dompdf->stream("usuarios _registrados.pdf", array("Attachment" => false)); // --> si  no requiere abrir otra pestaña y descargarlo automáticamente, remplazar el false por true


?>