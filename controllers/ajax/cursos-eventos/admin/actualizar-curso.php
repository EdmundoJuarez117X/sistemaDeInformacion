<?php

    include('../../../../model/connection.php');
    $db = $connection;
    // condicionamos si los campos no están vacíos
    if(!empty($_POST['id']) and !empty($_POST['nam']) 
    and !empty($_POST['des']) and !empty($_POST['req']) 
    and !empty($_POST['res']) and !empty($_POST['ptes']) 
    and !empty($_POST['cos']) and !empty($_POST['user']) 
    and !empty($_POST['dIni']) and !empty($_POST['dEnd']) 
    and !empty($_POST['stus'])
    ) {
        // obtenemos el contenido de las variables
        $id = $_POST['id'];
        $name = $_POST['nam'];
        $description = $_POST['des'];
        $requirements = $_POST['req'];
        $responsible = $_POST['res'];
        $participantes = $_POST['ptes'];
        $costo = $_POST['cos'];
        $user = $_POST['user'];
        $dInitial = $_POST['dIni'];
        $dEnd = $_POST['dEnd'];
        $status = $_POST['stus'];
        //$image = $_POST['img'];
        $date = date("y-m-d H:i:s");

        // Definimos la fecha actual con formato UNIX previamente formateada con date() y obtenida con time()
        $fecha_actual = strtotime(date("y-m-d"));
        // Mismo formato ára la fecha de inicio y fin del curso
        $fecha_inicio = strtotime($dInitial);
        $fecha_cierra = strtotime($dEnd);

        // condicionamos si las fechas de registro son mayores a la fecha actual
        if($fecha_inicio <= $fecha_actual || $fecha_inicio >= $fecha_actual and $fecha_cierra >= $fecha_actual) {

            // conoces si el tipo de usuario se ha actualizado
            $query = $db->query("SELECT cursos.rol_dirigido FROM cursos WHERE cursos.id_curso = $id");
            if(!$query) {
                die("Error al obtener el rol registrado. Error: ". mysqli_error($db));
            }
            $rol = $query->fetch_assoc();
            $rol_dirigido = $rol['rol_dirigido'];

            // si no hay cambios en el destino del curso
            if($user == $rol_dirigido) {
                // preparamos y ejecutamos la consulta para insertar los datos
                $sql = $db->query("UPDATE cursos SET nombre_curso = '$name', descripcion_curso = '$description', 
                fecha_inicio_curso = '$dInitial', fecha_fin_curso = '$dEnd', requisitos_curso = '$requirements', 
                responsables_curso = '$responsible', total_participantes = '$participantes', costo_unitario = '$costo', 
                estatus_curso = '$status', f_modificacion_curso = '$date', rol_dirigido = '$user' WHERE cursos.id_curso = '$id';");
                //condicionamos si se ha registrado exitosamente
                if($sql == true) {

                    if(!$db->query("DELETE FROM notificacion_curso WHERE notificacion_curso.id_curso = $id")) {
                        die("Error al eliminar. Error: ". mysqli_error($db));
                    } else {
                        echo 1; // transacción exitosa
                    }
                } else {
                    echo 2; // transacción fallida
                }
            // si se ha actualizado del tipo de usuario
            } else {
                // preparamos y ejecutamos la consulta para insertar los datos
                $sql = $db->query("UPDATE cursos SET nombre_curso = '$name', descripcion_curso = '$description', 
                fecha_inicio_curso = '$dInitial', fecha_fin_curso = '$dEnd', requisitos_curso = '$requirements', 
                responsables_curso = '$responsible', total_participantes = '$participantes', costo_unitario = '$costo', 
                estatus_curso = '$status', f_modificacion_curso = '$date', rol_dirigido = '$user' WHERE cursos.id_curso = '$id';");
                //condicionamos si se ha registrado exitosamente
                if($sql == true) {
                    echo "OK"; // transacción exitosa
                } else {
                    echo 2; // transacción fallida
                }
            }
            
        } else {
            echo 3; // fechas inválidas
        }

    } else {
        echo 4; // campos incompletos
    }

?>