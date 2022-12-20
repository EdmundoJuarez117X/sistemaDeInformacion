<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }
    if($_SESSION['subMat'] == "Al") {
        $rol = "alumno";
    } else if($_SESSION['subMat'] == "DOC") {
        $rol = "docente";
    }

    require_once ('../../../../model/connection.php');
    $db = $connection;

    date_default_timezone_set("America/Mexico_City");

    $fecha_actual = date("Y-m-d");

    $date = strtotime($fecha_actual);
    
    $json = array();

    if(!$datas = $db->query("SELECT * FROM cursos WHERE cursos.rol_dirigido = '$rol' AND cursos.estatus_curso = 'activo' AND cursos.participantes_registrados < cursos.total_participantes;")) {
        die("Error al extraer cursos: Error: ". mysqli_error($db));
    }

    $i = 0;

    if($datas->num_rows > 0) {
        while ($curso = $datas->fetch_assoc()) {
                $d_curso = strtotime($curso['fecha_inicio_curso']);
            if($i < 3) {
                if($d_curso > $date) {
                    $res = ($d_curso - $date)/86400;

                    $json[] = array(
                        'id' => $curso['id_curso'],
                        'name' => $curso['nombre_curso'],
                        'cost' => $curso['costo_unitario'],
                        'dias' => $res
                    );
                    $i++;
                }
            }
        }
        echo json_encode($json);
    }

?>