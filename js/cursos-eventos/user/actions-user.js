$(function() {

    mostrarMisCursos();
    mostrarCursosUser();
    historialCursos();
    // ====================== MOSTRAR LOS CURSOS REGISTRADOS EN LA INTERFAZ DEL ALUMNO-DOCENTE ======================== //
    function mostrarCursosUser() {
        $.ajax({
            type: 'GET',
            url: '../../../controllers/ajax/cursos-eventos/users/cursos-registrados.php',
            success: function(response) {
                let cursos = JSON.parse(response)
                // variable para almacenar informacion
                let template = '';
                // bucle para imprimir cada dato en el template
                cursos.forEach(curso => {
                    template += `
                        <a href="comprar-curso.php?cso='${curso.id}'" target="_blank">
                            <div class="courses">
                                <div class="profile-photo">
                                    <img src="../../../img/cursos-eventos/notify.svg" alt="">
                                </div>
                                <div class="message">
                                    <p><b>${curso.nombre}</b><br>${curso.descripcion}</p>
                                    <small class="text-muted"><strong> $${curso.costo}</strong></small>
                                    
                                </div>
                            </div>
                        </a>
                    `
                });
                // imprmimos el contenido
                $('#cursos-registrados-users').html(template);
            }
        });
    }

    // ====================== MIS CURSOS ======================== //
    function mostrarMisCursos() {
        $.ajax({
            type: 'GET',
            url: '../../../controllers/ajax/cursos-eventos/users/mis-cursos.php',
            success: function(response) {
                let cursos = JSON.parse(response);
                // variable para almacenar en HTML
                let template = '';
                //bubcle para rellenar
                cursos.forEach(curso => {
                    template += `
                    <a href="info-mi-curso.php?id=${curso.id}">
                        <div class="update">
                            <div class="profile-photo">
                                <img src="../../../img/cursos-eventos/bibliophile.svg" alt="">
                            </div>
                            <div class="message">
                                <p><b> ${curso.nombre} </b>  </p>
                                <small class="text-muted"> ${curso.fecha} </small>
                            </div>
                        </div>
                    </a>
                    `
                });
                //imprime el contenido
                $('#my-courses-user').html(template);
            }
        });
    }

    // ====================== TABLA MIS CURSO ======================== //
    function historialCursos() {
        $.ajax({
            type: 'GET',
            url: '../../../controllers/ajax/cursos-eventos/users/historial-cursos.php',
            success: function(response) {
                let cursos = JSON.parse(response);
                let template = '';

                cursos.forEach(curso => {
                    template += `
                    <tr>
                        <td>
                            <a class='a-curso-info' href="info-mi-curso.php?id=${curso.idCompra}"> ${curso.nombre} </a>
                        </td>
                        <td> $${curso.costo} </td>
                        <td> ${curso.boletos} </td>
                        <td> $${(curso.costo)*(curso.boletos)}</td>
                        <td> ${curso.idCompra} </td>
                        <td> ${curso.fecha} </td>
                        <td><a class='a-span-edit' href="../../archivos-pdf-php/ticket-${curso.rol}.php?cra=${curso.idCompra}" target="_blank"><span class='material-icons-sharp'>description</span></a></td>
                    </tr>
                    `
                });
                $('#table-mis-cursos').html(template);
            }
        });
    }

})