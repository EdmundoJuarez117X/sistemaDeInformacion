<?php
session_start();

include("./../../../model/connection.php");

$Autorizacion = false; //Autorizar la redirección de página
$url = ''; //Url dependiendo del registro y nivel educativo
$id_escuela = $_GET['id_escuela'];
$id_nivelEducativo = $_GET['id_nivelEducativo'];
$nombre_escuela = $_GET['nombre_escuela'];
$nombre_nivelEducativo = $_GET['nombre_nivelEducativo'];
$id_aspirante = $_SESSION['id_aspirante'];
$date = date("Y-m-d H:i:s");


if ($nombre_nivelEducativo == "Basica") {
    $sql = "INSERT INTO `admisionInteresesAspirante`(`nombre_escuela`, `nombre_nivelEducativo`, `f_creacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`) 
        VALUES ('$nombre_escuela','$nombre_nivelEducativo', '$date', '$id_aspirante', '$id_escuela', '$id_nivelEducativo')";
    if (mysqli_query($connection, $sql)) {
        $sqlUpdate = "UPDATE `aspirante` SET `estatus_Aspirante`='PROCADM' WHERE `id_aspirante`='$id_aspirante'";
        if (mysqli_query($connection, $sqlUpdate)) {
            $Autorizacion = true;
            $_SESSION["estatus_persona"] = "PROCADM";
            $url = 'views/dashboard/inicio.php';
        }

    } else {
        echo 'Algo Salio mal';
    }
} else if ($nombre_nivelEducativo == "Media Superior") {
    //echo $nombre_escuela . " " . $nombre_nivelEducativo . " " . $date . " " . $id_aspirante . " " . $id_escuela . " " . $id_nivelEducativo;
    $sqlMS = "INSERT INTO `admisionInteresesAspirante`(`nombre_escuela`, `nombre_nivelEducativo`, `f_creacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`)
        VALUES ('$nombre_escuela','$nombre_nivelEducativo', '$date', '$id_aspirante', '$id_escuela', '$id_nivelEducativo')";
    if (mysqli_query($connection, $sqlMS)) {

        $sqlUpdateAsp = "UPDATE `aspirante` SET `estatus_Aspirante`='PROCADM' WHERE `id_aspirante`='$id_aspirante'";
        if (mysqli_query($connection, $sqlUpdateAsp)) {
            $Autorizacion = true;
            $_SESSION["estatus_persona"] = "PROCADM";
            $url = 'views/dashboard/inicio.php';
        }

    } else {
        //echo "Error: " . $sqlMS . "<br>" . mysqli_error($connection);
    }
} else if ($nombre_nivelEducativo == "Superior") {

    $nombre_facultad;
    $nombre_esp;
    $nombre_carrera;
    $id_carrera;
    $id_especializacion;
    $id_facultad;
    if (isset($_GET['nombre_facultad'])) {
        $id_facultad = $_GET['id_facultad'];
        $nombre_facultad = $_GET['nombre_facultad'];
        if (isset($_GET['nombre_esp'])) {
            $nombre_esp = $_GET['nombre_esp'];
            echo $nombre_esp;
            if (isset($_GET['id_especializacion'])) {
                $id_especializacion = $_GET['id_especializacion'];
                if ($nombre_esp != "") {
                    $sql = "INSERT INTO `admisionInteresesAspirante`( `nombre_escuela`, `nombre_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `f_creacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_especializacion`) 
                    VALUES ('$nombre_escuela','$nombre_nivelEducativo', '$nombre_facultad', '$nombre_esp', '$date', '$id_aspirante', '$id_escuela','$id_nivelEducativo', '$id_facultad', '$id_especializacion')";
                    if (mysqli_query($connection, $sql)) {
                        $sqlUpdate = "UPDATE `aspirante` SET `estatus_Aspirante`='PROCADM' WHERE `id_aspirante`='$id_aspirante'";
                        if (mysqli_query($connection, $sqlUpdate)) {
                            $Autorizacion = true;
                            $_SESSION["estatus_persona"] = "PROCADM";
                            $url = 'views/dashboard/inicio.php';
                        }

                    } else {

                    }
                }
            }
        } else if (isset($_GET['nombre_carrera'])) {
            $nombre_carrera = $_GET['nombre_carrera'];
            if (isset($_GET['id_carrera'])) {
                $id_carrera = $_GET['id_carrera'];
                if ($nombre_carrera != "") {
                    // echo "<script>alert('" . $id_nivelEducativo . "');</script>";
                    // echo "<script>alert('" . $id_facultad . "');</script>";
                    // echo "<script>alert('" . $id_escuela . "');</script>";
                    $sql = "INSERT INTO `admisionInteresesAspirante`( `nombre_escuela`, `nombre_nivelEducativo`, `nombre_facultad`, `nombre_carrera`, `f_creacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`) 
                    VALUES ('$nombre_escuela','$nombre_nivelEducativo', '$nombre_facultad', '$nombre_carrera', '$date', '$id_aspirante', '$id_escuela','$id_nivelEducativo', '$id_facultad', '$id_carrera')";
                    if (mysqli_query($connection, $sql)) {
                        $sqlUpdate = "UPDATE `aspirante` SET `estatus_Aspirante`='PROCADM' WHERE `id_aspirante`='$id_aspirante'";
                        if (mysqli_query($connection, $sqlUpdate)) {
                            $Autorizacion = true;
                            $_SESSION["estatus_persona"] = "PROCADM";
                            $url = 'views/dashboard/inicio.php';
                        }

                    } else {

                    }
                }
            }
        }
    }

    // $numero_grado;





} else {

}
if ($Autorizacion == true) {

    header("location:./../../../$url");
}



?>