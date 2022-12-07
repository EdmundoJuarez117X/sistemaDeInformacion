<?php

    include('../../../../model/connection.php');
    $db = $connection;
    
    $query = "SELECT docente_curso.id_docente_curso, docente_curso.id_docente, docente_curso.id_curso,
    docente_curso.cantidad_boletines, docente_curso.f_creacion_doc_cur, cursos.costo_unitario 
    FROM docente_curso INNER JOIN cursos ON docente_curso.id_curso = cursos.id_curso
    ";

    // ejecutamos la consulta
    $result = mysqli_query($db, $query);
    // comprobamos que se haya ejecutado
    if(!$result) {
        die("Error al extraer cursos.". mysqli_error($db));
    }
    // generar un arreglo
    $json = array();

    if($result->num_rows > 0) {
    // obtenemos los datos de la tabla
        while($row = mysqli_fetch_array($result)) {
            // guardamos los cursos en el array
            $json[] = array(
                'idac' => $row['id_docente_curso'],
                'ida' => $row['id_docente'],
                'idc' => $row['id_curso'],
                'cb' => $row['cantidad_boletines'],
                'fcac' => $row['f_creacion_doc_cur'],
                'costo' => $row['costo_unitario']
            );
        }
        // en una variable convertimos el array en formato json
        $jsonstring = json_encode($json);
        // imrprimimos el arreglo
        echo $jsonstring;

    } else {
        echo 2; // no hay compras
    }

?>