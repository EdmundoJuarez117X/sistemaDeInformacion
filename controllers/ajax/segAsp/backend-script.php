<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
  $query="SELECT persona.id_persona, persona.nombre_persona, persona.apellido_paterno, persona.edad_persona, persona.genero, persona.email_persona, persona.f_creacion_persona, persona_telefono.numero_telefonico FROM persona INNER JOIN persona_telefono ON persona.id_persona = persona_telefono.id_persona WHERE persona.id_rol = 5;";
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
          <td>".$data['nombre_persona']."</td>
          <td>".$data['apellido_paterno']."</td>
          <td>".$data['edad_persona']."</td>
          <td>".$data['genero']."</td>
          <td class='primary'>".$data['email_persona']."</td>
          <td>".$data['numero_telefonico']."</td>
          <td>".$data['f_creacion_persona']."</td>
          <td><a href='crud-form.php?edit=".$data['id_persona']."'>Edit</a></td>
          <td><a href='crud-form.php?delete=".$data['id_persona']."'>Delete</a></td>
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