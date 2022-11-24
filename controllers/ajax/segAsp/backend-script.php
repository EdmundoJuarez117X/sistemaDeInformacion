<?php

include("./../../../model/connection.php");
$db = $connection;
// fetch query
function fetch_data()
{
  global $db;
  $query = "SELECT `id_admsnIntePersona`, `nombre_escuela`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `nombre_facultad`, `nombre_esp`, `nombre_carrera`, `numero_grado`, `f_creacion_admsnIntePersona`, `f_modificacion_admsnIntePersona`, admisioninteresesaspirante.id_aspirante, `id_carrera`, `id_especializacion`, aspirante.nombre_aspirante, aspirante.apellido_paternoAspirante, aspirante.edad_Aspirante, aspirante.genero_Aspirante, aspirante.email_aspirante, aspirante.numero_tel_Aspirante FROM `admisioninteresesaspirante` INNER JOIN aspirante on admisioninteresesaspirante.id_aspirante = aspirante.id_aspirante;";
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
  echo '<table border="1">
        <tr>
            <th>#</th>
            <th>Primer Nombre</th>
            <th>Apellido Paterno</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Correo Electronico</th>
            <th>Numero de Teléfono</th>
            <th>Nombre de la Escuela</th>
            <th>Nivel Educativo</th>
            <th>Oferta Académica</th>
            <th>Acción</th>
            <th>Descartar</th>
            
        </tr>';
  // <th>Fecha en que se registró</th>
  if (count($fetchData) > 0) {
    $sn = 1;
    foreach ($fetchData as $data) {
      if ($data['nombre_nivelEducativo'] == 'Superior') {
        if ($data['nombre_esp'] != "") {
          echo "<tr>
          <td>" . $sn . "</td>
          <td>" . $data['nombre_aspirante'] . "</td>
          <td>" . $data['apellido_paternoAspirante'] . "</td>
          <td>" . $data['edad_Aspirante'] . "</td>
          <td>" . $data['genero_Aspirante'] . "</td>
          <td class='primary'>" . $data['email_aspirante'] . "</td>
          <td>" . $data['numero_tel_Aspirante'] . "</td>
          <td>" . $data['nombre_escuela'] . "</td>
          <td>" . $data['nombre_nivelEducativo'] . "</td>
          <td>" . $data['nombre_facultad'] . " ".$data['nombre_esp']."</td>
          <td><a style='color:var(--color-success);'href='crud-form.php?edit=" . $data['id_aspirante'] . "'>Actualizar</a></td>
          <td class='danger'><a style='color:var(--color-danger);' href='crud-form.php?delete=" . $data['id_aspirante'] . "'>Eliminar</a></td>
        </tr>";
        } else if ($data['nombre_carrera'] != "") {
          echo "<tr>
          <td>" . $sn . "</td>
          <td>" . $data['nombre_aspirante'] . "</td>
          <td>" . $data['apellido_paternoAspirante'] . "</td>
          <td>" . $data['edad_Aspirante'] . "</td>
          <td>" . $data['genero_Aspirante'] . "</td>
          <td class='primary'>" . $data['email_aspirante'] . "</td>
          <td>" . $data['numero_tel_Aspirante'] . "</td>
          <td>" . $data['nombre_escuela'] . "</td>
          <td>" . $data['nombre_nivelEducativo'] . "</td>
          <td>" . $data['nombre_facultad'] . " ".$data['nombre_carrera']."</td>
          <td><a style='color:var(--color-success);'href='crud-form.php?edit=" . $data['id_aspirante'] . "'>Actualizar</a></td>
          <td class='danger'><a style='color:var(--color-danger);' href='crud-form.php?delete=" . $data['id_aspirante'] . "'>Eliminar</a></td>
        </tr>";
        }
      } else {
        echo "<tr>
          <td>" . $sn . "</td>
          <td>" . $data['nombre_aspirante'] . "</td>
          <td>" . $data['apellido_paternoAspirante'] . "</td>
          <td>" . $data['edad_Aspirante'] . "</td>
          <td>" . $data['genero_Aspirante'] . "</td>
          <td class='primary'>" . $data['email_aspirante'] . "</td>
          <td>" . $data['numero_tel_Aspirante'] . "</td>
          <td>" . $data['nombre_escuela'] . "</td>
          <td>" . $data['nombre_nivelEducativo'] . "</td>
          <td><--</td>
          <td><a style='color:var(--color-success);'href='./../../controllers/ajax/segAsp/backend-scriptUpgrade.php?edit=" . $data['id_aspirante'] . "'>Actualizar</a></td>
          <td class='danger'><a style='color:var(--color-danger);' href='./../../controllers/ajax/segAsp/backend-scriptDelete.php?delete=" . $data['id_aspirante'] . "'>Eliminar</a></td>
        </tr>";
      }


      //  <td>".$data['f_creacion_Aspirante']."</td>

      $sn++;
    }
  } else {

    echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>";
  }
  echo "</table>";
}

?>