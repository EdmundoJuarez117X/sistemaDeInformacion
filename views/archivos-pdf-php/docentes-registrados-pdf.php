<?php
    /*session_start();
    if (empty($_SESSION["id_persona"])) {
        header("location:../../index.php");
    }*/
    // inicio del objeto para guadar el contenido HTML en memoria
    ob_start();
    // QUIENES ESTAN REGISTRADOS EN EL CURSO
    $cso = $_GET['cso'];
    require_once("../../model/connection.php");
    $db = $connection;
    // query para nombre de curso
    $query_name = "SELECT cursos.nombre_curso FROM cursos WHERE id_curso = $cso;";
    // ejecutamos
    $response = $db->query($query_name);
    // obtenemos el nombre del curso
    while($name = $response->fetch_assoc()) {
        $course = $name['nombre_curso'];
    }
    // query para mostrar los datos de los usuarios registrados
    $query = "SELECT * 
    FROM cursos INNER JOIN docente_curso ON cursos.id_curso = docente_curso.id_curso
    INNER JOIN docente ON docente_curso.id_docente = docente.id_docente
    WHERE docente_curso.id_curso = $cso;";
    // ejecutamos
    $result = $db->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">-->
    <title>Docentes Registrados</title>
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
        <p> <?= date("y-m-d") ?> </p>
            <div class="text-about-course">
                <h1> <?= $course ?> </h1>
                <p>Docentes que adquirieron el curso.</p>
            </div>
            <<table class="table-register-user">
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre(s)</th>
                    <th>Apellido paterno</th>
                    <th>Apellido paterno</th>
                    <th>Número telefónico</th>
                    <th>ID de compra</th>
                    <th>Estado de compra</th>
                </tr>
        <?php
            if($result->num_rows > 0) {
                while($datas = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= $datas['id_docente'] ?></td>
                    <td><?= $datas['nombre_docente']." ".$datas['segundo_nombreDocente'] ?></td>
                    <td><?= $datas['apellido_paternoDocente'] ?></td>
                    <td><?= $datas['apellido_maternoDocente'] ?></td>
                    <td><?= $datas['numero_tel_Docente'] ?></td>
                    <td><?= $datas['id_docente_curso'] ?></td>
                    <td><?= $datas['descripcion_pago'] ?></td>
                </tr>
        <?php
                }
            }
        ?>
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