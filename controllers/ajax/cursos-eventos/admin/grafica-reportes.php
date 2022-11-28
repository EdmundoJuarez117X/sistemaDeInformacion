<?php

    include('../../../../model/connection.php');
    $db = $connection;
    //creamos arreglo para guardar los datos de la consulta
    $json = array();

    // contador
    $i = 1;

    // tipo de consulta de extraer
    $type = $_POST['type'];

    if($type == 1) {
        $query = "SELECT cursos.nombre_curso, cursos.participantes_registrados FROM cursos 
        ORDER BY cursos.participantes_registrados DESC;";
    } else if($type == 2) {
        $query = "SELECT cursos.nombre_curso, cursos.participantes_registrados FROM cursos 
        ORDER BY cursos.participantes_registrados;";
    }
    // se ha ejecutado?
    if($sql = $db->query($query)) {
        // extraer y guardar
        while($rows = mysqli_fetch_array($sql)) {
            if($i < 6) {
                $json[] = $rows;
            }
            $i++;
        }

    }else{
        die("Error al extraer cursos. Error: ". mysqli_error($db));
    }

    echo json_encode($json);

?>