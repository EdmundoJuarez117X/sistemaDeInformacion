<?php

session_start();
if (empty($_SESSION["subMat"])) {
    header("location:../../../../index.php");
}

    require_once "../../../../model/connection.php";
    $db = $connection;
    // conocer qué rol ha ingresado
    if($_SESSION['subMat'] == "Al") {
        $rol = "alumno";
    } else if($_SESSION['subMat'] == "DOC") {
        $rol = "docente";
    }

    // consulta para extraer información
    $query = "SELECT 
    cursos.id_curso, cursos.nombre_curso, cursos.descripcion_curso, cursos.costo_unitario, cursos.portada_curso
    FROM cursos 
    WHERE rol_dirigido = '$rol' AND estatus_curso = 'activo'";
    // ejecutamos la query
    $result = $db->query($query);
    // se ha ejecutado?
    if(!$result) {
        die("No pudo obtener cursos. Error: ". mysqli_error($db));
    }
    // array para guardar informacion
    $json = array();
    // obtenemos y gardamos informacion en arreglo
    if($result->num_rows > 0) {
        while ($datas = $result->fetch_assoc()) {
            $json[] = array(
                'id' => $datas['id_curso'],
                'nombre' => $datas['nombre_curso'],
                'descripcion' => $datas['descripcion_curso'],
                'costo' => $datas['costo_unitario'],
            );
        }

        // convertir string en formato JSON
        $jsonstring = json_encode($json);
        echo $jsonstring;

    } else {
        echo "No se encontraron cursos...";
    }



?>