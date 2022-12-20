<?php

include("./../../../model/connection.php");
$db=$connection;
// fetch query
function fetch_data(){
 global $db;
 $nivelEdu = $_POST['nivelEdu'];

  //Query with id = SELECT escuela.nombre_escuela, escuela.direccion_escuela, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE,escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela
    //WHERE escuela.id_escuela = 5

  //Query with school name = SELECT escuela.nombre_escuela, escuela.direccion_escuela, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE,escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela
    //WHERE escuela.nombre_escuela = 'Universidad Politécnica de Amozoc'
    
  $query = "SELECT escuela.id_escuela, escuela.nombre_escuela, escuela.direccion_escuela, escuela.sector_escuela, escuela_nivelEducativo.id_nivelEducativo, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE, escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico, escuela_facultad.id_facultad, escuela_facultad.nombre_facultad, facultad_carrera.nombre_carrera, facultad_carrera.id_carrera, escuela_pago.monto FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela.id_escuela INNER JOIN facultad_carrera on facultad_carrera.id_facultad = escuela_facultad.id_facultad INNER JOIN escuela_pago on escuela.id_escuela = escuela_pago.id_escuela
  WHERE escuela_nivelEducativo.nombre_nivelEducativo = '$nivelEdu' AND escuela_pago.descripcion LIKE 'Exámen de Admisión%'";
  //$query="SELECT aspirante.id_aspirante, aspirante.nombre_aspirante, aspirante.apellido_paternoAspirante, aspirante.edad_Aspirante, aspirante.genero_Aspirante	, aspirante.email_aspirante, aspirante.f_creacion_Aspirante, aspirante.numero_tel_Aspirante FROM aspirante;";
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
    // <th>#</th>
 echo '<table>
        <tr>Nivel Licenciatura o Ingeniería</tr>
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <!--<th>Sector</th> -->
            <!--<th>Periodo  Escolar</th> -->
            <!--<th>Modalidad Escolar</th> -->
            <th>Carrera</th> 
            <th>Exámen de Admisión</th>
            <th>Preinscripción</th>
        </tr>';

 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){ 
        // <td>".$sn."</td>
  echo "<tr>
          <td>".$data['nombre_escuela']."</td>
          <td>".$data['direccion_escuela']."</td>
          <td>".$data['numero_telefonico']."</td>
          <!--<td>".$data['sector_escuela']."</td>-->
          <!--<td>".$data['nombre_periodoE']."</td>-->
          <!--<td>".$data['nombre_modalidad']."</td>-->
          <td>".$data['nombre_carrera']."</td>
          <td>$".$data['monto'] ."</td>
          <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAdmision/backPeregistro-script.php?id_escuela=".$data['id_escuela']."&nombre_escuela=".$data['nombre_escuela']."&id_nivelEducativo=".$data['id_nivelEducativo']."&nombre_nivelEducativo=".$data['nombre_nivelEducativo']."&id_facultad=".$data['id_facultad']."&nombre_facultad=".$data['nombre_facultad']."&nombre_carrera=".$data['nombre_carrera']."&id_carrera=".$data['id_carrera']."'>Preinscribirme</a></td>
          
   </tr>";
//    <td><a href='crud-form.php?delete=".$data['id_escuela']."'>Delete</a></td>
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

function fetch_dataEspEsp(){
 global $db;
 $nivelEdu = $_POST['nivelEdu'];

  //Query with id = SELECT escuela.nombre_escuela, escuela.direccion_escuela, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE,escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela
    //WHERE escuela.id_escuela = 5

  //Query with school name = SELECT escuela.nombre_escuela, escuela.direccion_escuela, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE,escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela
    //WHERE escuela.nombre_escuela = 'Universidad Politécnica de Amozoc'
    
  $query = "SELECT escuela.id_escuela, escuela.nombre_escuela, escuela.direccion_escuela, escuela.sector_escuela, escuela_nivelEducativo.id_nivelEducativo, escuela_nivelEducativo.nombre_nivelEducativo, escuela_periodoEscolar.nombre_periodoE,escuela_modalidadEscolar.nombre_modalidad, escuela_Telefono.numero_telefonico, escuela_facultad.id_facultad, escuela_facultad.nombre_facultad, facultad_especializacion.nombre_esp, facultad_especializacion.id_especializacion, escuela_pago.monto FROM escuela INNER JOIN escuela_nivelEducativo on escuela_nivelEducativo.id_escuela = escuela.id_escuela INNER JOIN escuela_periodoEscolar on escuela_periodoEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_modalidadEscolar on escuela_modalidadEscolar.id_escuela = escuela.id_escuela INNER JOIN escuela_Telefono on escuela_Telefono.id_escuela = escuela.id_escuela INNER JOIN escuela_facultad on escuela_facultad.id_escuela = escuela.id_escuela INNER JOIN facultad_especializacion on facultad_especializacion.id_facultad = escuela_facultad.id_facultad INNER JOIN escuela_pago on escuela.id_escuela = escuela_pago.id_escuela
  WHERE escuela_nivelEducativo.nombre_nivelEducativo = '$nivelEdu' AND escuela_pago.descripcion LIKE 'Exámen de Admisión%'";
  //$query="SELECT aspirante.id_aspirante, aspirante.nombre_aspirante, aspirante.apellido_paternoAspirante, aspirante.edad_Aspirante, aspirante.genero_Aspirante	, aspirante.email_aspirante, aspirante.f_creacion_Aspirante, aspirante.numero_tel_Aspirante FROM aspirante;";
  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchDataEsp= fetch_dataEspEsp();
show_dataEsp($fetchDataEsp);

function show_dataEsp($fetchDataEsp){
    // <th>#</th>
 echo '<table >
        <tr>Nivel Especialización</tr>
        <tr>
            <th>Nombre de la Escuela</th>
            <th>Dirección</th>
            <th>Número de teléfono</th>
            <!--<th>Sector</th> -->
            <!--<th>Periodo  Escolar</th> -->
            <!--<th>Modalidad Escolar</th> -->
            <th>Especialización</th> 
            <th>Exámen de Admisión</th>
            <th>Preinscripción</th>
        </tr>';

 if(count($fetchDataEsp)>0){
      $snEsp=1;
      foreach($fetchDataEsp as $dataEsp){ 
        // <td>".$sn."</td>
  echo "<tr>
          <td>".$dataEsp['nombre_escuela']."</td>
          <td>".$dataEsp['direccion_escuela']."</td>
          <td>".$dataEsp['numero_telefonico']."</td>
          <!--<td>".$dataEsp['sector_escuela']."</td>-->
          <!--<td>".$dataEsp['nombre_periodoE']."</td>-->
          <!--<td>".$dataEsp['nombre_modalidad']."</td>-->
          <td>".$dataEsp['nombre_esp']."</td>
          <td>$".$dataEsp['monto'] ."</td>
          <td><a class='primary tableAspOf' href='./../../controllers/ajax/aspAdmision/backPeregistro-script.php?id_escuela=".$dataEsp['id_escuela']."&nombre_escuela=".$dataEsp['nombre_escuela']."&id_nivelEducativo=".$dataEsp['id_nivelEducativo']."&nombre_nivelEducativo=".$dataEsp['nombre_nivelEducativo']."&id_facultad=".$dataEsp['id_facultad']."&nombre_facultad=".$dataEsp['nombre_facultad']."&nombre_esp=".$dataEsp['nombre_esp']."&id_especializacion=".$dataEsp['id_especializacion']."'>Preinscribirme</a></td>
          
   </tr>";
//    <td><a href='crud-form.php?delete=".$data['id_escuela']."'>Delete</a></td>
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