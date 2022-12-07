<?php
include '../model/connection.php';

session_start();
if ($_POST['type'] == 1) {
	$nombre_persona = $_POST['nombre_persona'];
	$apellido_paterno = $_POST['apellido_paterno'];
	$apellido_materno = $_POST['apellido_materno'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$date = date("Y-m-d H:i:s");

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$duplicate = mysqli_query($connection, "SELECT * FROM aspirante WHERE email_aspirante = '$email'");
		usleep(136000);
		$duplicate1 = mysqli_query($connection, "SELECT * FROM alumno WHERE email_alumno = '$email'");
		usleep(136000);
		$duplicate2 = mysqli_query($connection, "SELECT * FROM padreDeFamilia WHERE email_padreDeFam = '$email'");
		usleep(136000);
		$duplicate3 = mysqli_query($connection, "SELECT * FROM docente WHERE email_docente = '$email'");
		usleep(136000);
		$duplicate4 = mysqli_query($connection, "SELECT * FROM administrador WHERE email_admin = '$email'");
		usleep(136000);
		$duplicate5 = mysqli_query($connection, "SELECT * FROM `master` WHERE email_master = '$email'");

		if (
			mysqli_num_rows($duplicate) > 0 or mysqli_num_rows($duplicate1) > 0 or mysqli_num_rows($duplicate2) > 0
			or mysqli_num_rows($duplicate3) > 0 or mysqli_num_rows($duplicate4) > 0 or mysqli_num_rows($duplicate5) > 0
		) {
			echo json_encode(array("statusCode" => 201));
		} else {
			$md5EncryptionP4ss = md5($password);
			$sql = "INSERT INTO `master`( `nombre_master`, `apellido_paternoMaster`, `apellido_maternoMaster`,  `email_master`, `password_master`, `f_creacion_Master`) 
            VALUES('$nombre_persona','$apellido_paterno','$apellido_materno','$email','$md5EncryptionP4ss','$date')";
			if (mysqli_query($connection, $sql)) {
				$sqlToGetID = $connection->query("SELECT * FROM `master` WHERE `email_master`='$email'");
				//Obtenemos el registro de los datos y guardamos algunos para control de acceso
				if ($datosID = $sqlToGetID->fetch_object()) {
					$_SESSION["id_master"] = $datosID->id_master;
					$_SESSION["estatus_persona"] = $datosID->estatus_Master;
					$_SESSION["subMat"] = "MST";
					$_SESSION["nombre_master"] = $nombre_persona;
					$_SESSION["apellido_paternoMaster"] = $apellido_paterno;
					$_SESSION["email_master"] = $email;
					// $_SESSION["enviar_correo"] = "ENV";
					echo json_encode(array("statusCode" => 200));
				}else{
					echo json_encode(array("statusCode" => 201));
				}

				
			} else {
				echo json_encode(array("statusCode" => 201));
			}
		}
		mysqli_close($connection);
	} else {
		echo json_encode(array("statusCode" => 201));
	}

}

?>
