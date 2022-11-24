<?php
    require_once "../../../../model/connection.php";
    $db = $connection;

    $query = "SELECT 
    cursos.id_curso, cursos.rol_dirigido, notificacion_curso.id_notificacion_curso, cursos.nombre_curso, notificacion_curso.descripcion_notificacion
    FROM notificacion_curso INNER JOIN cursos ON notificacion_curso.id_curso = cursos.id_curso;";
    $result = $db->query($query);
    if(!$result) {
        die("Error al consultar notificaciones. Error: ". mysqli_error($db));
    }

    $json = array();

    while($datas = $result->fetch_assoc()) {
        $json[] = $arrayName = array(
            'id_c' => $datas['id_curso'],
            'id' => $datas['id_notificacion_curso'],
            'name' => $datas['nombre_curso'],
            'des' => $datas['descripcion_notificacion'],
            'rol' => $datas['rol_dirigido']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>