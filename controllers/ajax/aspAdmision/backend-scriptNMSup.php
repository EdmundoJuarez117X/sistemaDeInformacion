<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
//  $escuela = $_POST['escuela'];
 $nivelEdu = $_POST['nivelEdu'];
 $modalidadE = $_POST['modalidadE'];
 
  $query = "SELECT escuela.id_escuela, escuela.nombre_escuela, escuela.direccion_escuela, escuela.sector_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.nombre_periodoE,escuela_modalidadescolar.nombre_modalidad, escuela_telefono.numero_telefonico, escuela_facultad.nombre_facultad, facultad_carrera.nombre_carrera FROM escuela INNER JOIN escuela_niveleducativo on escuela_niveleducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoescolar on escuela_periodoescolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadescolar on escuela_modalidadescolar.id_escuela = escuela.id_escuela INNER JOIN escuela_telefono on escuela_telefono.id_escuela = escuela.id_escuela INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela.id_escuela INNER JOIN facultad_carrera on facultad_carrera.id_facultad = escuela_facultad.id_facultad
  WHERE escuela_niveleducativo.nombre_nivelEducativo = '$nivelEdu' AND escuela_modalidadescolar.nombre_modalidad = '$modalidadE'";

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
        <tr>Nivel Licenciatura o Ingeniería</tr>
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <th>Sector</th> 
            <th>Periodo  Escolar</th> 
            <th>Modalidad Escolar</th> 
            <th>Carrera</th> 
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
          <td>".$data['sector_escuela']."</td>
          <td>".$data['nombre_periodoE']."</td>
          <td>".$data['nombre_modalidad']."</td>
          <td>".$data['nombre_carrera']."</td>
          <td>$1,000</td>
          <td><a class='primary tableAspOf' href='backPeregistro-script.php?edit=".$data['id_escuela']."'>Preinscribirme</a></td>
          
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


//**************************************************************************************************************
//************************************************************************************************************* *
//***************************************NIVEL ESPECIALIDAD/
function fetch_dataEsp(){
 global $db;
//  $escuela = $_POST['escuela'];
 $nivelEdu = $_POST['nivelEdu'];
 $modalidadE = $_POST['modalidadE'];
 
  $query = "SELECT escuela.id_escuela, escuela.nombre_escuela, escuela.direccion_escuela, escuela.sector_escuela, escuela_niveleducativo.nombre_nivelEducativo, escuela_periodoescolar.nombre_periodoE,escuela_modalidadescolar.nombre_modalidad, escuela_telefono.numero_telefonico, escuela_facultad.nombre_facultad, facultad_especializacion.nombre_esp FROM escuela INNER JOIN escuela_niveleducativo on escuela_niveleducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoescolar on escuela_periodoescolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadescolar on escuela_modalidadescolar.id_escuela = escuela.id_escuela INNER JOIN escuela_telefono on escuela_telefono.id_escuela = escuela.id_escuela INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela.id_escuela INNER JOIN facultad_especializacion on facultad_especializacion.id_facultad = escuela_facultad.id_facultad
  WHERE escuela_niveleducativo.nombre_nivelEducativo = '$nivelEdu'AND escuela_modalidadescolar.nombre_modalidad = '$modalidadE'";

  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchDataEsp= fetch_dataEsp();
show_dataEsp($fetchDataEsp);

function show_dataEsp($fetchDataEsp){
    
 echo '<table >
        <tr>Nivel Especialización</tr>
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <th>Sector</th> 
            <th>Periodo  Escolar</th> 
            <th>Modalidad Escolar</th> 
            <th>Especialidad</th> 
            <th>Exámen de Admisión</th>
            <th>Preinscripción</th> 
        </tr>';

 if(count($fetchDataEsp)>0){
      $snEsp=1;
      foreach($fetchDataEsp as $dataEsp){ 
        
  echo "<tr>
          <td>".$dataEsp['nombre_escuela']."</td>
          <td>".$dataEsp['direccion_escuela']."</td>
          <td>".$dataEsp['numero_telefonico']."</td>
          <td>".$dataEsp['sector_escuela']."</td>
          <td>".$dataEsp['nombre_periodoE']."</td>
          <td>".$dataEsp['nombre_modalidad']."</td>
          <td>".$dataEsp['nombre_esp']."</td>
          <td>$1,000</td>
          <td><a class='primary tableAspOf' href='backPeregistro-script.php?edit=".$dataEsp['id_escuela']."'>Preinscribirme</a></td>
          
   </tr>";
  
  $snEsp++; 
     }
}else{
     
  echo "<tr>
        <td colspan='7'>Datos no encontrados</td>
       </tr>"; 
}
  echo "</table>";
}

?>