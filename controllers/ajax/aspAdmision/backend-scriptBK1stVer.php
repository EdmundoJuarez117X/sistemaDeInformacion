<?php

include("./../../../model/connection.php");
$db = $connection;
// fetch query
function fetch_data()
{
  global $db;
  $escuela = $_POST['escuela'];

  $query = "SELECT `id_escuela`, `nombre_escuela`, `nombre_corto_esc`, `estatus_escuela`, `logotipo_escuela`, `direccion_escuela`, `sector_escuela`, `f_creacion_esc`, `f_modificacion_esc` FROM `escuela` where `nombre_escuela` = '$escuela'";
  //$query="SELECT aspirante.id_aspirante, aspirante.nombre_aspirante, aspirante.apellido_paternoAspirante, aspirante.edad_Aspirante, aspirante.genero_Aspirante	, aspirante.email_aspirante, aspirante.f_creacion_Aspirante, aspirante.numero_tel_Aspirante FROM aspirante;";
  $exec = mysqli_query($db, $query);
  if (mysqli_num_rows($exec) > 0) {
    $row = mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;

  } else {
    return $row = [];
  }
}
$fetchData = fetch_data();
show_data($fetchData);

function show_data($fetchData)
{
  // <th>#</th>
  echo '<table >
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Sector</th> 
            <th>Exámen de Admisión</th>
            <th>Inscripción</th> 
        </tr>';

  if (count($fetchData) > 0) {
    $sn = 1;
    foreach ($fetchData as $data) {
      // <td>".$sn."</td>
      echo "<tr>
          <td>" . $data['nombre_escuela'] . "</td>
          <td>" . $data['direccion_escuela'] . "</td>
          <td>" . $data['sector_escuela'] . "</td>
          <td>$1,000</td>
          <td><a class='primary tableAspOf' href='crud-form.php?edit=" . $data['id_escuela'] . "'>Inscribirme</a></td>
          
   </tr>";
      //    <td><a href='crud-form.php?delete=".$data['id_escuela']."'>Delete</a></td>
      $sn++;
    }
  } else {

    echo "<tr>
        <td colspan='7'>Datos no encontrados</td>
       </tr>";
  }
  echo "</table>";
}

?>