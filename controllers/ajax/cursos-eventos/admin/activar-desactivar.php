<?php

    include('../../../../model/connection.php');
    $db = $connection;

    if(isset($_POST['id'])) {
        // obtenemos el id
        $id = $_POST['id'];
        // consulta para conocer el estatus del curso seleccionado
        $result = mysqli_query($db, "SELECT cursos.estatus_curso FROM cursos WHERE id_curso = '$id';");
        // comprobamos si se ha ejecutado con éxito
        if(!$result) {
            die("Error al buscar estatus del curso");
        } else {
            // obtenemos el estatus y lo guardamos en una variable
            while($status = $result->fetch_assoc()) {
                $estatus = $status['estatus_curso'];
            }
            // condicionamos si el estatus esta activo o inactivo
            if($estatus == "activo") {
                // preparamos la consulta
                $query = "UPDATE cursos SET estatus_curso = 'inactivo' WHERE cursos.id_curso = '$id';";
                // ejecutamos la consulta
                $result = mysqli_query($db, $query);
                //comprobamos que todo ha salido bien
                if(!$result) {
                    die('Query Failed.');
                }
                echo 'desactivado';
            } 
            else if($estatus == "inactivo") {
                // preparamos la consulta
                $query = "UPDATE cursos SET estatus_curso = 'activo' WHERE cursos.id_curso = '$id';";
                // ejecutamos la consulta
                $result = mysqli_query($db, $query);
                //comprobamos que todo ha salido bien
                if(!$result) {
                    die('Query Failed.');
                }
                echo 'activado';
            }
        }
    }
?>