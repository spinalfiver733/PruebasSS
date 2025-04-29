<?php
require_once "../config/Conexion.php";

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$tipo = $_POST['tipo'];
$problema = $_POST['problema'];
$area_solicitante = $_POST['area_solicitante'];
$observaciones = $_POST['observaciones'];
$prioridad = $_POST['prioridad'];
$creado_por = $_POST['creado_por'];

$sql = "INSERT INTO tickets (fecha, hora, tipo, problema, area_solicitante, observaciones, prioridad, adjunto, creado_por) 
        VALUES ('$fecha', '$hora', '$tipo', '$problema', '$area_solicitante', '$observaciones', '$prioridad', '{$fecha}{$hora}{$nombrex}', '$creado_por')";

if ($conexion->query($sql)) {
    echo "<script>alert('SE HA GENERADO EL TICKET')</script>";
    header("Refresh:0 , url = tickets.php");
    exit();
} else {
    echo "<script>alert('NO SE REGISTRO EL TICKET')</script>";
    header("Refresh:0 , url = tickets.php");
    exit();
}

mysqli_close($conexion);
?>
