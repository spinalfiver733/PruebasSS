<?php
require_once "../config/Conexion.php";

// Configuramos la zona horaria
date_default_timezone_set('America/Mexico_City');
// Obtenemos la hora actual en formato 24 horas
$hora_inicio = date("H:i:s");

$tecnico = $_POST['tecnico'];
$id = $_POST['id'];

// Agregamos hora_inicio al UPDATE
$sql = "UPDATE tickets SET 
        responsable = '$tecnico',
        estado = 'asignado',
        hora_inicio = '$hora_inicio' 
        WHERE id = '$id'";

if($conexion->query($sql)){
    echo "<script>alert('SE HA ASIGNADO EXITOSAMENTE')</script>";
    header("Refresh:0 , url = tickets_sistemas.php");
    exit();
}
else{
    echo "<script>alert('NO SE REGISTRÓ')</script>";
    header("Refresh:0 , url = index.php");
    exit();
}

mysqli_close($conexion);
?>