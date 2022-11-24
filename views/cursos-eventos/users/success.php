<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }
    // si no estan vacios los datos neviados
    if(!empty($_GET['tid']) && !empty($_GET['product'])) {
        $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

        $tid = $GET['tid'];
        $product = $GET['product'];
    }else {
        header('Location: cursos.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
    <title>¡Gracias!</title>
</head>
<body>
    <div class="container-compra-satisfactoria">
        <h1>SIS<span>ESCOLAR</span> </h1>
        <p>te agradece por comprar</p>
        <h2><?= $product; ?></h2>
        <hr>
        <p>Tu ID de compra es:</p>
        <p class="p-id-compra"><?= $tid; ?></p>
        <p>Es seguro cerrar esta ventana.</p><br>
        <p>Puedes ver tus compras en tu <strong>historial de cursos</strong>.</p>
    </div>
</body>
</html>