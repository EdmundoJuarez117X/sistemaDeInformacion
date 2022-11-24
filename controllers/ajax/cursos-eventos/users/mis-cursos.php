<?php

    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../../index.php");
    }

    //incluir la bd
    require_once "../../../../model/connection.php";
    $db = $connection;

    if($_SESSION['subMat'] == "Al") {
        // Obtener el ID del usuario
        $id = $_SESSION['id_alumno'];
        // preprar la query de los cursos del usuario
        $query = "SELECT *
        FROM alumno 
        INNER JOIN alumno_curso ON alumno.id_alumno = alumno_curso.id_alumno 
        INNER JOIN cursos ON cursos.id_curso = alumno_curso.id_curso
        WHERE alumno_curso.id_alumno = $id";

        $idCompra = "id_alumno_curso";
        $date = "f_creacion_al_cur";

    } else if($_SESSION['subMat'] == "DOC") {
        // Obtener el ID del usuario
        $id = $_SESSION['id_docente'];
        // preprar la query de los cursos del usuario
        $query = "SELECT *
        FROM docente 
        INNER JOIN docente_curso ON docente.id_docente = docente_curso.id_docente 
        INNER JOIN cursos ON cursos.id_curso = docente_curso.id_curso
        WHERE docente_curso.id_docente = $id";

        $idCompra = "id_docente_curso";
        $date = "f_creacion_doc_cur";

    }

    // ejecuta la consulta
    $result = $db->query($query);
    //ha funcionado?
    if(!$result) {
        die("No se pudo extraer Tus Cursos. Error: ". mysqli_error($db));
    }
    // arreglo para los datos
    $json = array();
    // existen cursos registrados?
    if($result->num_rows > 0) {
        // lléname mis cursos
        while($datas = $result->fetch_assoc()) {
            $json [] = array(
                'id' => $datas[$idCompra],
                'nombre' => $datas['nombre_curso'],
                'fecha' => $datas[$date]
            );
        }
        echo json_encode($json);
    } else {
        echo "No tienes cursos";
    }
?>