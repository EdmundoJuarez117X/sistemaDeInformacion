<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
  $query="SELECT aspirante.id_aspirante, aspirante.nombre_aspirante, aspirante.apellido_paternoAspirante, aspirante.edad_Aspirante, aspirante.genero_Aspirante	, aspirante.email_aspirante, aspirante.f_creacion_Aspirante, aspirante.numero_tel_Aspirante FROM aspirante;";
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
            <th>#</th>
            <th>Primer Nombre</th>
            <th>Apellido Paterno</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Correo Electronico</th>
            <th>Numero de Teléfono</th>
            <th>Fecha en que se registró</th>
        </tr>';

 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){ 

  echo "<tr>
          <td>".$sn."</td>
          <td>".$data['nombre_aspirante']."</td>
          <td>".$data['apellido_paternoAspirante']."</td>
          <td>".$data['edad_Aspirante']."</td>
          <td>".$data['genero_Aspirante']."</td>
          <td class='primary'>".$data['email_aspirante']."</td>
          <td>".$data['numero_tel_Aspirante']."</td>
          <td>".$data['f_creacion_Aspirante']."</td>
          <td><a href='crud-form.php?edit=".$data['id_aspirante']."'>Edit</a></td>
          <td><a href='crud-form.php?delete=".$data['id_aspirante']."'>Delete</a></td>
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