$(function() {
    // Nota: EN EL FTP, LAS CONDICIONALES CON CADENAS DE TEXTO NO SON VÁLIDAD, USE NÚMEROS
    // al iniciar la interfaz, carga los datos dela tabla de cursos
    console.log("JQuery is ready");
    mostrarCursos();
    mostrarNotificaciones();
    desCurso();
    // ====================== REGISTRAR CURSO ======================== //
    $('#btn-register-course').click(function(){
        // obtenemos el contenido de las IDs
        var name = document.getElementById('course_name').value;
        var description = document.getElementById('course_description').value;
        var requirements = document.getElementById('course_requirements').value;
        var responsible = document.getElementById('course_responsible').value;
        var participantes = document.getElementById('total_participantes').value;
        var costo = document.getElementById('costo_unitario').value;
        var user = document.getElementById('select_user').value;
        var dInitial = document.getElementById('date_initial').value;
        var dEnd = document.getElementById('date_end').value;
        var status = document.getElementById('select_status').value;
        
        // condicionamos si todos los campos contienen información
        if(name == "" || description == "" || requirements == "" || responsible == "" || participantes == "" || costo == "" || dInitial == "" 
        || dEnd == "") {
            swal("Datos incompletos", "Asegúrese de llenar todos los campos", "warning");
        } else {
            if(costo < 10) {
                swal("Precio bajo", "Por cada compra que se realiza al comprar un curso, Stripe cobra comisiones. Ingresa un precio mayor o igual a 10 pesos.", "warning");
            } else {
                // grupo de datos a enviar en la URL
                var datas = "nam="+name+"&des="+description+"&req="+requirements+"&res="+responsible+"&ptes="+participantes+"&cos="+costo+"&user="+user+"&dIni="+dInitial+"&dEnd="+dEnd+"&stus="+status;
                // prepramos el envío para php
                $.ajax({
                    url: '../../../controllers/ajax/cursos-eventos/admin/registrar-curso.php',
                    type: 'POST',
                    data: datas,
                    success: function(data) {
                        console.log(data);
                        // verficamos y condicionamos la respuesta desde registrar-curso.php
                        if(data == 4) {
                            // advertencia
                            swal("Datos incompletos", "Asegúrese de llenar todos los campos", "warning");
                        }
                        if(data == 3) {
                            // error de fechas
                            swal("Fechas incorrectas", "Debe agregar una fecha mayor o igual a la actual", "warning");
                        }
                        if(data == 2) {
                            // error de transacción
                            swal("Algo salió mal", "Inténtalo más tarde", "error");
                        }
                        if(data == 1) {
                            // éxito
                            swal({
                                title: "Curso registrado exitosamente",
                                text: "¿Desea notificar el nuevo curso?",
                                icon: "success",
                                buttons: true,
                                true: true,
                            })
                            .then((willNotify) => {
                                if (willNotify) {
                                    $.ajax({
                                        type: 'POST',
                                        url: '../../../controllers/ajax/cursos-eventos/admin/enviar-notificacion.php',
                                        data: "user="+user+"&cso="+name+"&des="+description,
                                        success: function(response) {
                                            swal(response);
                                            mostrarNotificaciones();
                                            document.getElementById('course_name').value = "";
                                            document.getElementById('course_description').value = "";
                                            document.getElementById('course_requirements').value = "";
                                            document.getElementById('course_responsible').value = "";
                                            document.getElementById('total_participantes').value = "";
                                            document.getElementById('costo_unitario').value = "";
                                            document.getElementById('date_initial').value = "";
                                            document.getElementById('date_end').value = "";
                                        }
                                    });
                                    
                                } else {
                                    console.log("Datos de envío: " , user , " ", name);
                                    $.ajax({
                                        type: 'POST',
                                        url: '../../../controllers/ajax/cursos-eventos/admin/agregar-notificacion.php',
                                        data: "user="+user+"&cso="+name,
                                        success: function(response) {
                                            if(response == 1) {
                                                mostrarNotificaciones();
                                                document.getElementById('course_name').value = "";
                                                document.getElementById('course_description').value = "";
                                                document.getElementById('course_requirements').value = "";
                                                document.getElementById('course_responsible').value = "";
                                                document.getElementById('total_participantes').value = "";
                                                document.getElementById('costo_unitario').value = "";
                                                document.getElementById('date_initial').value = "";
                                                document.getElementById('date_end').value = "";
                                            }else if(response == 2) {
                                                swal("No pudo crear notificacion","Los datos estan vacíos","error");
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            }
        }
    });

    // ====================== ACTUALIZAR CURSO ======================== //
    $('#btn-save-changes').click(function(){
        // obtenemos el contenido de las IDs
        var id = document.getElementById('id_course').value;
        var name = document.getElementById('course_name').value;
        var description = document.getElementById('course_description').value;
        var requirements = document.getElementById('course_requirements').value;
        var responsible = document.getElementById('course_responsible').value;
        var participantes = document.getElementById('total_participantes').value;
        var registrados = document.getElementById('participantes_registrados').value;
        var costo = document.getElementById('costo_unitario').value;
        var user = document.getElementById('select_user').value;
        var dInitial = document.getElementById('date_initial').value;
        var dEnd = document.getElementById('date_end').value;
        var status = document.getElementById('select_status').value;
        //var image = document.getElementById('course_image').value;

        // condicionamos si todos los campos contienen información
        if(name == "" || description == "" || requirements == "" || responsible == "" || participantes == "" || costo == "" || dInitial == "" 
        || dEnd == "") {
            swal("Datos incompletos", "Asegúrese de llenar todos los campos", "warning");
        } else {
            if(costo < 10) {
                swal("Precio bajo", "Por cada compra que se realiza al comprar un curso, Stripe cobra comisiones. Ingresa un precio mayor o igual a 10 pesos.", "warning");
            } else {
                // verificamos el estado del curso
                if(status == "activo") {
                    // grupo de datos a enviar en la URL
                    var datas = "id="+id+"&nam="+name+"&des="+description+"&req="+requirements+"&res="+responsible+"&ptes="+participantes+"&cos="+costo+"&user="+user+"&dIni="+dInitial+"&dEnd="+dEnd+"&stus="+status;//+"&img="+image;
                    // llamamos la funcion de actualizacion
                    enviarActualizacion(datas, name, description, user);
                    
                } else if(status == "inactivo") {
                    // si existen usuarios registrados
                    if(registrados > 0) {
                        // preguntar si queremos desactivar el curso con usuario registrados
                        swal({
                            title: "El curso contiene usuarios registrados",
                            text: "¿Está seguro de desactivarlo?",
                            icon: "warning",
                            buttons: true,
                            true: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                // grupo de datos a enviar en la URL
                                var datas = "id="+id+"&nam="+name+"&des="+description+"&req="+requirements+"&res="+responsible+"&ptes="+participantes+"&cos="+costo+"&user="+user+"&dIni="+dInitial+"&dEnd="+dEnd+"&stus="+status;//+"&img="+image;
                                // si se acepta la condicion llamamos la funcion y enviamos los datos
                                enviarActualizacion(datas, name, description, user);
                                
                            } else {
                                swal("Se descartaron los cambios");
                            }
                        });
                    }
                    // si no existen usuarios registrados
                    else {
                        // grupo de datos a enviar en la URL
                        var datas = "id="+id+"&nam="+name+"&des="+description+"&req="+requirements+"&res="+responsible+"&ptes="+participantes+"&cos="+costo+"&user="+user+"&dIni="+dInitial+"&dEnd="+dEnd+"&stus="+status;//+"&img="+image;
                        // si se acepta la condicion llamamos la funcion y enviamos los datos
                        enviarActualizacion(datas, name, description, user);
                        
                    }
                }
            }
        }
    });
    // ====================== FUNCION PARA ENVIAR DATOS DE ACTUALIZACIÓN ======================== //UALIZACION
    function enviarActualizacion(data, name, description, user) {
        // prepramos el envío para php
        $.ajax({
            url: '../../../controllers/ajax/cursos-eventos/admin/actualizar-curso.php',
            type: 'POST',
            data: data,
            success: function(reponse) {
                // verficamos y condicionamos la respuesta desde registrar-curso.php
                if(reponse == 4) {
                    // advertencia
                    swal("Datos incompletos", "Asegúrese de llenar todos los campos", "warning");
                } else if(reponse == 3) {
                    // error de fechas
                    swal("Fechas caducadas", "Debe agregar fechas mayor o igual a la actual", "warning");
                } else if(reponse == 2) {
                    // error de transacción
                    swal("Algo salió mal", "Inténtalo más tarde", "error");
                }else if(reponse == 1) {
                    // éxito
                    swal("", "Cambios guardados exitosamente", "success");
                    mostrarNotificaciones();
                } else if(reponse == 11) {
                    // éxito con cambio de usuario
                    swal({
                        title: "Cambios guardados exitosamente",
                        text: "Se cambió el usuario de destino ¿Desea notificar a los usuarios?",
                        icon: "success",
                        buttons: true,
                        true: true,
                    })
                    .then((willNotify) => {
                        if (willNotify) {
                            $.ajax({
                                type: 'POST',
                                url: '../../../controllers/ajax/cursos-eventos/admin/enviar-notificacion.php',
                                data: "user="+user+"&cso="+name+"&des="+description,
                                success: function(response) {
                                    swal(response);
                                    mostrarNotificaciones();
                                }
                            });
                            
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: '../../../controllers/ajax/cursos-eventos/admin/agregar-notificacion.php',
                                data: "user="+user+"&cso="+name,
                                success: function(response) {
                                    if(response == 1) {
                                        mostrarNotificaciones();
                                    }else if(response == 2) {
                                        swal("No pudo crear notificacion","Los datos estan vacíos","error");
                                    }
                                }
                            });
                        }
                    });
                }
            }
        });
    } 
    // FIN DE FUNCION

    // ====================== MOSTRAR CURSOS EN TABLA ======================== //
    function mostrarCursos() {
        $.ajax({
            url: '../../../controllers/ajax/cursos-eventos/admin/obtener-cursos-registrados.php',
            type: 'GET',
            success: function(response) {
                let cursos = JSON.parse(response);
                // variable para almacenar cada uno de los campos html
                let template = '';
                // mediante un ciclo, guardamos en template todos los campos que obtenemos del script php
                cursos.forEach(curso => {
                    template += `
                    <tr courseId='${curso.id}' users='${curso.registrados}' status='${curso.estatus}'>
                        <td>
                            <a class='a-curso-info' href="info-curso.php?cso='${curso.id}'" style='color:#47ABE2;font-weight:500;'> ${curso.nombre} </a>
                        </td>
                        <td> ${curso.participantes} </td>
                        <td><a target="__blank" href="../../archivos-pdf-php/${curso.rol}s-registrados-pdf.php?cso='${curso.id}'" style='color:#47ABE2;font-weight:550;'> ${curso.registrados} </a></td>
                        <td>$${curso.costo} </td>
                        <td> ${curso.estatus} </td>
                        <td><a class='a-span-edit' href="actualizar-curso.php?cso='${curso.id}'"><span class='material-icons-sharp'>edit</span></a></td>
                        <td><button class='course-visibility btn-visible-course'><span class='material-icons-sharp'>visibility</span></button></td>
                    </tr>
                    `
                });
                //imprimos en el Id de la tabla el contenido del template
                $('#table-container').html(template);
            }
        });
    }

    // ====================== MOSTRAR DATOS DE REPORTES PERIODOS ======================== //
    $('#btn-see-info').click(function(){
        //obtenemos el id del elemento dentro del select option
        var report_period = document.getElementById("report_period").value;
        //iniciamos el envío de de datos
        if(report_period == "op1" || report_period == "op2" || report_period == "op3") {
            let datas = "pdo="+report_period;
            $.ajax({    
                type: "POST",
                url: "../../../controllers/ajax/cursos-eventos/admin/backend-reportes.php",
                data: datas,                 
                success: function(response){
                    $("#report-courses-info").html(response);
                }
            });
        } else if(report_period == "op4") {
            $.ajax({    
                type: "GET",
                url: "../../../controllers/ajax/cursos-eventos/admin/mostrar-inputs-filtrado-fecha.php",      
                dataType: "html",                  
                success: function(response){                    
                    $("#show-inputs-data-filter").html(response); 
                }
            });
        }
    });

    // ====================== MOSTRAR DATOS DE REPORTES FECHAS FILTRADAS======================== //
    $(document).on('click', '#btn-filter-dates', function(){
        // obtener las fechas
        var dInitial = document.getElementById('course_date_inicial').value;
        var dFinal = document.getElementById('course_date_final').value;
        // condicionamos no hay fechas vacias
        if(dInitial == "" || dFinal == "") {
            swal("Fechas incompletas", "Debe ingresar una fecha inicial y final", "warning");
        } else {
            // generamos el paquete de datos
            var datas = "dIni="+dInitial +"&dFin="+dFinal;
            // generamos la función para enviar y recibir respuesta
            $.ajax({
                type: 'POST',
                url: '../../../controllers/ajax/cursos-eventos/admin/backend-cursos-filtrados.php',
                data: datas,
                success: function(response) {
                    $("#report-courses-info").html(response);
                }
            });
        }
    });

    // ====================== ACTIVAR Y DESACTIVAR CURSO ======================== //
    $(document).on('click', '.course-visibility', function() {
        // obtenemos toda la fila del botón cliqueado
        let element = $(this)['0'].parentElement.parentElement;
        // obtenemos la cantidad de usuarios registrados
        let users = $(element).attr('users');
        // obtenemos el estado del curso
        let status = $(element).attr('status');
        // obtenemos el id del atributo que se le asigna al <tr>
        let id = $(element).attr('courseId');

        // si el curso no tiene usuarios registrados -> ACTÍVALO/DESACTÍVALO
        if(users == 0) {
            if (status == "activo") {
                // mandamos el ID al script de php para modificarlo
                $.post('../../../controllers/ajax/cursos-eventos/admin/activar-desactivar.php', {id}, function(response) {
                    mostrarCursos();
                });
            }
            else if (status == "inactivo") {
                $.ajax({
                    type: 'POST',
                    url : '../../../controllers/ajax/cursos-eventos/admin/activar-users-registed.php',
                    data: "id="+id,
                    success: function(response) {
                        if(response == 2) {
                            // error de transacción
                            swal("Fechas caducadas", "El curso ha estado mucho tiempo desactivado, actualiza las fechas.", "error");
                        } else if(response == 1) {
                            mostrarCursos();
                        }
                    }
                });
            }
        // si el curso tiene usuarios registrados y está en estado "activo" -> DESACTÍVALO
        } else if(users > 0) {
            if(status == "activo") {
                // preguntamos si realmente queremos hacer cambios mediante Sweet Alert
                swal({
                    title: "El curso contiene usuarios registrados",
                    text: "¿Está seguro de desactivarlo?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // mandamos el ID al script de php para modificarlo
                        $.post('../../../controllers/ajax/cursos-eventos/admin/activar-desactivar.php', {id}, function(response) {
                            mostrarCursos();
                        });
                    } else {}
                });

            /* si el curso tiene usuarios registrados pero está "inactivo" verfica las fechas si no están CADUCADAS
            de no estarlo, ACTIVA el curso. De lo contrario solicita la actualización de fechas */
            } else if(status == "inactivo") {
                // mandamos el ID al script de php para modificarlo
                $.ajax({
                    type: 'POST',
                    url : '../../../controllers/ajax/cursos-eventos/admin/activar-users-registed.php',
                    data: "id="+id,
                    success: function(response) {
                        if(response == 2) {
                            // error de transacción
                            swal("Fechas caducadas", "El curso ha estado mucho tiempo desactivado, actualiza las fechas.", "error");
                        } else if(response == 1) {
                            mostrarCursos();
                        }
                    }
                });
            }
        } // endif
    });

    // ====================== COMPRAS ALUMNOS ======================== //
    $(document).on('click', '#btn-compras-alumnos', function() {
        $.ajax({    
            type: "GET",
            url: "../../../controllers/ajax/cursos-eventos/admin/compras-alumnos.php",                
            success: function(response){
                if(response == 2) {
                    $("#table-container-compras").html("No se encontraron compras");
                } else {
                    let compras = JSON.parse(response);
                    let template = '';

                    compras.forEach(com => {
                        template += `
                        <tr>
                            <td> ${com.idac} </td>
                            <td> ${com.ida} </td>
                            <td>${com.idc}</td>
                            <td>${com.cb}</td>
                            <td>$${(com.cb) * (com.costo)}</td>
                            <td>${com.fcac}</td>
                            <td><a class='a-span-edit' href='../../archivos-pdf-php/ticket-alumno.php?cra=${com.idac}' target='_blank'>
                                <span class='material-icons-sharp'>description</span>
                            </a></td>
                        </tr>
                        `;
                    });
                    $("#table-container-compras").html(template);
                }
            }
        });
    });

    // ====================== COMPRAS DOCENTES ======================== //
    $(document).on('click', '#btn-compras-docentes', function() {
        $.ajax({    
            type: "GET",
            url: "../../../controllers/ajax/cursos-eventos/admin/compras-docentes.php",                
            success: function(response){
                if(response == 2) {
                    $("#table-container-compras").html("No se encontraron compras");
                } else {
                    let compras = JSON.parse(response);
                    let template = '';

                    compras.forEach(com => {
                        template += `
                        <tr>
                            <td> ${com.idac} </td>
                            <td> ${com.ida} </td>
                            <td>${com.idc}</td>
                            <td>${com.cb}</td>
                            <td>$${(com.cb) * (com.costo)}</td>
                            <td>${com.fcac}</td>
                            <td><a class='a-span-edit' href='../../archivos-pdf-php/ticket-docente.php?cra=${com.idac}' target='_blank'>
                                <span class='material-icons-sharp'>description</span>
                            </a></td>
                        </tr>
                        `;
                    });
                    $("#table-container-compras").html(template);
                }
            }
        });
    });

    // ====================== MOSTRAR NOTIFICACIONES ======================== //
    function mostrarNotificaciones() {
        $.ajax({
            type: 'GET',
            url: '../../../controllers/ajax/cursos-eventos/admin/notificaciones.php',
            success: function(response) {
                let notificaciones = JSON.parse(response);
                let template = '';
                let template1 = '';
                let template2 = '';

                notificaciones.forEach(noti => {

                    if(noti.des == "CPD") {
                        template += `
                        <div class="update" id_n="${noti.id}" id_c="${noti.id_c}" user="${noti.rol}">
                            <div class="message">
                                <p><b>${noti.name}</b><br>
                                    El curso se vence hoy. Edita la fecha final en el formulario de actualización.
                                    <div>
                                        <a class="btn-actions-notify" href="actualizar-curso.php?cso=${noti.id_c}"><span class="material-icons-sharp">edit</span></a>
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
                                        <a class="btn-actions-notify" href="actualizar-curso.php?cso=${noti.id_c}"><span class="material-icons-sharp">edit</span></a>
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
            url: "../../../controllers/ajax/cursos-eventos/admin/eliminar-notificacion.php",
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
            url: "../../../controllers/ajax/cursos-eventos/admin/reenviar-notificacion.php",
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

    // ====================== MOSTRAR GRÁFICA MÁS VENDIDOS ===================//
    $(document).on('click', '#btn-mas-vendidos', function() {
        var masVendidos = 1;
        $.ajax({
            url: '../../../controllers/ajax/cursos-eventos/admin/grafica-mas-menos-vendidos.php',
            type: 'POST',
            data: 'type='+masVendidos,
        }).done(function(e){
            if(e.length > 0) {

                var curso = [];
                var total_accesos = [];
                var data = JSON.parse(e);

                for(var i = 0; i < data.length; i++) {

                    curso.push(data[i][0]);
                    total_accesos.push(data[i][1]);
                }
                crearGrafico(curso, total_accesos, "CURSOS MÁS VENDIDOS");
            }
        });
    });

    // ====================== MOSTRAR GRÁFICA MENOS VENDIDOS ===================//
    $(document).on('click', '#btn-menos-vendidos', function() {
        var menosVendidos = 2;
        $.ajax({
            url: '../../../controllers/ajax/cursos-eventos/admin/grafica-mas-menos-vendidos.php',
            type: 'POST',
            data: 'type='+menosVendidos,
        }).done(function(e){
            if(e.length > 0) {

                var curso = [];
                var total_accesos = [];
                var data = JSON.parse(e);

                for(var i = 0; i < data.length; i++) {

                    curso.push(data[i][0]);
                    total_accesos.push(data[i][1]);
                }
                crearGrafico(curso, total_accesos, "CURSOS MENOS VENDIDOS");
            }
        });
    });

    // ====================== FUNCIÓN PARA GRÁFICAS ======================== //
    let myChart;
    function crearGrafico(nombre_curso, total_accesos, encabezado) {
            
        /*const ctx = document.getElementById('myChart');
        if (myChart) {
            myChart.destroy();
        }
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: nombre_curso,
                datasets: [{
                    label: encabezado,
                    data: total_accesos,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        stacked: true
                    }
                }
            }
        });*/
        const ctx = document.getElementById('myChart');

        if (myChart) {
            myChart.destroy();
        }
        myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: nombre_curso,
            datasets: [{
              label: encabezado,
              data: total_accesos,
              backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });  
    }

    // ==================== FUNCIÓN PARA ACTIVAR LA DESACTIVACIÓN DE CURSOS ========== //
    function desCurso() {
        $.ajax({
            url: '../../../controllers/ajax/cursos-eventos/admin/desactivar-curso.php',
            success: function(response) {
                //console.log(response);
                mostrarNotificaciones();
            }
        });
    }

});