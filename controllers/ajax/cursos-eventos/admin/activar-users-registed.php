<?php
    /* en esta query, se verifican las fechas para comprobar que deben editarse si el curso 
    se desea activar después de un largo tiempo de ser un curso INACTIVO */
    include('../../../../model/connection.php');
    $db = $connection;

    if(isset($_POST['id'])) {
        // obtenemos el id
        $id = $_POST['id'];
        
        // consulta para conocer el estatus del curso seleccionado
        $result = mysqli_query($db, "SELECT cursos.fecha_inicio_curso, cursos.fecha_fin_curso FROM cursos WHERE id_curso = '$id';");
        // comprobamos si se ha ejecutado con éxito
        if(!$result) {
            die("Error al buscar estatus del curso");
        } else {
            // obtenemos las fechas y lo guardamos en una variable
            while($dates = $result->fetch_assoc()) {
                $fecha_inicio = $dates['fecha_inicio_curso'];
                $fecha_fin = $dates['fecha_fin_curso'];
            }

            // Definimos la fecha actual con formato UNIX previamente formateada con date() y obtenida con time()
            $fecha_actual = strtotime(date("y-m-d"));
            // Mismo formato ára la fecha de inicio y fin del curso
            $dateStart = strtotime($fecha_inicio);
            $dateEnd = strtotime($fecha_fin);

            // condicionamos si las fechas de registro son mayores a la fecha actual para activar
            if($dateStart <= $fecha_actual || $dateStart >= $fecha_actual and $dateEnd > $fecha_actual) {
                // preparamos la consulta
                $query = "UPDATE cursos SET estatus_curso = 'activo' WHERE cursos.id_curso = '$id';";
                // ejecutamos la consulta
                $result = mysqli_query($db, $query);
                //comprobamos que todo ha salido bien
                if(!$result) {
                    die('Query Failed.');
                }
                echo 1; // curso activado
            } else {
                echo 2; // error, las fechas no cumplen con la condicion
            }
        }
    }

?>