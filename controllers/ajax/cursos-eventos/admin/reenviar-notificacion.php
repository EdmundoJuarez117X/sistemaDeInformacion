<?php

    // requerimientos para PHP MAILER
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require_once "../../../../lib/PHPMailer/vendor/autoload.php";
    // requerir la base de datos
    require_once "../../../../model/connection.php";
    $db = $connection;
    
    // obtener el contenido
    $id_n = $_POST['idn']; // id notificacion
    $id_c = $_POST['idc']; //id curso
    $user = $_POST['user']; // tipo de usuario
    
    // los datos están vacios?
    if(!empty($id_n) and !empty($id_c) and !empty($user)) {
    /*----- si no están vacios genera el proceso de envio de notificaciones -----*/
        
    // obtener el datos del curso para enviarlo con un enlace
        $res_id = $db->query("SELECT 
        cursos.nombre_curso, cursos.descripcion_curso 
        FROM cursos WHERE cursos.id_curso = $id_c");
        
        if(!$res_id) {
            die("Error al obtener ID. Error: ". mysqli_error($db));
        }
        
        $data = $res_id->fetch_assoc();
        
        // obtenemos el nombre
        $name = $data['nombre_curso'];
        //obtenemos la descripcion
        $description = $data['descripcion_curso'];

        // url del sitio
        $enlace = "https://base4.mx/webapp01/views/cursos-eventos/users/comprar-curso.php?cso=".$id_c;

        // diseño de mensaje
        $html = '
            <div style="width:800px;height:auto;padding:15px;background:#f6f6f9;border-radius:8px">
                <div>
                    <h3 style="font-size:14px;">'.$name.'</h3>
                    <p style="font-size:13px;text-align:justify;">'.$description.'</p>
                </div>
                <div>
                    <br><br>
                    <button style="height:30px;width:150px;background:#47ABE2;border:none;border-radius:7px;margin-bottom: 10px;">
                        <a href="'.$enlace.'" target="_blank" style="color:#fff;font-size:13px;text-decoration:none;">VER CURSO</a>
                    </button>
                </div>
            </div>
        ';

    // obtener los correos del usuario especificado
        if($user == "alumno") {
            
            // Creamos la consulta para obtener el nombre completo y correos del tipo de usuario
            $query = "SELECT 
            alumno.nombre_alumno, alumno.segundo_nombreAlumno, alumno.apellido_paternoAlumno, alumno.apellido_maternoAlumno, alumno.email_alumno
            FROM alumno;";
            
            // ejecuta la consulta
            $res_email = $db->query($query);
            
            // comprueba si se ha sido exitoso
            if(!$res_email) {
                die("No se pudo consultar datos del usuario. Error: ". mysqli_error($db));
            }
            // verificar si existen usuarios registrados
            if($res_email->num_rows > 0) {
                // sentencia try-cathc para la creación y función de Mailer
                try {            
                    // enviar a todos los usuarios registrados
                    while ($users = $res_email->fetch_assoc()) {

                        // Crear una instancia de la clase PHPMailer
                        $mail = new PHPMailer();
                        
                        // Autentificación vía SMTP
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        
                        // Autenticación con SMTP
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = "465";
                        $mail->Username = "comunidad@seiko.global";
                        $mail->Password = "zwxatsizpdwnmmgt";
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                        $nombre_user = $users['nombre_alumno']. " ". $users['segundo_nombreAlumno']. " ". $users['apellido_paternoAlumno']. " ". $users['apellido_maternoAlumno'];
                        $destino = $users['email_alumno'];
                    
                        // DETINATARIO Y CUERPO EL MENSAJE
                        
                        // Remitente
                        $mail->setFrom('comunidad@seiko.global', 'SISESCOLAR');
                        
                        // Destinatario y cuerpo del mensaje
                        $mail->addAddress($destino, $nombre_user);
                        $mail->isHTML(true);
                        $mail->Subject = $name;
                        $mail->Body = $html;
                        
                        // COFICACIÓN DE CARACTERES
                        $mail->CharSet = 'UTF-8';
                        $mail->Encoding = 'base64';
                        
                        //ENVIAR EL CORREO
                        if(!$mail->send()){

                            $response = false;

                        } else {

                            $response = true;

                        }

                    } // END While
                    if($response == true) {
                        
                        // consulta para eliminar la notificacion
                        $delete = $db->query("DELETE FROM notificacion_curso WHERE notificacion_curso.id_notificacion_curso = $id_n");
                        
                        if(!$delete) {
                            die("No se pudo eliminar notificacion. Error: ". mysqli_error($db));
                        }

                        echo 1;

                    }else {

                        $notificacion = "No se pudo enviar a alumnos"; // no enviado a todos los usuarios
                        // consulta para editar la notificaciones
                        $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                        $notify = $db->query($sql);
                        if(!$notify) {
                            die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                        }
                        echo $notificacion;

                    }
                } catch (Exception $e) {

                    $notificacion = "Proceso de correos fallido";
                    // consulta para editar la notificaciones
                    $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                    $notify = $db->query($sql);
                    if(!$notify) {
                        die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                    }
                    echo $notificacion;

                }

            } else {

                $notificacion = "Sin alumnos a notificar";
                // consulta para editar la notificaciones
                $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                $notify = $db->query($sql);
                if(!$notify) {
                    die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                }
                echo $notificacion;

            } // endIF alumnos

        } else if($user = "docente") {
            // ENVIAR A TODOS LOS DOCENTES
            
            // Creamos la consulta para obtener el nombre completo y correos del tipo de usuario
            $query = "SELECT 
            docente.nombre_docente, docente.segundo_nombreDocente, docente.apellido_paternoDocente, docente.apellido_maternoDocente, docente.email_docente
            FROM docente;";
            
            // ejecuta la consulta
            $result = $db->query($query);
            
            // comprueba si se ha sido exitoso
            if(!$result) {

                die("No se pudo consultar datos del docente. Error: ". mysqli_error($db));

            }
            
            // verificar si existen usuarios registrados
            if($result->num_rows > 0) {
                
                // sentencia try-cathc para la creación y función de Mailer
                try {           
                    
                    // enviar a todos los usuarios registrados
                    while ($users = $result->fetch_assoc()) {

                         // Crear una instancia de la clase PHPMailer
                         $mail = new PHPMailer();
                         
                         // Autentificación vía SMTP
                         $mail->isSMTP();
                         $mail->SMTPAuth = true;
                         
                         // Autenticación con SMTP
                         $mail->Host = "smtp.gmail.com";
                         $mail->Port = "465";
                         $mail->Username = "comunidad@seiko.global";
                         $mail->Password = "zwxatsizpdwnmmgt";
                         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                         
                         $nombre_user = $users['nombre_docente']. " ". $users['segundo_nombreDocente']. " ". $users['apellido_paternoDocente']. " ". $users['apellido_maternoDocente'];
                         $destino = $users['email_docente'];
                     
                         // DETINATARIO Y CUERPO EL MENSAJE
                         
                         // Remitente
                         $mail->setFrom('comunidad@seiko.global', 'SIS-ESCOLAR');
                         
                         // Destinatario y cuerpo del mensaje
                         $mail->addAddress($destino, $nombre_user);
                         $mail->isHTML(true);
                         $mail->Subject = $name;
                         $mail->Body = $html;
                         $mail->AltBody = 'El texto como elemento de texto simple';
                         
                         // COFICACIÓN DE CARACTERES
                         $mail->CharSet = 'UTF-8';
                         $mail->Encoding = 'base64';
                         
                         //ENVIAR EL CORREO
                         if(!$mail->send()){

                             $response = false;

                         } else {

                             $response = true;

                         }

                    } // END While
                    
                    if($response == true) {

                        // consulta para eliminar la notificacion
                        $delete = $db->query("DELETE FROM notificacion_curso WHERE notificacion_curso.id_notificacion_curso = $id_n");
                        
                        if(!$delete) {
                            die("No se pudo eliminar notificacion. Error: ". mysqli_error($db));
                        }
                        
                        echo 1;
 
                    }else {

                        $notificacion = "No se pudo enviar a docentes"; // no enviado a todos los usuarios
                        // consulta para editar la notificaciones
                        $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                        $notify = $db->query($sql);
                        if(!$notify) {
                            die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                        }
                        echo $notificacion;

                    }
                } catch (Exception $e) {

                    $notificacion = "Proceso de correos fallido";
                    // consulta para editar la notificaciones
                    $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                    $notify = $db->query($sql);
                    if(!$notify) {
                        die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                    }
                    echo $notificacion;

                }
            } else {

                $notificacion = "Sin docentes a notificar";
                // consulta para editar la notificaciones
                $sql = "UPDATE notificacion_curso SET descripcion_notificacion = '$notificacion' WHERE notificacion_curso.id_notificacion_curso = $id_n";
                $notify = $db->query($sql);
                if(!$notify) {
                    die("No se pudo crear notificacion. Error: ". mysqli_error($db));
                }
                echo $notificacion;

            }
        }// endIF docentes

    } else {
        echo "Envío Fallido. No se pudo obtener datos del curso.";
    }

?>