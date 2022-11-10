<?php 

    include('../../../../model/connection.php');
    $db = $connection;
    //creamos arreglo para guardar los datos de la consulta
    $datas = array();
    // comprobamos que se haya ejecutado
    if($sql = $db->query('SELECT cursos.nombre_curso, cursos.total_participantes, cursos.participantes_registrados FROM cursos;')) {
        // 
        while($sql_Datas = mysqli_fetch_array($sql)) {
            $datas[] = $sql_Datas;
        }
    }

    echo json_encode($datas);

?>