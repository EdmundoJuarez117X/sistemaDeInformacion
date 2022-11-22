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
		sleep(1);
		$duplicate1 = mysqli_query($connection, "SELECT * FROM alumno WHERE email_alumno = '$email'");
		sleep(1);
		$duplicate2 = mysqli_query($connection, "SELECT * FROM padredefamilia WHERE email_padreDeFam = '$email'");
		sleep(1);
		$duplicate3 = mysqli_query($connection, "SELECT * FROM docente WHERE email_docente = '$email'");
		sleep(1);
		$duplicate4 = mysqli_query($connection, "SELECT * FROM administrador WHERE email_admin = '$email'");
		sleep(1);
		$duplicate5 = mysqli_query($connection, "SELECT * FROM master WHERE email_master = '$email'");

		if (
			mysqli_num_rows($duplicate) > 0 or mysqli_num_rows($duplicate1) > 0 or mysqli_num_rows($duplicate2) > 0
			or mysqli_num_rows($duplicate3) > 0 or mysqli_num_rows($duplicate4) > 0 or mysqli_num_rows($duplicate5) > 0
		) {
			echo json_encode(array("statusCode" => 201));
		} else {
			$md5EncryptionP4ss = md5($password);
			$sql = "INSERT INTO `aspirante`(`nombre_aspirante`, `apellido_paternoAspirante`, `apellido_maternoAspirante`, `email_aspirante`, `password_aspirante`, `f_creacion_Aspirante`) 
            VALUES('$nombre_persona','$apellido_paterno','$apellido_materno','$email','$md5EncryptionP4ss','$date')";
			if (mysqli_query($connection, $sql)) {
				$sqlToGetID = $connection->query("SELECT * FROM aspirante WHERE email_aspirante='$email'");
				//Obtenemos el registro de los datos y guardamos algunos para control de acceso
				if ($datosID = $sqlToGetID->fetch_object()) {
					$_SESSION["id_aspirante"] = $datosID->id_aspirante;
					$_SESSION["estatus_Aspirante"] = $datosID->estatus_Aspirante;
					$_SESSION["subMat"] = "ASP";
					$_SESSION["nombre_aspirante"] = $nombre_persona;
					$_SESSION["apellido_paternoAspirante"] = $apellido_paterno;
					$_SESSION["email_aspirante"] = $email;
				}

				echo json_encode(array("statusCode" => 200));
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
