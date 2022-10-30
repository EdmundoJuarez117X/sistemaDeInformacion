<?php
include("./../../model/connection.php");
$id_persona = $_SESSION["id_persona"];
$sql = $connection->query("SELECT persona.id_rol FROM persona WHERE persona.id_persona = '$id_persona'");
//Obtenemos el registro de los datos y guardamos algunos para control de acceso
if ($datos=$sql->fetch_object()) {
    $_SESSION["id_rol"]=$datos->id_rol;
}