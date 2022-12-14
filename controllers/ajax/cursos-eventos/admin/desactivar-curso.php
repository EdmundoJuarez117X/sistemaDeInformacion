<?php

    include('../../../../model/connection.php');
    $db = $connection;

    date_default_timezone_set("America/Mexico_City");

    $query = "SELECT cursos.id_curso, cursos.fecha_fin_curso, cursos.estatus_curso FROM cursos";
    if(!$result = $db->query($query)) {
        die("Error al extraer información (desactivar-curso.php). Error: ". mysqli_error($db));
    }
    // fecha actual para condicionar
    $fecha_actual = strtotime(date("y-m-d"));

    while ($rows = mysqli_fetch_array($result)) {
        // si la fecha de finalización del curso es mayor a la actual se desactiva automaticamente
        $f_curso = $rows['fecha_fin_curso'];
        $f_curso_unix = strtotime($f_curso);
        // VERIFICAR SI EL CURSO YA ESTÁ VENCIDO: DESACTIVAR
        if ($f_curso_unix < $fecha_actual) {
            $id = $rows['id_curso'];

            if(!$db->query("UPDATE cursos SET cursos.estatus_curso = 'inactivo' WHERE cursos.id_curso = $id")) {
                die("No se pudo desactivar curso (desactivar-curso.php). Error: ". mysqli_error($db));
            } else {
                $exist = $db->query("SELECT * FROM notificacion_curso WHERE notificacion_curso.id_curso = $id 
                AND notificacion_curso.descripcion_notificacion = 'CD'");
                if(!$exist) {
                    die("Error al revisar información (desactivar-curso.php). Error: ". mysqli_error($db));
                }
                if(mysqli_num_rows($exist) > 0) {
                    // existe la notificacion
                } else {
                    $insert = "INSERT INTO notificacion_curso (id_notificacion_curso, descripcion_notificacion, id_curso)
                    VALUE (NULL, 'CD', $id)";

                    if(!$db->query($insert)) {
                        die("No se pudo crear notificación (desactivar-curso.php). Error: ". mysqli_error($db));
                    }
                    echo "ok";
                }
            }
        // SI LAS FECHAS DEL CURSO VENCEN HOY
        } else if($f_curso_unix == $fecha_actual) {
            $id = $rows['id_curso'];

            $exist = $db->query("SELECT * FROM notificacion_curso WHERE notificacion_curso.id_curso = $id 
            AND notificacion_curso.descripcion_notificacion = 'CPD'");
            if(!$exist) {
                die("Error al revisar información (desactivar-curso.php). Error: ". mysqli_error($db));
            }
            if(mysqli_num_rows($exist) > 0) {
                // existe la notificacion
            } else {
                $insert = "INSERT INTO notificacion_curso (id_notificacion_curso, descripcion_notificacion, id_curso)
                VALUE (NULL, 'CPD', $id)";
        
                if(!$db->query($insert)) {
                    die("No se pudo crear notificación (desactivar-curso.php). Error: ". mysqli_error($db));
                }
                echo "ok";
            }
        }
    }
?>