<?php

    include('../../../../model/connection.php');
    $db = $connection;
    // fetch query
    function fetch_data(){
        global $db;
        $query = "SELECT docente_curso.id_docente_curso, docente_curso.id_docente, docente_curso.id_curso,
        docente_curso.cantidad_boletines, docente_curso.f_creacion_doc_cur, cursos.costo_unitario 
        FROM docente_curso INNER JOIN cursos ON docente_curso.id_curso = cursos.id_curso
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
                        <td>". $data['id_docente_curso'] ."</td>
                        <td>". $data['id_docente'] ."</td>
                        <td>". $data['id_curso'] ."</td>
                        <td>". $data['cantidad_boletines'] ."</td>
                        <td>$". ($data['cantidad_boletines']) * ($data['costo_unitario']) ."</td>
                        <td>". $data['f_creacion_doc_cur']. "</td>
                        <td><a href='../../archivos-pdf-php/ticket-docente.php?cra=". $data['id_docente_curso']. "' target='_blank'>
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