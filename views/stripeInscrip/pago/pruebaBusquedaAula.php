<!DOCTYPE html>
<html>

<body>
	<!-- Aquí se dará espacio para los sweet alerts -->
</body>

</html>
<?php

include "./../../../model/connection.php";
$sql = $connection->query("SELECT aula.id_aula, aula.numero_aula, aula.nombre_aula, aula.grupo_aula, aula.numero_asientosAula, aula.estatus_aula, aula.f_creacion_aula, aula.f_modificacion_aula , escuela_aula.id_escuela, escuela_aula.nombre_escuela, escuela_niveleducativo.nombre_nivelEducativo 
FROM aula INNER JOIN escuela_aula on aula.id_aula = escuela_aula.id_aula INNER JOIN escuela_niveleducativo on escuela_aula.id_escuela = escuela_niveleducativo.id_escuela 
WHERE aula.estatus_aula=b'1' AND aula.numero_asientosAula>0 AND escuela_niveleducativo.nombre_nivelEducativo='Basica' ORDER BY aula.f_creacion_aula DESC;");
if ($results = $sql->fetch_object()) {
	$id_aula = $results->id_aula;
	$numero_aula = $results->numero_aula;
	$grupo_aula = $results->grupo_aula;
	echo '
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
			
			Swal.fire({
				position: "center",
				icon: "success",
				title: "' . $id_aula . '",
				showConfirmButton: false,
				timer: 1963
			})
		</script>';
}
?>