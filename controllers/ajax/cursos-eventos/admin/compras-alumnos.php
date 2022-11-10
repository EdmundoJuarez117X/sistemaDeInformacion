<?php

    include('../../../../model/connection.php');
    $db = $connection;
    // fetch query
    function fetch_data(){
        global $db;
        $query = "SELECT alumno_curso.id_alumno_curso, alumno_curso.id_alumno, alumno_curso.id_curso,
        alumno_curso.cantidad_boletines, alumno_curso.f_creacion_al_cur, cursos.costo_unitario 
        FROM alumno_curso INNER JOIN cursos ON alumno_curso.id_curso = cursos.id_curso
        ";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
                
        }else{
            return $row = [];
        }
    }
    $fetchData = fetch_data();
    show_data($fetchData);

    function show_data($fetchData){
        if(count($fetchData) > 0){
            foreach($fetchData as $data){ 
                echo "
                    <tr>
                        <td>". $data['id_alumno_curso'] ."</td>
                        <td>". $data['id_alumno'] ."</td>
                        <td>". $data['id_curso'] ."</td>
                        <td>". $data['cantidad_boletines'] ."</td>
                        <td>$". ($data['cantidad_boletines']) * ($data['costo_unitario']) ."</td>
                        <td>". $data['f_creacion_al_cur']. "</td>
                        <td><a href='../../archivos-pdf-php/ticket-alumno.php?cra=". $data['id_alumno_curso']. "' target='_blank'>
                            <span class='material-icons-sharp'>description</span>
                        </a></td>
                    </tr>
                ";
            }
        }
        else {
            echo "No se encontraron compras...";
        }
    }

?>