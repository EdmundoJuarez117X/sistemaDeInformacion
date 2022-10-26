<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
  $query="SELECT * FROM cursos";
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
 echo '<table border="1">
        <tr>
            <th>Curso</th>
            <th>Total de accesos</th>
            <th>Accesos registrados</th>
            <th>Costo unitario</th>
            <th>Estado</th>
        </tr>';

 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){ 

  echo "<tr>
          <td>".$data['nombre_curso']."</td>
          <td>".$data['total_participantes']."</td>
          <td>".$data['participantes_registrados']."</td>
          <td>".$data['costo_unitario']."</td>
          <td>".$data['estatus_curso']."</td>
          <td><a href='actualizar-curso.php'>Edit</a></td>
          <td><button class='btn-visible-course'>Active</button></td>
   </tr>";
       
  $sn++; 
     }
}else{
     
  echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>"; 
}
  echo "</table>";
}

?>