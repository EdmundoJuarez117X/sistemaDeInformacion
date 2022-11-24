<?php

    include('../../../../model/connection.php');
    $db = $connection;

    // fetch query
    function fetch_data(){
            
        global $db;
            
        // almacenamos el periodo
        $dInitial = $_POST['dIni'];
        $dFinal = $_POST['dFin'];

        // query mediante fechas filtradas
        $query = "SELECT * FROM cursos WHERE cursos.f_creacion_curso BETWEEN '$dInitial 00:00:00' AND '$dFinal 23:59:59';";
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
        // ejecutamos la consulta
        $result = mysqli_query($db, $query);
        // si exiten registros
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;       
        }else{
            return $row = [];
        }
    }
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    $fetchData = fetch_data();
    show_data($fetchData);

    function show_data($fetchData){
        $activos = 0;
        $inactivos = 0;

        if(count($fetchData) > 0){
            $total_cursos = 0;
            foreach($fetchData as $cursos) {
                if($cursos['estatus_curso'] == "activo") {
                    $activos ++;
                } else if($cursos['estatus_curso'] == "inactivo") {
                    $inactivos ++;
                }
                $total_cursos ++;
            }
            echo '
                <div>
                    <div class="section-download-report">
                        <button onclick="descargar_reporte()">DESCARGAR REPORTE</button>
                    </div>
                    <div class="fields-middle third-middle">
                        <p class="p-resume-course">RESUMEN</p>
                        <p class="p-resume-course-cantidad">Cursos activos: <strong>'. $activos .'</strong></p>
                        <p class="p-resume-course-cantidad">Cursos finalizados: <strong> '. $inactivos .' </strong></p>
                        <p class="p-resume-course-cantidad">Cantidad de cursos: <strong> '. $total_cursos .' </strong></p>
                    </div>
                    <!-- ======================== CONTENEDOR DE CURSOS ACTIVOS ======================= -->
                    <div class="fields-middle third-middle">
                        <p class="p-instructions p-courses-info">CURSOS</p>
                    </div>
            ';
        }
        if(count($fetchData) > 0){
            foreach($fetchData as $cursos){ 

                echo "
                <div class='fields-middle container-info-course container-info-active-course'>
                    <p class='p-name-course-info'> <strong>".$cursos['nombre_curso']."</strong> <br>
                        <p style='text-align:center;font-size:11px'>Registrado: ". $cursos['f_creacion_curso'] ."</p>
                        (<a href='https://cdn.pixabay.com/photo/2017/01/24/09/20/learn-2004905_960_720.png' target='_blank'>portada</a>)
                    </p>

                    <div class='fields-middle first-middle'>
                        <p class='first-date-info'>
                            <strong>Inicia:</strong> ".$cursos['fecha_inicio_curso']."
                        </p>
                    </div>
                    <div class='fields-middle second-middle'>
                        <p class='second-date-info'>
                            <strong>Finaliza:</strong> ".$cursos['fecha_fin_curso']."
                        </p>
                    </div>

                    <p class='p-description-course-info'><strong>Descripción:</strong>".$cursos['descripcion_curso']."</p>

                    <p class='p-description-course-info'><strong>Requisitos:</strong>
                    ".$cursos['requisitos_curso']."
                    </p>

                    <p class='p-description-course-info'><strong>Responsables:</strong>
                    ".$cursos['responsables_curso']."
                    </p>

                    <div class='fields-middle first-middle'>
                        <p class='first-date-info'>
                            <strong>Curso exclusivamente para:</strong> ".$cursos['rol_dirigido']."
                        </p>
                    </div>
                    <div class='fields-middle second-middle'>
                        <p class='second-date-info'>
                            <strong>Estado del curso:</strong> ".$cursos['estatus_curso']."
                        </p>
                    </div>

                    <div class='fields-middle first-middle'>
                        <p class='first-date-info'>
                            <strong>Cantidad de participantes:</strong> ".$cursos['total_participantes']."
                        </p>
                    </div>
                    <div class='fields-middle second-middle'>
                        <p class='second-date-info'>
                            <strong>Paticipantes registrados:</strong> ".$cursos['participantes_registrados']."
                        </p>
                    </div>

                    <div class='fields-middle first-middle'>
                        <p class='first-date-info'>
                            <strong>Costo unitario (MXN):</strong> $".$cursos['costo_unitario']."
                        </p>
                    </div>
                    <div class='fields-middle second-middle'>
                        <p class='second-date-info'>
                            <strong>Monto generado (MXN):</strong>
                            $". ($cursos['participantes_registrados'])*($cursos['costo_unitario']) ."
                        </p>
                    </div>
                </div>
                ";
            }
        } else {    
            echo "
                    <p style='text-align_center;'>No se encontraron cursos...</p>
                "; 
        }
        echo "
            </div>
        ";
    }
    
?>