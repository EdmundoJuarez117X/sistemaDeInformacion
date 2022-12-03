<!DOCTYPE html>
<html>

<body>
	<!-- Aquí se dará espacio para los sweet alerts -->
</body>

</html>
<?php
require_once('stripe-php-master/init.php');
\Stripe\Stripe::setApiKey('sk_test_51Ly3wRBjIjedb6hbaVxKhDaZZECfHTq9XPMUkO9nRG3a4cjayZGWYkEALpawNGelEOWgJ746l56c5NrstKCfGTHb008QGWKA29');

session_start(); //Activamos la sesion
$Autorizacion = false; //Para activar cuando se cumpla las condiciones y poder redirigir
$url = ''; //Para escribir la url dependiendo de la situacion (Condicion)

$token = $_POST['stripeToken'];
$total = $_POST['total'];
$email = $_POST['email'];
$id_pago = $_SESSION['id_pago'];
$descripcion = $_SESSION['descripcion'];
$moneda_concurrencia = $_SESSION['moneda_concurrencia'];

try {
	//Creacion de cliente de stripe
	$customer = Stripe\Customer::create(
		array(
			'email' => $email,
			'source' => $token,
		)
	);
	// Crear cargo de Stripe
	$charge = \Stripe\Charge::create(
		array(
			'customer' => $customer->id,
			'amount' => $total * 100,
			// Cambiar el tipo de moneda
			'currency' => "$moneda_concurrencia",
			'description' => "$descripcion",
		)
	);



	if ($charge->status == "succeeded") {
		// Antigua alerta, usar en caso de que sweet alert no funcione
		//echo "<script>alert('Pagado exitosamente! ');</script>";


		include "./../../../model/connection.php";
		if ($_SESSION["subMat"] == "ASP") { //Preguntamos si es aspirante
			$id_aspirante = $_SESSION["id_aspirante"];
			if ($_SESSION["estatus_persona"] == "PROCADM") { //Preguntamos si el aspirante ha seleccionado una escuela y pagará exámen de admisión
				//Actualizar estatus del aspirante
				$sqlUAsp = "UPDATE `aspirante` SET `estatus_Aspirante`='PREINSC'  
				WHERE `id_aspirante`='$id_aspirante'";
				usleep(136000);
				if (mysqli_query($connection, $sqlUAsp)) {
					//Buscar si tiene padre de familia asignado
					$sqlAspHasParent = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padredefamiliahijo` 
					WHERE `id_aspirante`='$id_aspirante'");
					usleep(136000);
					if ($parentFound = $sqlAspHasParent->fetch_object()) {
						$id_padreDeFamilia = $parentFound->id_padreDeFamilia;
						//Actualizar estatus del padre de familia 
						$sqlUpdatePF = "UPDATE `padredefamilia` SET `estatus_padreDeFam`='ASIGPREIN'
						WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
						usleep(136000);
						if (mysqli_query($connection, $sqlUpdatePF)) {
							$nombre_aspirante = $_SESSION["nombre_aspirante"];
							$sqlAspPago = "INSERT INTO `aspirante_pago`(`nombre_aspirante`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_aspirante`, `f_creacion_AspPago`,`id_aspirante`, `id_pago`) 
							VALUES ('$nombre_aspirante','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email', NOW() ,'$id_aspirante','$id_pago')";
							usleep(136000);
							if (mysqli_query($connection, $sqlAspPago)) {
								$_SESSION["estatus_persona"] = "PREINSC";
								echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'success',
											title: 'Se ha relizado el pago exitosamente',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
								$Autorizacion = true;
								$url = 'dashboard/inicio.php';
							}
						}
					} else {
						//Actualizar estatus del aspirante
						$sqlUAsp = "UPDATE `aspirante` SET `estatus_Aspirante`='PREINSC'  
						WHERE `id_aspirante`='$id_aspirante'";
						usleep(136000);
						if (mysqli_query($connection, $sqlUAsp)) {
							$nombre_aspirante = $_SESSION["nombre_aspirante"];
							$sqlAspPago = "INSERT INTO `aspirante_pago`(`nombre_aspirante`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_aspirante`, `f_creacion_AspPago`,`id_aspirante`, `id_pago`) 
							VALUES ('$nombre_aspirante','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email', NOW() ,'$id_aspirante','$id_pago')";
							usleep(136000);
							if (mysqli_query($connection, $sqlAspPago)) {
								$_SESSION["estatus_persona"] = "PREINSC";
								echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'success',
											title: 'Se ha relizado el pago exitosamente',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
								$Autorizacion = true;
								$url = 'dashboard/inicio.php';
							} else {
								echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'error',
											title: 'Algo salió mal al actualizar los datos de pago',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
								$Autorizacion = true;
								$url = 'dashboard/inicio.php';
							}
						} else {
							echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'error',
											title: 'Algo salió mal',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
							$Autorizacion = true;
							$url = 'dashboard/inicio.php';
						}
					}
				}

			} else if ($_SESSION["estatus_persona"] == "PREINSC") { //Preguntamos si el aspirante ya pago examen de admision y ahora pagará la inscripcion
				//Se consultan datos del aspirante y se almacenan
				$sqlAsp = $connection->query("SELECT `id_aspirante`, `subMatAsp`, `nombre_aspirante`, `segundo_nombreAspirante`, `apellido_paternoAspirante`, `apellido_maternoAspirante`, `edad_Aspirante`, `genero_Aspirante`, `estatus_Aspirante`, `numero_tel_Aspirante`, `email_aspirante`, `password_aspirante`, `fecha_nacimientoAspirante`, `f_creacion_Aspirante`, `f_modificacion_Aspirante` FROM `aspirante`
					WHERE `id_aspirante`='$id_aspirante'");
				usleep(136000);
				if ($aspData = $sqlAsp->fetch_object()) { //Almacenamos todos los datos del aspirante para migrar a alumno
					$nombre_alumno = $aspData->nombre_aspirante;
					$segundo_nombreAlumno = $aspData->segundo_nombreAspirante;
					$apellido_paternoAlumno = $aspData->apellido_paternoAspirante;
					$apellido_maternoAlumno = $aspData->apellido_maternoAspirante;
					$edad_Alumno = $aspData->edad_Aspirante;
					$genero_Alumno = $aspData->genero_Aspirante;
					$numero_tel_Alumno = $aspData->numero_tel_Aspirante;
					$email_alumno = $aspData->email_aspirante;
					$password_alumno = $aspData->password_aspirante;
					$fecha_nacimientoAlumno = $aspData->fecha_nacimientoAspirante;

					//Consultamos los intereses del aspirante
					$sqlAdmIntAsp = $connection->query("SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`, `id_especializacion` FROM `admisioninteresesaspirante`
					WHERE `id_aspirante`='$id_aspirante'");
					usleep(136000);
					if ($admAspData = $sqlAdmIntAsp->fetch_object()) {
						$nombre_escuela = $admAspData->nombre_escuela;
						$nombre_nivelEducativo = $admAspData->nombre_nivelEducativo;
						$descripcion_nivelEducativo = $admAspData->descripcion_nivelEducativo;
						$nombre_facultad = $admAspData->nombre_facultad;
						$nombre_esp = $admAspData->nombre_esp;
						$nombre_carrera = $admAspData->nombre_carrera;
						$numero_grado = $admAspData->numero_grado;
						$id_escuela = $admAspData->id_escuela;
						$id_nivelEducativo = $admAspData->id_nivelEducativo;
						$id_facultad = $admAspData->id_facultad;
						$id_carrera = $admAspData->id_carrera;
						$id_especializacion = $admAspData->id_especializacion;

						$sqlAspPadreFam = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padredefamiliahijo` 
							WHERE `id_aspirante`='$id_aspirante'");
						usleep(136000);
						if ($pfFound = $sqlAspPadreFam->fetch_object()) {
							$id_padreDeFamilia = $pfFound->id_padreDeFamilia;

							//Actualizar el estatus del padre de familia a = ASIGPAG
							$sqlUpdatePadreFam = "UPDATE `padredefamilia` SET `estatus_padreDeFam`='ASIGPAG'
								WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
							usleep(136000);
							if (mysqli_query($connection, $sqlUpdatePadreFam)) {
								//Si la consulta salió exitosa entonces:
								$sqlAspToAl = "INSERT INTO `alumno`(`nombre_alumno`, `segundo_nombreAlumno`, `apellido_paternoAlumno`, `apellido_maternoAlumno`, `edad_Alumno`, `genero_Alumno`, `estatus_Alumno`, `numero_tel_Alumno`, `email_alumno`, `password_alumno`, `fecha_nacimientoAlumno`, `f_creacion_Alumno`) 
								VALUES ('$nombre_alumno','$segundo_nombreAlumno','$apellido_paternoAlumno','$apellido_maternoAlumno','$edad_Alumno','$genero_Alumno','INSCRITO','$numero_tel_Alumno','$email_alumno','$password_alumno','$fecha_nacimientoAlumno', NOW())";
								usleep(136000);
								if (mysqli_query($connection, $sqlAspToAl)) {
									//Se agregan con exito los datos del nuevo alumno
									//Obtenemos la direccion del aspirante para ahora pasarla al alumno
									$sqlDirAsp = $connection->query("SELECT `calleAspirante`, `numeroCalleAspirante`, `coloniaAspirante`, `estadoAspirante`, `ciudadAspirante`, `codPostalAspirante`, `f_creacion_DirAspirante`, `f_modificacion_DirAspirante`, `id_aspirante` FROM `direccionaspirante` 
									WHERE `id_aspirante`='$id_aspirante'");
									usleep(136000);
									if ($dirFound = $sqlDirAsp->fetch_object()) {
										//Obtenemos datos de la direccion
										$calleAlumno = $dirFound->calleAspirante;
										$numeroCalleAlumno = $dirFound->numeroCalleAspirante;
										$coloniaAlumno = $dirFound->coloniaAspirante;
										$estadoAlumno = $dirFound->estadoAspirante;
										$ciudadAlumno = $dirFound->ciudadAspirante;
										$codPostalAlumno = $dirFound->codPostalAspirante;

										//Obtener nuevo id del alumno
										$sqlIDAlumno = $connection->query("SELECT `id_alumno`  FROM `alumno`
											WHERE `email_alumno`='$email_alumno'");
										usleep(136000);
										if ($idAlFound = $sqlIDAlumno->fetch_object()) {
											$id_alumno = $idAlFound->id_alumno; //id del alumno

											//Ingresamos la direccion del alumno con los datos que tenía como aspirante
											$sqlDirAl = "INSERT INTO `direccionalumno`(`calleAlumno`, `numeroCalleAlumno`, `coloniaAlumno`, `estadoAlumno`, `ciudadAlumno`, `codPostalAlumno`, `f_creacion_DirAlumno`,`id_alumno`) 
											VALUES ('$calleAlumno','$numeroCalleAlumno','$coloniaAlumno','$estadoAlumno','$ciudadAlumno','$codPostalAlumno',NOW(),'$id_alumno')";
											usleep(136000);
											if (mysqli_query($connection, $sqlDirAl)) { //Se han enviado los datos de direccion para alumno
												//Actualizamos la tabla aspirante para que no accedan al sistema una vez actualizados a alumno
												$sqlUpdateAsp = "UPDATE `aspirante` SET `email_aspirante`='MIGRADOALUMNO',`password_aspirante`='MIGRADOALUMNO'
												WHERE `id_aspirante` ='$id_aspirante'";
												usleep(136000);
												if (mysqli_query($connection, $sqlUpdateAsp)) {
													//Se insertan los datos de pago del alumno
													$sqlPagAl = "INSERT INTO `alumno_pago`(`nombre_alumno`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_alumno`, `f_creacion_AlPago`, `id_alumno`, `id_pago`)
													 VALUES ('$nombre_alumno','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email_alumno', NOW() ,'$id_alumno','$id_pago')";
													usleep(136000);
													if (mysqli_query($connection, $sqlPagAl)) { //Se ha realizado la insersion de datos de pago de alumno
														//Se inicia el proceso de colocacion a escuela
														//Se pregunta el nivel Educativo de sus intereses como aspirante
														if ($nombre_nivelEducativo == "Basica") { //Caso de querer ingresar a una escuela como prescolar, primaria o secundaria
															$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
															if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																$id_aula = $resultAula->id_aula;
																$numero_aula = $resultAula->numero_aula;
																$grupo_aula = $resultAula->grupo_aula;
																$nombre_aula = $resultAula->nombre_aula;
																$numero_asientos = $resultAula->numero_asientosAula;

																$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																usleep(136000);
																if (mysqli_query($connection, $sqlAlUlaInsert)) {
																	//Después de asignar al alumno a una aula
																	//Actualizamos el número de asientos que tiene el aula
																	if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																		if ($numero_asientos == 1) { //Es el último asiento
																			//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																			$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																				WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";

																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																			}
																		} else { //Mayor que 1
																			$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																			WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAula)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";
																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																			}
																		}
																	}

																}
															} else {
																//No hay aulas disponibles

															}

														} else if ($nombre_nivelEducativo == "Media Superior") { //Caso de querer ingresar a prepa o bach u otro
															//Buscamos un aula con lugares disponibles
															$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
															if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																$id_aula = $resultAula->id_aula;
																$numero_aula = $resultAula->numero_aula;
																$grupo_aula = $resultAula->grupo_aula;
																$nombre_aula = $resultAula->nombre_aula;
																$numero_asientos = $resultAula->numero_asientosAula;

																$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																usleep(136000);
																if (mysqli_query($connection, $sqlAlUlaInsert)) {
																	//Después de asignar al alumno a una aula
																	//Actualizamos el número de asientos que tiene el aula
																	if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																		if ($numero_asientos == 1) { //Es el último asiento
																			//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																			$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																				WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";
																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';
																			}
																		} else { //Mayor que 1
																			$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																			WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAula)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";
																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																			}
																		}
																	}

																}
															} else {
																//No hay aulas disponibles

															}
														} else if ($nombre_nivelEducativo == "Superior") { //Caso de querer ingresar a la universidad
															//Variables a usar (Borrar después)

															// $nombre_facultad = $admAspData->nombre_facultad;
															// $nombre_esp = $admAspData->nombre_esp;
															// $nombre_carrera = $admAspData->nombre_carrera;
															// $id_escuela = $admAspData->id_escuela;
															// $id_nivelEducativo = $admAspData->id_nivelEducativo;
															// $id_facultad = $admAspData->id_facultad;
															// $id_carrera = $admAspData->id_carrera;
															// $id_especializacion = $admAspData->id_especializacion;

															if ($nombre_esp != "") {
																/* */
																//Buscamos un aula con lugares disponibles
																$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
																	escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_especializacion.nombre_esp
																	FROM aula 
																	INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula 
																	INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela 
																	INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																	INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																	INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																	INNER JOIN facultad_especializacion on escuela_facultad.id_facultad = facultad_especializacion.id_facultad
																	WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_especializacion.id_especializacion='$id_especializacion' ORDER BY aula.f_creacion_aula DESC;");
																usleep(136000);
																if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																	$id_aula = $resultAula->id_aula;
																	$numero_aula = $resultAula->numero_aula;
																	$grupo_aula = $resultAula->grupo_aula;
																	$nombre_aula = $resultAula->nombre_aula;
																	$numero_asientos = $resultAula->numero_asientosAula;

																	$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																	usleep(136000);
																	if (mysqli_query($connection, $sqlAlUlaInsert)) {
																		//Después de asignar al alumno a una aula
																		//Actualizamos el número de asientos que tiene el aula
																		if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																			if ($numero_asientos == 1) { //Es el último asiento
																				//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																				$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																			WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";

																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																					<script>
																						Swal.fire({
																							position: 'center',
																							icon: 'success',
																							title: 'Se ha relizado el pago exitosamente',
																							showConfirmButton: false,
																							timer: 1963
																						})
																					</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																				
																				}
																			} else { //Mayor que 1
																				$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																				WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAula)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";

																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																					Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																						})
																					</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';
																				}
																			}
																		}

																	}
																} else {
																	//No hay aulas disponibles

																}
																/* */
															} else if ($nombre_carrera != "") {
																$sqlAulaAlCarr = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
																escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_carrera.nombre_carrera
																	FROM aula 
																	INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																	INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																	INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																	INNER JOIN facultad_carrera on escuela_facultad.id_facultad = facultad_carrera.id_facultad
																	WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_carrera.id_carrera='$id_carrera' ORDER BY aula.f_creacion_aula DESC;");
																if ($resultAulaCarr = $sqlAulaAlCarr->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																	$id_aula = $resultAulaCarr->id_aula;
																	$numero_aula = $resultAulaCarr->numero_aula;
																	$grupo_aula = $resultAulaCarr->grupo_aula;
																	$nombre_aula = $resultAulaCarr->nombre_aula;
																	$numero_asientos = $resultAulaCarr->numero_asientosAula;

																	$sqlAlUlaInsertC = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																				VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																	usleep(136000);
																	if (mysqli_query($connection, $sqlAlUlaInsertC)) {
																		//Después de asignar al alumno a una aula
																		//Actualizamos el número de asientos que tiene el aula
																		if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																			if ($numero_asientos == 1) { //Es el último asiento
																				//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																				$sqlUpdateAsAulaFC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																					WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAulaFC)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";

																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																						<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																						Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																							})
																						</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';
																				}
																			} else { //Mayor que 1
																				$sqlUpdateAsAulaC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																					WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAulaC)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";

																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																						<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																							Swal.fire({
																								position: 'center',
																								icon: 'success',
																								title: 'Se ha relizado el pago exitosamente',
																								showConfirmButton: false,
																								timer: 1963
																							})
																						</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																					
																				}
																			}
																		}

																	}
																} else {
																	//No hay aulas disponibles

																}
															}
														}

													}

												}
											}
										}
									}

								} else {
									//Si no se agregan los datos de alumno entonces:
								}
							}
						} else {
							//Continuar aquí si es que no tiene padre de familia asignado
							//Insertamos los datos del alumno
							$sqlAspToAl = "INSERT INTO `alumno`(`nombre_alumno`, `segundo_nombreAlumno`, `apellido_paternoAlumno`, `apellido_maternoAlumno`, `edad_Alumno`, `genero_Alumno`, `estatus_Alumno`, `numero_tel_Alumno`, `email_alumno`, `password_alumno`, `fecha_nacimientoAlumno`, `f_creacion_Alumno`) 
							VALUES ('$nombre_alumno','$segundo_nombreAlumno','$apellido_paternoAlumno','$apellido_maternoAlumno','$edad_Alumno','$genero_Alumno','INSCRITO','$numero_tel_Alumno','$email_alumno','$password_alumno','$fecha_nacimientoAlumno', NOW())";
							usleep(136000);
							if (mysqli_query($connection, $sqlAspToAl)) {
								//Se agregan con exito los datos del nuevo alumno
								//Obtenemos la direccion del aspirante para ahora pasarla al alumno
								$sqlDirAsp = $connection->query("SELECT `calleAspirante`, `numeroCalleAspirante`, `coloniaAspirante`, `estadoAspirante`, `ciudadAspirante`, `codPostalAspirante`, `f_creacion_DirAspirante`, `f_modificacion_DirAspirante`, `id_aspirante` FROM `direccionaspirante` 
								WHERE `id_aspirante`='$id_aspirante'");
								usleep(136000);
								if ($dirFound = $sqlDirAsp->fetch_object()) {
									//Obtenemos datos de la direccion
									$calleAlumno = $dirFound->calleAspirante;
									$numeroCalleAlumno = $dirFound->numeroCalleAspirante;
									$coloniaAlumno = $dirFound->coloniaAspirante;
									$estadoAlumno = $dirFound->estadoAspirante;
									$ciudadAlumno = $dirFound->ciudadAspirante;
									$codPostalAlumno = $dirFound->codPostalAspirante;

									//Obtener nuevo id del alumno
									$sqlIDAlumno = $connection->query("SELECT `id_alumno`  FROM `alumno`
										WHERE `email_alumno`='$email_alumno'");
									usleep(136000);
									if ($idAlFound = $sqlIDAlumno->fetch_object()) {
										$id_alumno = $idAlFound->id_alumno; //id del alumno

										//Ingresamos la direccion del alumno con los datos que tenía como aspirante
										$sqlDirAl = "INSERT INTO `direccionalumno`(`calleAlumno`, `numeroCalleAlumno`, `coloniaAlumno`, `estadoAlumno`, `ciudadAlumno`, `codPostalAlumno`, `f_creacion_DirAlumno`,`id_alumno`) 
										VALUES ('$calleAlumno','$numeroCalleAlumno','$coloniaAlumno','$estadoAlumno','$ciudadAlumno','$codPostalAlumno',NOW(),'$id_alumno')";
										usleep(136000);
										if (mysqli_query($connection, $sqlDirAl)) { //Se han enviado los datos de direccion para alumno
											//Actualizamos la tabla aspirante para que no accedan al sistema una vez actualizados a alumno
											$sqlUpdateAsp = "UPDATE `aspirante` SET `email_aspirante`='MIGRADOALUMNO',`password_aspirante`='MIGRADOALUMNO'
											WHERE `id_aspirante` ='$id_aspirante'";
											usleep(136000);
											if (mysqli_query($connection, $sqlUpdateAsp)) {
												//Se insertan los datos de pago del alumno
												$sqlPagAl = "INSERT INTO `alumno_pago`(`nombre_alumno`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_alumno`, `f_creacion_AlPago`, `id_alumno`, `id_pago`)
												 VALUES ('$nombre_alumno','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email_alumno', NOW() ,'$id_alumno','$id_pago')";
												usleep(136000);
												if (mysqli_query($connection, $sqlPagAl)) { //Se ha realizado la insersion de datos de pago de alumno
													//Se inicia el proceso de colocacion a escuela
													//Se pregunta el nivel Educativo de sus intereses como aspirante
													if ($nombre_nivelEducativo == "Basica") { //Caso de querer ingresar a una escuela como prescolar, primaria o secundaria
														$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
															FROM aula 
															INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
															WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
														if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
															$id_aula = $resultAula->id_aula;
															$numero_aula = $resultAula->numero_aula;
															$grupo_aula = $resultAula->grupo_aula;
															$nombre_aula = $resultAula->nombre_aula;
															$numero_asientos = $resultAula->numero_asientosAula;
															
															$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
															usleep(136000);
															
															if (mysqli_query($connection, $sqlAlUlaInsert)) {
																//Después de asignar al alumno a una aula
																//Actualizamos el número de asientos que tiene el aula
																
																if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																	
																	if ($numero_asientos == 1) { //Es el último asiento
																		//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																		$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																			WHERE `id_aula` ='$id_aula'";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																			$_SESSION["subMat"] = "Al";
																			$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																			$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																			$_SESSION["nombre_aspirante"] = "";
																			$_SESSION["apellido_paternoAspirante"] = "";


																			$_SESSION["estatus_persona"] = "INSCRITO";
																			echo "
																			<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																			<script>
																				Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																				})
																			</script>";
																			

																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';
																		}
																	} else { //Mayor que 1
																		echo "Mayor que 1";
																		$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																		WHERE `id_aula` ='$id_aula'";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlUpdateAsAula)) {
																			echo'Se ha realizado la update';
																			$_SESSION["subMat"] = "Al";
																			$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																			$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																			$_SESSION["nombre_aspirante"] = "";
																			$_SESSION["apellido_paternoAspirante"] = "";

																			$_SESSION["estatus_persona"] = "INSCRITO";
																			echo "
																			<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																			<script>
																				Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																				})
																			</script>";
																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';
																		}
																	}
																}

															}
														} else {
															//No hay aulas disponibles

														}

													} else if ($nombre_nivelEducativo == "Media Superior") { //Caso de querer ingresar a prepa o bach u otro
														//Buscamos un aula con lugares disponibles
														$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
															FROM aula 
															INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
															WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
														if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
															$id_aula = $resultAula->id_aula;
															$numero_aula = $resultAula->numero_aula;
															$grupo_aula = $resultAula->grupo_aula;
															$nombre_aula = $resultAula->nombre_aula;
															$numero_asientos = $resultAula->numero_asientosAula;

															$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
															usleep(136000);
															if (mysqli_query($connection, $sqlAlUlaInsert)) {
																//Después de asignar al alumno a una aula
																//Actualizamos el número de asientos que tiene el aula
																if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																	if ($numero_asientos == 1) { //Es el último asiento
																		//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																		$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																			WHERE `id_aula` ='$id_aula'";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																			$_SESSION["subMat"] = "Al";
																			$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																			$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																			$_SESSION["nombre_aspirante"] = "";
																			$_SESSION["apellido_paternoAspirante"] = "";

																			$_SESSION["estatus_persona"] = "INSCRITO";
																			echo "
																			<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																			<script>
																				Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																				})
																			</script>";
																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';

																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';
																		}
																	} else { //Mayor que 1
																		$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																		WHERE `id_aula` ='$id_aula'";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlUpdateAsAula)) {
																			$_SESSION["subMat"] = "Al";
																			$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																			$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																			$_SESSION["nombre_aspirante"] = "";
																			$_SESSION["apellido_paternoAspirante"] = "";

																			$_SESSION["estatus_persona"] = "INSCRITO";
																			echo "
																			<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																			<script>
																				Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																				})
																			</script>";
																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';

																			$Autorizacion = true;
																			$url = 'dashboard/inicio.php';
																		}
																	}
																}

															}
														} else {
															//No hay aulas disponibles

														}
													} else if ($nombre_nivelEducativo == "Superior") { //Caso de querer ingresar a la universidad
														//Variables a usar (Borrar después)

														// $nombre_facultad = $admAspData->nombre_facultad;
														// $nombre_esp = $admAspData->nombre_esp;
														// $nombre_carrera = $admAspData->nombre_carrera;
														// $id_escuela = $admAspData->id_escuela;
														// $id_nivelEducativo = $admAspData->id_nivelEducativo;
														// $id_facultad = $admAspData->id_facultad;
														// $id_carrera = $admAspData->id_carrera;
														// $id_especializacion = $admAspData->id_especializacion;

														if ($nombre_esp != "") {
															/* */
															//Buscamos un aula con lugares disponibles
															$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
																escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_especializacion.nombre_esp
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula 
																INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela 
																INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																INNER JOIN facultad_especializacion on escuela_facultad.id_facultad = facultad_especializacion.id_facultad
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_especializacion.id_especializacion='$id_especializacion' ORDER BY aula.f_creacion_aula DESC;");
															usleep(136000);
															if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																$id_aula = $resultAula->id_aula;
																$numero_aula = $resultAula->numero_aula;
																$grupo_aula = $resultAula->grupo_aula;
																$nombre_aula = $resultAula->nombre_aula;
																$numero_asientos = $resultAula->numero_asientosAula;

																$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																usleep(136000);
																if (mysqli_query($connection, $sqlAlUlaInsert)) {
																	//Después de asignar al alumno a una aula
																	//Actualizamos el número de asientos que tiene el aula
																	if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																		if ($numero_asientos == 1) { //Es el último asiento
																			//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																			$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																		WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";

																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';
																			}
																		} else { //Mayor que 1
																			$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																	WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAula)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";

																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																		<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																		<script>
																			Swal.fire({
																				position: 'center',
																				icon: 'success',
																				title: 'Se ha relizado el pago exitosamente',
																				showConfirmButton: false,
																				timer: 1963
																			})
																		</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																			}
																		}
																	}

																}
															} else {
																//No hay aulas disponibles

															}
															/* */
														} else if ($nombre_carrera != "") {
															$sqlAulaAlCarr = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
															escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_carrera.nombre_carrera
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																INNER JOIN facultad_carrera on escuela_facultad.id_facultad = facultad_carrera.id_facultad
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_carrera.id_carrera='$id_carrera' ORDER BY aula.f_creacion_aula DESC;");
															if ($resultAulaCarr = $sqlAulaAlCarr->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																$id_aula = $resultAulaCarr->id_aula;
																$numero_aula = $resultAulaCarr->numero_aula;
																$grupo_aula = $resultAulaCarr->grupo_aula;
																$nombre_aula = $resultAulaCarr->nombre_aula;
																$numero_asientos = $resultAulaCarr->numero_asientosAula;

																$sqlAlUlaInsertC = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																			VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																usleep(136000);
																if (mysqli_query($connection, $sqlAlUlaInsertC)) {
																	//Después de asignar al alumno a una aula
																	//Actualizamos el número de asientos que tiene el aula
																	if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																		if ($numero_asientos == 1) { //Es el último asiento
																			//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																			$sqlUpdateAsAulaFC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																				WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAulaFC)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";

																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																					<script>
																					Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																						})
																					</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';

																				
																			}
																		} else { //Mayor que 1
																			$sqlUpdateAsAulaC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																				WHERE `id_aula` ='$id_aula'";
																			usleep(136000);
																			if (mysqli_query($connection, $sqlUpdateAsAulaC)) {
																				$_SESSION["subMat"] = "Al";
																				$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																				$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																				$_SESSION["nombre_aspirante"] = "";
																				$_SESSION["apellido_paternoAspirante"] = "";


																				$_SESSION["estatus_persona"] = "INSCRITO";
																				echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																					<script>
																						Swal.fire({
																							position: 'center',
																							icon: 'success',
																							title: 'Se ha relizado el pago exitosamente',
																							showConfirmButton: false,
																							timer: 1963
																						})
																					</script>";
																				$Autorizacion = true;
																				$url = 'dashboard/inicio.php';
																			}
																		}
																	}

																}
															} else {
																//No hay aulas disponibles

															}
														}
													}

												}

											}
										}
									}
								}

							} else {
								//Si no se agregan los datos de alumno entonces:
							}
						
						}
					}
				}
			}

		} else if ($_SESSION["subMat"] == "PF") { //Preguntamos si es padre de familia
			$id_padreDeFamilia = $_SESSION["id_padreDeFamilia"]; //Otenemos el identificador del tutor

			if ($_SESSION["estatus_persona"] == "ASIGNADO") { //Preguntamos si ya esta asigando para pagar examen de admision
				//Buscamos el id del hijo aspirante
				$sqlPFHijo = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padredefamiliahijo` 
					WHERE `id_padreDeFamilia`='$id_padreDeFamilia'");
				usleep(136000);
				if ($sonFound = $sqlPFHijo->fetch_object()) {
					$id_aspirante = $sonFound->id_aspirante;
					//Actualizamos el estatus del aspirante para ahora proceder a pagar la inscripcion
					$sqlUPAsp = "UPDATE `aspirante` SET `estatus_Aspirante`='PREINSC' WHERE `id_aspirante`='$id_aspirante'";
					usleep(136000);
					if (mysqli_query($connection, $sqlUPAsp)) {
						//Actualizamos ahora al padre de familia
						$sqlUpdatePF = "UPDATE `padredefamilia` SET `estatus_padreDeFam`='ASIGPREIN'
						WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
						usleep(136000);
						if (mysqli_query($connection, $sqlUpdatePF)) {
							$nombre_padreDeFam = $_SESSION["nombre_padreDeFam"];
							$sqlPFPago = "INSERT INTO `padredefamilia_pago`(`nombre_padreDeFam`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_padreDeFam`, `f_creacion_PFPago`,`id_padreDeFamilia`, `id_pago`) 
							VALUES ('$nombre_padreDeFam','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email', NOW() ,'$id_aspirante','$id_pago')";
							usleep(136000);
							if (mysqli_query($connection, $sqlPFPago)) {
								$_SESSION["estatus_persona"] = "ASIGPREIN";
								echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'success',
											title: 'Se ha relizado el pago exitosamente',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
								$Autorizacion = true;
								$url = 'dashboard/inicio.php';
							} else {
								echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'error',
											title: 'Algo salió mal',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
								$Autorizacion = true;
								$url = 'dashboard/inicio.php';
							}
						} else {
							echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'error',
											title: 'Algo salió mal',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
							$Autorizacion = true;
							$url = 'dashboard/inicio.php';
						}
					} else {
						echo "
									<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
									<script>
										Swal.fire({
											position: 'center',
											icon: 'error',
											title: 'Algo salió mal',
											showConfirmButton: false,
											timer: 1963
										})
									</script>";
						$Autorizacion = true;
						$url = 'dashboard/inicio.php';
					}
				}
			} else if ($_SESSION["estatus_persona"] == "ASIGPREIN") { //Preguntamos si ya ha pagado el examen de admision para entonces pagar por la inscripcion
				//Buscamos el id del hijo aspirante
				$sqlPFHijo = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padredefamiliahijo` 
					WHERE `id_padreDeFamilia`='$id_padreDeFamilia'");
				usleep(136000);
				if ($sonFound = $sqlPFHijo->fetch_object()) {
					$id_aspirante = $sonFound->id_aspirante;
					//Actualizamos el estatus del aspirante para ahora proceder a pagar la inscripcion
					/***************************************************** */
					$sqlAsp = $connection->query("SELECT `id_aspirante`, `subMatAsp`, `nombre_aspirante`, `segundo_nombreAspirante`, `apellido_paternoAspirante`, `apellido_maternoAspirante`, `edad_Aspirante`, `genero_Aspirante`, `estatus_Aspirante`, `numero_tel_Aspirante`, `email_aspirante`, `password_aspirante`, `fecha_nacimientoAspirante`, `f_creacion_Aspirante`, `f_modificacion_Aspirante` FROM `aspirante` 
					WHERE `id_aspirante`='$id_aspirante'");
					usleep(136000);
					if ($aspData = $sqlAsp->fetch_object()) { //Almacenamos todos los datos del aspirante para migrar a alumno
						$nombre_alumno = $aspData->nombre_aspirante;
						$segundo_nombreAlumno = $aspData->segundo_nombreAspirante;
						$apellido_paternoAlumno = $aspData->apellido_paternoAspirante;
						$apellido_maternoAlumno = $aspData->apellido_maternoAspirante;
						$edad_Alumno = $aspData->edad_Aspirante;
						$genero_Alumno = $aspData->genero_Aspirante;
						$numero_tel_Alumno = $aspData->numero_tel_Aspirante;
						$email_alumno = $aspData->email_aspirante;
						$password_alumno = $aspData->password_aspirante;
						$fecha_nacimientoAlumno = $aspData->fecha_nacimientoAspirante;

						//Consultamos los intereses del aspirante
						$sqlAdmIntAsp = $connection->query("SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, `id_aspirante`, `id_escuela`, `id_nivelEducativo`, `id_facultad`, `id_carrera`, `id_especializacion` FROM `admisioninteresesaspirante`
						WHERE `id_aspirante`='$id_aspirante'");
						usleep(136000);
						if ($admAspData = $sqlAdmIntAsp->fetch_object()) {
							$nombre_escuela = $admAspData->nombre_escuela;
							$nombre_nivelEducativo = $admAspData->nombre_nivelEducativo;
							$descripcion_nivelEducativo = $admAspData->descripcion_nivelEducativo;
							$nombre_facultad = $admAspData->nombre_facultad;
							$nombre_esp = $admAspData->nombre_esp;
							$nombre_carrera = $admAspData->nombre_carrera;
							$numero_grado = $admAspData->numero_grado;
							$id_escuela = $admAspData->id_escuela;
							$id_nivelEducativo = $admAspData->id_nivelEducativo;
							$id_facultad = $admAspData->id_facultad;
							$id_carrera = $admAspData->id_carrera;
							$id_especializacion = $admAspData->id_especializacion;

							$sqlAspPadreFam = $connection->query("SELECT `id_padreDeFamHijo`, `nombre_padreDeFam`, `nombre_aspirante`, `nombre_alumno`, `f_creacion_pfHijo`, `f_modificacion_pfHijo`, `id_padreDeFamilia`, `id_aspirante`, `id_alumno` FROM `padredefamiliahijo` 
							WHERE `id_aspirante`='$id_aspirante'");
							usleep(136000);
							if ($pfFound = $sqlAspPadreFam->fetch_object()) {
								$id_padreDeFamilia = $pfFound->id_padreDeFamilia;

								//Actualizar el estatus del padre de familia a = ASIGPAG
								$sqlUpdatePadreFam = "UPDATE `padredefamilia` SET `estatus_padreDeFam`='ASIGPAG'
								WHERE `id_padreDeFamilia`='$id_padreDeFamilia'";
								usleep(136000);
								if (mysqli_query($connection, $sqlUpdatePadreFam)) {
									//Si la consulta salió exitosa entonces:
									$sqlAspToAl = "INSERT INTO `alumno`(`nombre_alumno`, `segundo_nombreAlumno`, `apellido_paternoAlumno`, `apellido_maternoAlumno`, `edad_Alumno`, `genero_Alumno`, `estatus_Alumno`, `numero_tel_Alumno`, `email_alumno`, `password_alumno`, `fecha_nacimientoAlumno`, `f_creacion_Alumno`) 
								VALUES ('$nombre_alumno','$segundo_nombreAlumno','$apellido_paternoAlumno','$apellido_maternoAlumno','$edad_Alumno','$genero_Alumno','INSCRITO','$numero_tel_Alumno','$email_alumno','$password_alumno','$fecha_nacimientoAlumno', NOW())";
									usleep(136000);
									if (mysqli_query($connection, $sqlAspToAl)) {
										//Se agregan con exito los datos del nuevo alumno
										//Obtenemos la direccion del aspirante para ahora pasarla al alumno
										$sqlDirAsp = $connection->query("SELECT `calleAspirante`, `numeroCalleAspirante`, `coloniaAspirante`, `estadoAspirante`, `ciudadAspirante`, `codPostalAspirante`, `f_creacion_DirAspirante`, `f_modificacion_DirAspirante`, `id_aspirante` FROM `direccionaspirante` 
									WHERE `id_aspirante`='$id_aspirante'");
										usleep(136000);
										if ($dirFound = $sqlDirAsp->fetch_object()) {
											//Obtenemos datos de la direccion
											$calleAlumno = $dirFound->calleAspirante;
											$numeroCalleAlumno = $dirFound->numeroCalleAspirante;
											$coloniaAlumno = $dirFound->coloniaAspirante;
											$estadoAlumno = $dirFound->estadoAspirante;
											$ciudadAlumno = $dirFound->ciudadAspirante;
											$codPostalAlumno = $dirFound->codPostalAspirante;

											//Obtener nuevo id del alumno
											$sqlIDAlumno = $connection->query("SELECT `id_alumno`  FROM `alumno`
											WHERE `email_alumno`='$email_alumno'");
											usleep(136000);
											if ($idAlFound = $sqlIDAlumno->fetch_object()) {
												$id_alumno = $idAlFound->id_alumno; //id del alumno

												//Ingresamos la direccion del alumno con los datos que tenía como aspirante
												$sqlDirAl = "INSERT INTO `direccionalumno`(`calleAlumno`, `numeroCalleAlumno`, `coloniaAlumno`, `estadoAlumno`, `ciudadAlumno`, `codPostalAlumno`, `f_creacion_DirAlumno`,`id_alumno`) 
											VALUES ('$calleAlumno','$numeroCalleAlumno','$coloniaAlumno','$estadoAlumno','$ciudadAlumno','$codPostalAlumno',NOW(),'$id_alumno')";
												usleep(136000);
												if (mysqli_query($connection, $sqlDirAl)) { //Se han enviado los datos de direccion para alumno
													//Actualizamos la tabla aspirante para que no accedan al sistema una vez actualizados a alumno
													$sqlUpdateAsp = "UPDATE `aspirante` SET `email_aspirante`='MIGRADOALUMNO',`password_aspirante`='MIGRADOALUMNO'
												WHERE `id_aspirante` ='$id_aspirante'";
													usleep(136000);
													if (mysqli_query($connection, $sqlUpdateAsp)) {
														//Se insertan los datos de pago del alumno
														$sqlPagAl = "INSERT INTO `alumno_pago`(`nombre_alumno`, `id_charge`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `email_alumno`, `f_creacion_AlPago`, `id_alumno`, `id_pago`)
													 VALUES ('$nombre_alumno','$charge[id]','$total','$charge[currency]','$charge[description]','$charge[status]','$email_alumno', NOW() ,'$id_alumno','$id_pago')";
														usleep(136000);
														if (mysqli_query($connection, $sqlPagAl)) { //Se ha realizado la insersion de datos de pago de alumno
															//Se inicia el proceso de colocacion a escuela
															//Se pregunta el nivel Educativo de sus intereses como aspirante
															if ($nombre_nivelEducativo == "Basica") { //Caso de querer ingresar a una escuela como prescolar, primaria o secundaria
																$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
																if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																	$id_aula = $resultAula->id_aula;
																	$numero_aula = $resultAula->numero_aula;
																	$grupo_aula = $resultAula->grupo_aula;
																	$nombre_aula = $resultAula->nombre_aula;
																	$numero_asientos = $resultAula->numero_asientosAula;

																	$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																	usleep(136000);
																	if (mysqli_query($connection, $sqlAlUlaInsert)) {
																		//Después de asignar al alumno a una aula
																		//Actualizamos el número de asientos que tiene el aula
																		if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																			if ($numero_asientos == 1) { //Es el último asiento
																				//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																				$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																				WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";

																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																				}
																			} else { //Mayor que 1
																				$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																			WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAula)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";
																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																				}
																			}
																		}

																	}
																} else {
																	//No hay aulas disponibles

																}

															} else if ($nombre_nivelEducativo == "Media Superior") { //Caso de querer ingresar a prepa o bach u otro
																//Buscamos un aula con lugares disponibles
																$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE
																FROM aula 
																INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela
																WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='$nombre_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' ORDER BY aula.f_creacion_aula DESC;");
																if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																	$id_aula = $resultAula->id_aula;
																	$numero_aula = $resultAula->numero_aula;
																	$grupo_aula = $resultAula->grupo_aula;
																	$nombre_aula = $resultAula->nombre_aula;
																	$numero_asientos = $resultAula->numero_asientosAula;

																	$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																	usleep(136000);
																	if (mysqli_query($connection, $sqlAlUlaInsert)) {
																		//Después de asignar al alumno a una aula
																		//Actualizamos el número de asientos que tiene el aula
																		if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																			if ($numero_asientos == 1) { //Es el último asiento
																				//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																				$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																				WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";
																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';
																				}
																			} else { //Mayor que 1
																				$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																			WHERE `id_aula` ='$id_aula'";
																				usleep(136000);
																				if (mysqli_query($connection, $sqlUpdateAsAula)) {
																					$_SESSION["subMat"] = "Al";
																					$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																					$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																					$_SESSION["nombre_aspirante"] = "";
																					$_SESSION["apellido_paternoAspirante"] = "";
																					$_SESSION["estatus_persona"] = "INSCRITO";
																					echo "
																				<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																				<script>
																					Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																					})
																				</script>";
																					$Autorizacion = true;
																					$url = 'dashboard/inicio.php';

																				}
																			}
																		}

																	}
																} else {
																	//No hay aulas disponibles

																}
															} else if ($nombre_nivelEducativo == "Superior") { //Caso de querer ingresar a la universidad
																//Variables a usar (Borrar después)

																// $nombre_facultad = $admAspData->nombre_facultad;
																// $nombre_esp = $admAspData->nombre_esp;
																// $nombre_carrera = $admAspData->nombre_carrera;
																// $id_escuela = $admAspData->id_escuela;
																// $id_nivelEducativo = $admAspData->id_nivelEducativo;
																// $id_facultad = $admAspData->id_facultad;
																// $id_carrera = $admAspData->id_carrera;
																// $id_especializacion = $admAspData->id_especializacion;

																if ($nombre_esp != "") {
																	/* */
																	//Buscamos un aula con lugares disponibles
																	$sqlAulaAl = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
																	escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_especializacion.nombre_esp
																	FROM aula 
																	INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula 
																	INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela 
																	INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																	INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																	INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																	INNER JOIN facultad_especializacion on escuela_facultad.id_facultad = facultad_especializacion.id_facultad
																	WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_especializacion.id_especializacion='$id_especializacion' ORDER BY aula.f_creacion_aula DESC;");
																	usleep(136000);
																	if ($resultAula = $sqlAulaAl->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																		$id_aula = $resultAula->id_aula;
																		$numero_aula = $resultAula->numero_aula;
																		$grupo_aula = $resultAula->grupo_aula;
																		$nombre_aula = $resultAula->nombre_aula;
																		$numero_asientos = $resultAula->numero_asientosAula;

																		$sqlAlUlaInsert = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																	VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlAlUlaInsert)) {
																			//Después de asignar al alumno a una aula
																			//Actualizamos el número de asientos que tiene el aula
																			if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																				if ($numero_asientos == 1) { //Es el último asiento
																					//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																					$sqlUpdateAsAulaF = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																			WHERE `id_aula` ='$id_aula'";
																					usleep(136000);
																					if (mysqli_query($connection, $sqlUpdateAsAulaF)) {
																						$_SESSION["subMat"] = "Al";
																						$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																						$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																						$_SESSION["nombre_aspirante"] = "";
																						$_SESSION["apellido_paternoAspirante"] = "";

																						$_SESSION["estatus_persona"] = "INSCRITO";
																						echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																					<script>
																						Swal.fire({
																							position: 'center',
																							icon: 'success',
																							title: 'Se ha relizado el pago exitosamente',
																							showConfirmButton: false,
																							timer: 1963
																						})
																					</script>";
																						$Autorizacion = true;
																						$url = 'dashboard/inicio.php';


																					}
																				} else { //Mayor que 1
																					$sqlUpdateAsAula = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																				WHERE `id_aula` ='$id_aula'";
																					usleep(136000);
																					if (mysqli_query($connection, $sqlUpdateAsAula)) {
																						$_SESSION["subMat"] = "Al";
																						$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																						$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																						$_SESSION["nombre_aspirante"] = "";
																						$_SESSION["apellido_paternoAspirante"] = "";

																						$_SESSION["estatus_persona"] = "INSCRITO";
																						echo "
																					<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																					Swal.fire({
																					position: 'center',
																					icon: 'success',
																					title: 'Se ha relizado el pago exitosamente',
																					showConfirmButton: false,
																					timer: 1963
																						})
																					</script>";
																						$Autorizacion = true;
																						$url = 'dashboard/inicio.php';
																					}
																				}
																			}

																		}
																	} else {
																		//No hay aulas disponibles

																	}
																	/* */
																} else if ($nombre_carrera != "") {
																	$sqlAulaAlCarr = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.numero_periodoE, escuela_periodoescolar.nombre_periodoE,
																escuela_facultad.nombre_facultad, facultad_aula.numero_aula, facultad_carrera.nombre_carrera
																	FROM aula 
																	INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela INNER JOIN escuela_periodoescolar on escuela_aula.id_escuela = escuela_periodoescolar.id_escuela 
																	INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela_aula.id_escuela
																	INNER JOIN facultad_aula on facultad_aula.id_aula = escuela_aula.id_aula
																	INNER JOIN facultad_carrera on escuela_facultad.id_facultad = facultad_carrera.id_facultad
																	WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.id_nivelEducativo='$id_nivelEducativo' AND escuela_aula.id_escuela='$id_escuela'  AND escuela_periodoescolar.numero_periodoE='1' AND escuela_facultad.id_facultad='$id_facultad' AND facultad_carrera.id_carrera='$id_carrera' ORDER BY aula.f_creacion_aula DESC;");
																	if ($resultAulaCarr = $sqlAulaAlCarr->fetch_object()) { //Al hacer la consulta obtenemos los datos del aula
																		$id_aula = $resultAulaCarr->id_aula;
																		$numero_aula = $resultAulaCarr->numero_aula;
																		$grupo_aula = $resultAulaCarr->grupo_aula;
																		$nombre_aula = $resultAulaCarr->nombre_aula;
																		$numero_asientos = $resultAulaCarr->numero_asientosAula;

																		$sqlAlUlaInsertC = "INSERT INTO `alumno_aula`(`nombre_alumno`, `nombre_aula`, `grupo_aula`, `f_creacion_Al_Aula`, `id_alumno`, `id_aula`) 
																				VALUES ('$nombre_alumno','$nombre_aula','$grupo_aula', NOW(),'$id_alumno','$id_aula')";
																		usleep(136000);
																		if (mysqli_query($connection, $sqlAlUlaInsertC)) {
																			//Después de asignar al alumno a una aula
																			//Actualizamos el número de asientos que tiene el aula
																			if ($numero_asientos > 0) { //Aseguramos que el valor sea siempre arriba o igual a 1
																				if ($numero_asientos == 1) { //Es el último asiento
																					//En caso de que se ocupe el ultimo asiento entonces actualizamos el estatus
																					$sqlUpdateAsAulaFC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1, `estatus_aula`=b'0'
																					WHERE `id_aula` ='$id_aula'";
																					usleep(136000);
																					if (mysqli_query($connection, $sqlUpdateAsAulaFC)) {
																						$_SESSION["subMat"] = "Al";
																						$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																						$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																						$_SESSION["nombre_aspirante"] = "";
																						$_SESSION["apellido_paternoAspirante"] = "";

																						$_SESSION["estatus_persona"] = "INSCRITO";
																						echo "
																						<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																						Swal.fire({
																						position: 'center',
																						icon: 'success',
																						title: 'Se ha relizado el pago exitosamente',
																						showConfirmButton: false,
																						timer: 1963
																							})
																						</script>";
																						$Autorizacion = true;
																						$url = 'dashboard/inicio.php';
																					}
																				} else { //Mayor que 1
																					$sqlUpdateAsAulaC = "UPDATE `aula` SET  `numero_asientosAula`=`numero_asientosAula`-1
																					WHERE `id_aula` ='$id_aula'";
																					usleep(136000);
																					if (mysqli_query($connection, $sqlUpdateAsAulaC)) {
																						$_SESSION["subMat"] = "Al";
																						$_SESSION["nombre_alumno"] = $_SESSION["nombre_aspirante"];
																						$_SESSION["apellido_paternoAlumno"] = $_SESSION["apellido_paternoAspirante"];
																						$_SESSION["nombre_aspirante"] = "";
																						$_SESSION["apellido_paternoAspirante"] = "";

																						$_SESSION["estatus_persona"] = "INSCRITO";
																						echo "
																						<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
																						<script>
																							Swal.fire({
																								position: 'center',
																								icon: 'success',
																								title: 'Se ha relizado el pago exitosamente',
																								showConfirmButton: false,
																								timer: 1963
																							})
																						</script>";
																						$Autorizacion = true;
																						$url = 'dashboard/inicio.php';


																					}
																				}
																			}

																		}
																	} else {
																		//No hay aulas disponibles

																	}
																}
															}

														}

													}
												}
											}
										}

									} else {
										//Si no se agregan los datos de alumno entonces:
									}
								}
							}
						}
					}















					/********************************* */
				}
			}

		}
		
	} else {
		// echo "<script>alert('Error al pagar!');</script>";
		//Core::alert("Error al realizar el pago!");
		echo "
			<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
			<script>
				Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Algo salió mal',
				showConfirmButton: false,
				timer: 1963
				})
			</script>";
		$Autorizacion = true;
		$url = 'dashboard/inicio.php';
	}
} catch (Exception $e) {
	echo "
		<script src=" . "//cdn.jsdelivr.net/npm/sweetalert2@11" . "></script>
		<script>
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: '" . $e->getMessage() . "',
				showConfirmButton: false,
				timer: 1963
			})
		</script>";
	$Autorizacion = true;
	$url = 'dashboard/inicio.php';
	// echo "<script>alert('" . $e->getMessage() . "');</script>";
}
if ($Autorizacion == true) {
	//                   ./Views/
	header("location:./../../../views/$url");
}
// print_r($change);
?>