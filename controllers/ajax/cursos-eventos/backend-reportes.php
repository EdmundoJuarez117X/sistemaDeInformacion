<?php
    echo "
    <div class='container-reportes-cursos'>
        <div class='section-download-report'>
            <button onclick='descargar_reporte()'>DESCARGAR REPORTE</button>
        </div>
        <div class='fields-middle third-middle'>
            <p class='p-resume-course'>RESUMEN</p>
            <p class='p-resume-course-cantidad'>Cursos activos: <strong> 8 </strong></p>
            <p class='p-resume-course-cantidad'>Cursos finalizados: <strong> 10 </strong></p>
            <p class='p-resume-course-cantidad'>Cursos cancelados: <strong> 3 </strong></p>
        </div>
        <!-- ======================== CONTENEDOR DE CURSOS ACTIVOS ======================= -->
        <div class='fields-middle third-middle'>
            <p class='p-instructions p-courses-info'>CURSOS ACTIVOS</p>
        </div>
        <div class='fields-middle container-info-course container-info-active-course'>
            <p class='p-name-course-info'> <strong> Curso de Verano </strong> <br>
                (<a href='https://cdn.pixabay.com/photo/2017/01/24/09/20/learn-2004905_960_720.png' target='_blank'>portada</a>)
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Inicia:</strong> 25/12/2022
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Finaliza:</strong> 01/01/2023
                </p>
            </div>

            <p class='p-description-course-info'><strong>Descripción:</strong>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat.
            </p>

            <p class='p-description-course-info'><strong>Requisitos:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <p class='p-description-course-info'><strong>Responsables:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Curso exclusivamente para:</strong> Alumnos
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Estado del curso:</strong> activo
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Cantidad de participantes:</strong> 32
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Paticipantes registrados:</strong> 30
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Costo unitario (MXN):</strong> $32.50
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Monto generado (MXN):</strong> $975.00
                </p>
            </div>
        </div>
        <!-- ======================== CONTENEDOR DE CURSOS INACTIVOS ======================= -->
        <div class='fields-middle third-middle'>
            <p class='p-instructions p-courses-info'>CURSOS FINALIZADOS</p>
        </div>
        <div class='fields-middle container-info-course container-info-inactive-course'>
            <p class='p-name-course-info'> <strong> Curso de Verano </strong> <br>
                (<a href='https://cdn.pixabay.com/photo/2017/01/24/09/20/learn-2004905_960_720.png' target='_blank'>portada</a>)
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Inicia:</strong> 25/12/2022
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Finaliza:</strong> 01/01/2023
                </p>
            </div>

            <p class='p-description-course-info'><strong>Descripción:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.
            </p>

            <p class='p-description-course-info'><strong>Requisitos:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <p class='p-description-course-info'><strong>Responsables:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Curso exclusivamente para:</strong> Alumnos
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Estado del curso:</strong> inactivo
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Cantidad de participantes:</strong> 32
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Paticipantes registrados:</strong> 30
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Costo unitario (MXN):</strong> $32.50
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Monto generado (MXN):</strong> $975.00
                </p>
            </div>
        </div>
        <!-- ======================== CONTENEDOR DE CURSOS CANCELADOS ======================= -->
        <div class='fields-middle third-middle'>
            <p class='p-instructions p-courses-info'>CURSOS CANCELADOS</p>
        </div>
        <div class='fields-middle container-info-course container-info-cancel-course'>
            <p class='p-name-course-info'> <strong> Curso de Verano </strong> <br>
                (<a href='https://cdn.pixabay.com/photo/2017/01/24/09/20/learn-2004905_960_720.png' target='_blank'>portada</a>)
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Inicia:</strong> 25/12/2022
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Finaliza:</strong> 01/01/2023
                </p>
            </div>

            <p class='p-description-course-info'><strong>Descripción:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.
            </p>

            <p class='p-description-course-info'><strong>Requisitos:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <p class='p-description-course-info'><strong>Responsables:</strong>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua.
            </p>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Curso exclusivamente para:</strong> Alumnos
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Estado del curso:</strong> cancelado
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Cantidad de participantes:</strong> 32
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Paticipantes registrados:</strong> 0
                </p>
            </div>

            <div class='fields-middle first-middle'>
                <p class='first-date-info'>
                    <strong>Costo unitario (MXN):</strong> $32.50
                </p>
            </div>
            <div class='fields-middle second-middle'>
                <p class='second-date-info'>
                    <strong>Monto generado (MXN):</strong> $0.00
                </p>
            </div>
        </div>
    </div>
    ";
?>