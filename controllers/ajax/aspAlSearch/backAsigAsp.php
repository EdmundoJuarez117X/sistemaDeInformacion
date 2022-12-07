<?php
session_start();

include("./../../../model/connection.php");

$Autorizacion = false; //Autorizar la redirección de página
$url = ''; //Url dependiendo del registro y nivel educativo
$id_escuela = $_GET['id_escuela'];
$id_nivelEducativo = $_GET['id_nivelEducativo'];
$nombre_escuela = $_GET['nombre_escuela'];
$nombre_nivelEducativo = $_GET['nombre_nivelEducativo'];
$id_padreDeFamilia = $_SESSION['id_padreDeFamilia'];
$nombre_padreDeFam = $_SESSION['nombre_padreDeFam'];
$id_aspirante = $_GET['id_aspirante'];
$nombre_aspirante = $_GET['nombre_aspirante'];
$date = date("Y-m-d H:i:s");


if ($nombre_nivelEducativo == "Basica") {
    $sqlB = "INSERT INTO `padreDeFamiliaHijo`(`nombre_padreDeFam`, `nombre_aspirante`, `f_creacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`) 
    VALUES ('$nombre_padreDeFam','$nombre_aspirante','$date','$id_padreDeFamilia','$id_aspirante')";

    if (mysqli_query($connection, $sqlB)) {
        $sqlUpdate = "UPDATE `padreDeFamilia` SET `estatus_padreDeFam`='ASIGNADO'";

        if (mysqli_query($connection, $sqlUpdate)) {
            $Autorizacion = true;
            $_SESSION["estatus_persona"] = "ASIGNADO";
            $url = 'views/dashboard/inicio.php';
        }

    } else {
        echo 'Algo Salio mal';
    }
} else if ($nombre_nivelEducativo == "Media Superior") {
    $sqlMS = "INSERT INTO `padreDeFamiliaHijo`(`nombre_padreDeFam`, `nombre_aspirante`, `f_creacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`) 
    VALUES ('$nombre_padreDeFam','$nombre_aspirante','$date','$id_padreDeFamilia','$id_aspirante')";
    if (mysqli_query($connection, $sqlMS)) {
        $sqlUpdateM = "UPDATE `padreDeFamilia` SET `estatus_padreDeFam`='ASIGNADO'";
        if (mysqli_query($connection, $sqlUpdateM)) {
            $Autorizacion = true;
            $_SESSION["estatus_persona"] = "ASIGNADO";
            $url = 'views/dashboard/inicio.php';
        }

    } else {

    }
} else if ($nombre_nivelEducativo == "Superior") {
    $sqlSup = "INSERT INTO `padreDeFamiliaHijo`(`nombre_padreDeFam`, `nombre_aspirante`, `f_creacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`) 
    VALUES ('$nombre_padreDeFam','$nombre_aspirante','$date','$id_padreDeFamilia','$id_aspirante')";
    if (mysqli_query($connection, $sqlSup)) {
        $sqlUpdateS = "UPDATE `padreDeFamilia` SET `estatus_padreDeFam`='ASIGNADO'";
        if (mysqli_query($connection, $sqlUpdateS)) {
            $Autorizacion = true;
            $_SESSION["estatus_persona"] = "ASIGNADO";
            $url = 'views/dashboard/inicio.php';
        }

    } else {

    }


} else {

}
if ($Autorizacion == true) {
    //Redireccionamos al enlace proporcionado dependiendo el usuario
    header("location:./../../../$url");
}

?>