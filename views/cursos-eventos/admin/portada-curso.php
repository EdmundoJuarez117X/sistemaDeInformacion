<?php
    $cso = $_GET['cso'];
    require_once "../../../model/connection.php";
    $db = $connection;
    $res = $db->query("SELECT cursos.nombre_curso, cursos.portada_curso FROM cursos WHERE cursos.id_curso = $cso");
    if(!$res) {
        die("No se pudo extraer informacion. Error: ". mysqli_error($db));
    }
    $curso = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
    <title><?= $curso['nombre_curso'] ?></title>
</head>
<body>
    <div class="container-compra-satisfactoria">
        <h1>SIS<span>ESCOLAR</span> </h1>
        <h2> <?= $curso['nombre_curso'] ?> </h2>
        <p>Portada del curso:</p>
        <div>
        <img src="data:url/jpeg;base64, <?= base64_encode( $curso['portada_curso'] )?>"/>
        </div>
        <form action="../../../controllers/ajax/cursos-eventos/admin/upload-image.php?cso=<?=$cso?>" method="post" enctype="multipart/form-data">
            <div>
                <div>
                    <input type="file" name="image" accept="image/png, image/gif, image/jpeg"/>
                </div>
                <div>
                    <input type="submit" name="submit" value="SUBIR"/>
                </div>
            </div>
        </form>
    </div>
</body>
</html>