<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../../index.php");
    }

    require_once "../../../../model/connection.php";
    $db = $connection;

    if($_SESSION['subMat'] == "Al") {

        $id = $_SESSION['id_alumno'];
        $query = "SELECT *
        FROM cursos INNER JOIN alumno_curso ON cursos.id_curso = alumno_curso.id_curso
        WHERE alumno_curso.id_alumno = $id";

        $idCompra = "id_alumno_curso";
        $date = "f_creacion_al_cur";

    } else if($_SESSION['subMat'] == "DOC") {

        $id = $_SESSION['id_docente'];
        $query = "SELECT *
        FROM cursos INNER JOIN docente_curso ON cursos.id_curso = docente_curso.id_curso
        WHERE docente_curso.id_docente = $id";

        $idCompra = "id_docente_curso";
        $date = "f_creacion_doc_cur";
    }

    $result = $db->query($query);

    if(!$result) {
        die("Error al consultar tus cursos. Error: ". mysqli_error($db));
    }

    $json = array();

    if($result->num_rows > 0) {
        while($data = $result->fetch_assoc()) {
            $json[] = array(
                'id' => $data['id_curso'],
                'nombre' => $data['nombre_curso'],
                'costo' => $data['costo_unitario'],
                'boletos' => $data['cantidad_boletines'],
                'idCompra' => $data[$idCompra],
                'fecha' => $data[$date],
                'rol' => $data['rol_dirigido']
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "No tienes cursos...";
    }


?>