<?php
session_start();
include('./../../../model/connection.php');
$search = $_POST['search'];
// echo '<script>alert("Welcome to Geeks for Geeks")</script>';

// echo $search;

    $db = $connection;
    // fetch query
    function fetch_data()
    {
        global $db;

        $search = $_POST['search'];
        // echo '<script>alert(' . $search . ')</script>';

        $query = "SELECT aspirante.`id_aspirante`, `subMatAsp`, `nombre_aspirante`, `segundo_nombreAspirante`, `apellido_paternoAspirante`, `apellido_maternoAspirante`, `edad_Aspirante`, `genero_Aspirante`, `estatus_Aspirante`, `numero_tel_Aspirante`, `email_aspirante`, `fecha_nacimientoAspirante`, `f_creacion_Aspirante`, `f_modificacion_Aspirante`, admisionInteresesAspirante.id_admsnIntePersona,admisionInteresesAspirante.nombre_escuela, admisionInteresesAspirante.nombre_nivelEducativo, admisionInteresesAspirante.nombre_facultad, admisionInteresesAspirante.nombre_esp, admisionInteresesAspirante.nombre_carrera, admisionInteresesAspirante.id_escuela, admisionInteresesAspirante.id_nivelEducativo, admisionInteresesAspirante.id_facultad, admisionInteresesAspirante.id_carrera, admisionInteresesAspirante.id_especializacion FROM `aspirante` INNER JOIN admisionInteresesAspirante on aspirante.id_aspirante = admisionInteresesAspirante.id_aspirante 
        WHERE aspirante.email_aspirante LIKE '$search%' AND aspirante.estatus_Aspirante != 'PREINSC' AND aspirante.estatus_Aspirante != 'INSCRITO' AND aspirante.estatus_Aspirante != 'BAJA' AND aspirante.estatus_Aspirante !='RENOVAR'";
        // $datos = 'id_aspirante, nombre_aspirante, segundo_nombreAspirante, apellido_paternoAdmin, apellido_paternoAdmin';
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

        echo '<br><table>
        <tr>
            <th>Nombre del aspirante</th>
            <!--<th>Apellido Paterno</th>-->
            <!--<th>Apellido Materno</th>-->
            <th>Número de teléfono</th>
            <th>Edad</th> 
            <!--<th>Fecha de Nacimiento</th>-->
            <th>Nombre de la Escuela</th> 
            <th>Oferta Académica</th> 
            <th>Acción</th> 
        </tr>';

        if (count($fetchData) > 0) {
            $sn = 1;
            foreach ($fetchData as $data) {

                echo "<tr>
          <td>" . $data['nombre_aspirante'] . " " . $data['segundo_nombreAspirante'] . " " . $data['apellido_paternoAspirante'] . "</td>
          <!--<td>" . $data['apellido_paternoAspirante'] . "</td>-->
          <!--<td>" . $data['apellido_maternoAspirante'] . "</td>-->
          <td class='success'>" . $data['numero_tel_Aspirante'] . "</td>
          <td>" . $data['edad_Aspirante'] . "</td>
          <!--<td>" . $data['fecha_nacimientoAspirante'] . "</td-->
          <td>" . $data['nombre_escuela'] . "</td>
          <td>" . $data['nombre_facultad'] . " ~ " . $data['nombre_esp'] . " " . $data['nombre_carrera'] . " </td>
          <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAlSearch/backAsigAsp.php?nombre_escuela=" . $data['nombre_escuela'] . "&nombre_nivelEducativo=" . $data['nombre_nivelEducativo'] . "&nombre_facultad=" . $data['nombre_facultad'] . "&nombre_carrera=" . $data['nombre_carrera'] ."&nombre_aspirante=".$data['nombre_aspirante']."&id_aspirante=".$data['id_aspirante']."'>Es mi hijo (Asignar)</a></td>
          
          
   </tr>";

                $sn++;
            }
        } else {

            echo "<tr>
        <td colspan='7'>Datos no encontrados</td>
       </tr>";
        }
        echo "</table>";
    }




//    <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAdmision/backPeregistro-script.php?id_escuela=" . $data['id_escuela'] . "&nombre_escuela=" . $data['nombre_escuela'] . "&nombre_nivelEducativo=" . $data['nombre_nivelEducativo'] . "&nombre_facultad=" . $data['nombre_facultad'] . "&nombre_carrera=" . $data['nombre_carrera'] . "&id_carrera=" . $data['id_carrera'] . "'>Es mi hijo (Asignar)</a></td>
// <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAlSearch/backAsigAsp.php?id_padreDeFamilia=".$_SESSION['id_padreDeFamilia']."&id_aspirante=".$data['id_aspirante']."&nombre_escuela=" . $data['nombre_escuela'] . "&nombre_nivelEducativo=" . $data['nombre_nivelEducativo'] . "&nombre_facultad=" . $data['nombre_facultad'] . "&nombre_carrera=" . $data['nombre_carrera'] ."&nombre_aspirante=".$data['nombre_aspirante']."'>Es mi hijo (Asignar)</a></td>
?>