<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../../index.php");
    }
    // base de datos
    require_once('../../../../lib/STRIPE/vendor/autoload.php');
    include('../../../../model/connection.php');
    $db = $connection;

    \Stripe\Stripe::setApiKey('sk_test_51LpepvJCDMwOQjdnzZHypHVafMW9BSdutuYykJ3T1DynfI1pMR6SXPR2UO2xnq6zm7MBdLPGER04oHSY06zc66jl00Y7IQAUOd');

//Sanitize POST Array

    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $id_curso = $_POST['id_curso'];
    $nombre_curso = $_POST['nombre_curso'];
    $costo = $_POST['costo'];
    $first_name = $POST['first_name'];
    $last_name = $POST['last_name'];
    $email = $POST['email'];
    $btos = $_POST['boletos'];
    $token = $POST['stripeToken'];

    //Create custime rin stripe
    $customer = \Stripe\Customer::create(array(
        "email" => $email,
        "source" => $token
    ));

    // Charge cutomer
    $charge = \Stripe\Charge::create(array(
        "amount" => (($btos)*($costo))*(100),
        "currency" => "mxn",
        "description" => $nombre_curso,
        "customer" => $customer->id
    ));

    //fecha actual
    $date = date("Y-m-d H:i:s");

    // OBTENER EL ID DEL USUARIO
    if($_SESSION['subMat'] == "Al") {

        $id_user = $_SESSION['id_alumno'];
        // query para insertar tu compra
        $query_a_c = "INSERT INTO
        alumno_curso (id_alumno_curso, descripcion_pago, cantidad_boletines, f_creacion_al_cur, id_alumno, id_curso)
        VALUES ('$charge->id', 'PAGADO', '$btos', '$date', '$id_user', $id_curso);";

    } else if($_SESSION['subMat'] == "DOC") {

        $id_user = $_SESSION['id_docente'];
        // query para insertar tu compra
        $query_a_c = "INSERT INTO
        docente_curso (id_docente_curso, descripcion_pago, cantidad_boletines, f_creacion_doc_cur, id_docente, id_curso)
        VALUES ('$charge->id', 'PAGADO', '$btos', '$date', '$id_user', $id_curso);";

    }
    // ejecutamos la consulta
    $result = $db->query($query_a_c);
    // ejecutamos sentencia
    if(!$result) {
        die("No se pudo insertar tus datos. Error: ". mysqli_error($db));
    }
    // query para insertar los acceso que compraste
    $result_c = $db->query("UPDATE cursos SET participantes_registrados = participantes_registrados+$btos WHERE cursos.id_curso = $id_curso;");
    if(!$result_c) {
        die("No se pudo actualizar los accesos registrados. Error: ". mysqli_error($db));
    }

    // Redireccionando a la página de un pago satisfactorio
    header('Location: ../../../../views/cursos-eventos/users/success.php?tid='.$charge->id.'&product='.$charge->description);
?>