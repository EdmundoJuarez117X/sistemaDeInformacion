<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../../index.php");
    }
    // requerimientos para PHP MAILER
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once "../../../../lib/PHPMailer/vendor/autoload.php";
    // requirimientos para STRIPE
    require_once('../../../../lib/STRIPE/vendor/autoload.php');
    // base de datos
    include('../../../../model/connection.php');
    $db = $connection;
    // clave secreta de Stripe
    \Stripe\Stripe::setApiKey('sk_test_51J1NoGIk4HpdCTxAAEJCoMK840QoHY38BSMzrh3NWZysyWi2YJStkCKQt4hEl2NKgL2QPV1dqtEn0pteZNzfr0Cg00I1qHWCR4');

//Desinfectar matriz POST

    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $id_curso = $_POST['id_curso'];
    $nombre_curso = $_POST['nombre_curso'];
    $costo = $_POST['costo'];
    $first_name = $POST['nombre_cliente'];
    $last_name = $POST['apellido_cliente'];
    $email = $POST['email'];
    $btos = $_POST['boletos'];
    $token = $POST['stripeToken'];

    //Crear un cliente en Stripe
    $customer = \Stripe\Customer::create(array(
        "email" => $email,
        "source" => $token
    ));

    // Proceso de pago en Stripe para el dashboard
    $charge = \Stripe\Charge::create(array(
        "amount" => (($btos)*($costo))*(100),
        "currency" => "mxn",
        "description" => $nombre_curso,
        "customer" => $customer->id
    ));
/* ====================== PROCESO DE INSERCIÓN DE COMPRA DEL USUARIO ==================== */
    //fecha actual
    date_default_timezone_set("America/Mexico_City");
    $date = date("Y-m-d H:i:s");
    $fecha = date("d-m-Y H:i");

    // OBTENER EL ID DEL USUARIO
    if($_SESSION['subMat'] == "Al") {

        $id_user = $_SESSION["id_alumno"];
        $nombre = $_SESSION['nombre_alumno']." ". $_SESSION['apellido_paternoAlumno'];
        // query para insertar tu compra
        $query_a_c = "INSERT INTO
        alumno_curso (id_alumno_curso, descripcion_pago, cantidad_boletines, f_creacion_al_cur, id_alumno, id_curso)
        VALUES ('$charge->id', 'PAGADO', '$btos', '$date', $id_user, $id_curso);";

    } else if($_SESSION['subMat'] == "DOC") {

        $id_user = $_SESSION['id_docente'];
        $nombre = $_SESSION['nombre_docente']." ". $_SESSION['apellido_paternoDocente'];
        // query para insertar tu compra
        $query_a_c = "INSERT INTO
        docente_curso (id_docente_curso, descripcion_pago, cantidad_boletines, f_creacion_doc_cur, id_docente, id_curso)
        VALUES ('$charge->id', 'PAGADO', '$btos', '$date', $id_user, $id_curso);";

    }
    // query para insertar los acceso que compraste
    $result_c = $db->query("UPDATE cursos SET participantes_registrados = participantes_registrados+$btos WHERE cursos.id_curso = $id_curso;");
    if(!$result_c) {
        die("No se pudo actualizar los accesos registrados. Error: ". mysqli_error($db));
    }
    // ejecutamos la consulta
    $result = $db->query($query_a_c);
    // ejecutamos sentencia
    if(!$result) {
        // enviamos el mensaje del correo con la información de la compra
        $mensaje = "Tu compra no pudo registrarse en el sistema, pero pudimos obtener información sobre la misma:";
        enviarInfoCompra($mensaje, $nombre, $email, $nombre_curso, $charge->id, $btos, $fecha, $costo);
        header('Location: ../../../../views/cursos-eventos/users/fallido.php?mail='.$email.'&product='.$charge->description.'&date='.$date);
    } else {
        // enviamos el mensaje del correo con la información de la compra
        $mensaje = "Tu compra ha sido exitosa, estos son tus datos:";
        enviarInfoCompra($mensaje, $nombre, $email, $nombre_curso, $charge->id, $btos, $fecha, $costo);
        // Redireccionando a la página de un pago satisfactorio
        header('Location: ../../../../views/cursos-eventos/users/success.php?tid='.$charge->id.'&product='.$charge->description.'&mail='.$email);
    }
/* ====================== FIN ==================== */
/* ====================== PROCESO DE ENVIO DE INFORMACION DE COMPRA ==================== */
    function enviarInfoCompra($mensaje, $nombre, $email, $nombre_curso, $id_compra, $btos, $fecha, $costo) {
        // diseño de mensaje
        $html = '
            <div style="width:700px;height:auto;padding:15px;background:#dce1eb;border-radius:10px">
                <div>
                    <h1 style="font-size:16px;text-align:center;">SIS<span style="color:#47ABE2">ESCOLAR</span></h1>
                    <p style="font-size:12px;text-align:center;">'.$mensaje.'</p>
                    <p style="font-size:12px;text-align:center;">Curso comprado:</p>
                    <h1 style="font-size:18px;text-align:center;">'.$nombre_curso.'</h1>
                    <p style="font-size:15px;text-align:center;">ID de compra: '.$id_compra.'</p>
                    <h1 style="font-size:14px;text-align:center;">Datos del usuario:</h1>
                    <p style="font-size:13px;text-align:center;">Nombre: '.$nombre.'</p>
                    <p style="font-size:13px;text-align:center;">Correo: '.$email.'</p>
                    <p style="font-size:13px;text-align:center;">Fecha y hora de compra: '.$fecha.'</p>
                    <p style="font-size:13px;text-align:center;">Costo unitario: $'.$costo.'</p>
                    <p style="font-size:13px;text-align:center;">Total de compras: '.$btos.'</p>
                    <p style="font-size:13px;text-align:center;">Costo total: $'.(floatval($btos))*(floatval($costo)).'</p>
                    <p style="font-size:12px;text-align:center;">Información validada por <a href="www.stripe.com" style="color:#47ABE2;">Stripe</a></p>
                </div>
            </div>
        ';
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

    // DETINATARIO Y CUERPO EL MENSAJE
        // Remitente
        $mail->setFrom('comunidad@seiko.global', 'SISESCOLAR');
        // Destinatario y cuerpo del mensaje
        $mail->addAddress($email, $nombre);
        $mail->isHTML(true);
        $mail->Subject = "Compra del curso ".$nombre_curso;
        $mail->Body = $html;
        
        // COFICACIÓN DE CARACTERES
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        //ENVIAR EL CORREO
        $mail->send();
    }
/* ====================== FIN ==================== */
?>