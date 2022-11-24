<?php

    require_once "../../../../model/connection.php";
    $db = $connection;

    $user = $_POST['user'];
    $cso = $_POST['cso'];

    if($user == "" and $cso == "") {
        echo 2;
    } else {

        $res_id = $db->query("SELECT cursos.id_curso FROM cursos WHERE cursos.nombre_curso = '$cso'");
        if(!$res_id) {
            die("Error al obtener ID. Error: ". mysqli_error($db));
        }
        $data = $res_id->fetch_assoc();
        // obtenemos el ID
        $id = $data['id_curso'];

        if($user == "alumno") {
            // consulta para insertar en notificaciones
            $sql = "INSERT INTO notificacion_curso (id_notificacion_curso, descripcion_notificacion, id_curso)
                    VALUE (NULL, 'No se ha enviado a alumnos', $id)";
            $notify = $db->query($sql);
            if(!$notify) {
                die("No se pudo crear notificacion. Error: ". mysqli_error($db));
            }

            echo 1;
        } else if($user == "docente") {
            // consulta para insertar en notificaciones
            $sql = "INSERT INTO notificacion_curso (id_notificacion_curso, descripcion_notificacion, id_curso)
                    VALUE (NULL, 'No se ha enviado a docentes', $id)";
            $notify = $db->query($sql);
            if(!$notify) {
                die("No se pudo crear notificacion. Error: ". mysqli_error($db));
            }

            echo 1;
        }
        
    }
?>