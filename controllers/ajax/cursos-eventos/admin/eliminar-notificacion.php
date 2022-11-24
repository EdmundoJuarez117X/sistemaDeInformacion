<?php

    require_once "../../../../model/connection.php";
    $db = $connection;

    $id = $_POST['id'];

    if(!empty($id)) {

        $query = "DELETE FROM notificacion_curso WHERE notificacion_curso.id_notificacion_curso = $id";
        $result = $db->query($query);
        if(!$result) {
            die("Error al eliminar. Error: ". mysqli_error($db));
        }
        echo "OK";

    } else {
        echo "EMPTY";
    }

?>