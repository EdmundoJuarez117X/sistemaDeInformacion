<?php

    require_once "../../../../model/connection.php";
    $db = $connection;
    $cso = $_GET['cso'];

    if(isset($_POST["submit"])){

        $image = $_FILES['image']['tmp_name']; 

        if(!empty($image)) {

            $portada = addslashes(file_get_contents($image));
            //Insert image content into database
            $query = $db->query("UPDATE cursos SET portada_curso = '$portada' WHERE cursos.id_curso = $cso");

            if($query){

                header("Location: ../../../../views/cursos-eventos/admin/portada-curso.php?cso=$cso");

            } else{
                die("Error al subir portada. Error: ". mysqli_error($db));
            } 
        } else {
            header("Location: ../../../../views/cursos-eventos/admin/portada-curso.php?cso=$cso");
        }
    }
?>