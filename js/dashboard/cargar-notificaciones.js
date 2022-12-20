$(function() {
    // Nota: EN EL FTP, LAS CONDICIONALES CON CADENAS DE TEXTO NO SON VÁLIDAD, USE NÚMEROS
    // al iniciar la interfaz, carga los datos dela tabla de cursos
    console.log("JQuery is ready");
    mostrarNotificaciones();

    // ====================== MOSTRAR NOTIFICACIONES ======================== //
    function mostrarNotificaciones() {
        $.ajax({
            type: 'GET',
            url: '../../controllers/ajax/cursos-eventos/admin/notificaciones.php',
            success: function(response) {
                let notificaciones = JSON.parse(response);
                let template = '';

                notificaciones.forEach(noti => {

                    if(noti.des == "CPD") {
                        template += `
                        <div class="update" id_n="${noti.id}" id_c="${noti.id_c}" user="${noti.rol}">
                            <div class="message">
                                <p><b>${noti.name}</b><br>
                                    El curso se vence hoy. Edita la fecha final en el formulario de actualización.
                                    <div>
                                        <a class="btn-actions-notify" href="../cursos-eventos/admin/actualizar-curso.php?cso=${noti.id_c}"><span class="material-icons-sharp">edit</span></a>
                                        <button class="btn-actions-notify" id="btn-delete-notify"><span class="material-icons-sharp">delete</span></button>
                                    </div>
                                </p>       
                            </div>
                        </div>
                        `
                    } else if(noti.des == "CD") {
                        template += `
                        <div class="update" id_n="${noti.id}" id_c="${noti.id_c}" user="${noti.rol}">
                            <div class="message">
                                <p><b>${noti.name}</b><br>
                                    El curso se ha desactivado ya que las fechas han vencido. Puedes editar la fecha final en el formulario de actualización.
                                    <div>
                                        <a class="btn-actions-notify" href="../cursos-eventos/admin/actualizar-curso.php?cso=${noti.id_c}"><span class="material-icons-sharp">edit</span></a>
                                        <button class="btn-actions-notify" id="btn-delete-notify"><span class="material-icons-sharp">delete</span></button>
                                    </div>
                                </p>       
                            </div>
                        </div>
                        `
                    } else {
                        template += `
                        <div class="update" id_n="${noti.id}" id_c="${noti.id_c}" user="${noti.rol}">
                                <div class="message">
                                    <p><b>${noti.name}</b><br>
                                        ${noti.des}
                                        <div>
                                            <button class="btn-actions-notify" id="btn-send-notify-again"><span class="material-icons-sharp">send</span></button>
                                            <button class="btn-actions-notify" id="btn-delete-notify"><span class="material-icons-sharp">delete</span></button>
                                        </div>
                                </p>       
                            </div>
                        </div>
                        `
                    }
                });
                $('#notificaciones-de-cursos').html(template);
            }
        });
    }

    // ====================== BORRAR NOTIFICACIONES ======================== //
    $(document).on('click', '#btn-delete-notify', function(){
        // obtenemos toda la fila del botón cliqueado
        let element = $(this)['0'].parentElement.parentElement.parentElement;
        let id = $(element).attr('id_n'); // id de la notificacion
        
        $.ajax({
            type: 'POST',
            url: "../../controllers/ajax/cursos-eventos/admin/eliminar-notificacion.php",
            data: "id="+id,
            success: function(response) {
                if(response == 1) {
                    mostrarNotificaciones();
                } else if(response == 2) {
                    swal("Algo salió mal","No se pudo eliminar la notificacion","error");
                }
            }
        });
        
    });

    // ====================== REENVIAR NOTIFICACIONES ======================== //
    $(document).on('click', '#btn-send-notify-again', function(){
        // obtenemos toda la fila del botón cliqueado
        let element = $(this)['0'].parentElement.parentElement.parentElement;
        let idn = $(element).attr('id_n'); //id de la notificacion
        let id_c = $(element).attr('id_c'); // id del curso
        let user = $(element).attr('user'); // id del curso
        
        $.ajax({
            type: 'POST',
            url: "../../controllers/ajax/cursos-eventos/admin/reenviar-notificacion.php",
            data: "idn="+idn+"&idc="+id_c+"&user="+user,
            success: function(response) {
                if(response == 1) {
                    mostrarNotificaciones();
                } else {
                    swal(response);
                    mostrarNotificaciones();
                }
            }
        });
        
    });

});