<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
//  $escuela = $_POST['escuela'];
 $nivelEdu = $_POST['nivelEdu'];
 $periodoE = $_POST['periodoE'];
 $modalidadE = $_POST['modalidadE'];

    $query = "SELECT escuela.id_escuela, escuela.nombre_escuela, escuela.direccion_escuela, escuela.sector_escuela, escuela_nivelEducativo.id_nivelEducativo, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE, escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico, escuela_pago.monto FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela INNER JOIN escuela_pago on escuela.id_escuela = escuela_pago.id_escuela
    WHERE escuela_nivelEducativo.nombre_nivelEducativo = '$nivelEdu' AND escuela_periodoEscolar.nombre_periodoE = '$periodoE' AND escuela_modalidadEscolar.nombre_modalidad = '$modalidadE' AND escuela_pago.descripcion LIKE 'Exámen de Admisión%'";

  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchData= fetch_data();
show_data($fetchData);

function show_data($fetchData){
    
 echo '<table >
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <!--<th>Sector</th> -->
            <!--<th>Periodo  Escolar</th> -->
            <!--<th>Modalidad Escolar</th> -->
            <th>Exámen de Admisión</th>
            <th>Preinscripción</th> 
        </tr>';

 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){ 
        
  echo "<tr>
          <td>".$data['nombre_escuela']."</td>
          <td>".$data['direccion_escuela']."</td>
          <td>".$data['numero_telefonico']."</td>
          <!--<td>".$data['sector_escuela']."</td>-->
          <!--<td>".$data['nombre_periodoE']."</td>-->
          <!--<td>".$data['nombre_modalidad']."</td>-->
          <td>$".$data['monto'] ."</td>
          <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAdmision/backPeregistro-script.php?id_escuela=".$data['id_escuela']."&nombre_escuela=".$data['nombre_escuela']."&id_nivelEducativo=".$data['id_nivelEducativo']."&nombre_nivelEducativo=".$data['nombre_nivelEducativo']."'>Preinscribirme</a></td>
          
   </tr>";
  
  $sn++; 
     }
}else{
     
  echo "<tr>
        <td colspan='7'>Datos no encontrados</td>
       </tr>"; 
}
  echo "</table>";
}

?>