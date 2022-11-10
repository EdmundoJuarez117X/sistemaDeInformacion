<?php

    include('../../../../model/connection.php');
    $db = $connection;
    // preparar consulta
    $query = 'SELECT cursos.id_curso, cursos.nombre_curso, cursos.total_participantes, cursos.participantes_registrados, 
    cursos.costo_unitario, cursos.estatus_curso, cursos.rol_dirigido FROM cursos';
    // ejecutamos la consulta
    $result = mysqli_query($db, $query);
    // comprobamos que se haya ejecutado
    if(!$result) {
        die("Error al extraer cursos.". mysqli_error($db));
    }
    // generar un arreglo
    $json = array();
    // obtenemos los datos de la tabla
    while($row = mysqli_fetch_array($result)) {
        // guardamos los cursos en el array
        $json[] = array(
            'id' => $row['id_curso'],
            'nombre' => $row['nombre_curso'],
            'participantes' => $row['total_participantes'],
            'registrados' => $row['participantes_registrados'],
            'costo' => $row['costo_unitario'],
            'estatus' => $row['estatus_curso'],
            'rol' => $row['rol_dirigido']
        );
    }
    // en una variable convertimos el array en formato json
    $jsonstring = json_encode($json);
    // imrprimimos el arreglo
    echo $jsonstring;
?>