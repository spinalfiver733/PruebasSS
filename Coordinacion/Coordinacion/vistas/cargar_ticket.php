<?php

    require_once "../config/Conexion.php";
 
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$tipo = $_POST['tipo'];
$problema = $_POST['problema'];
$area_solicitante = $_POST['area_solicitante'];
$observaciones = $_POST['observaciones'];
$prioridad = $_POST['prioridad'];




        $sql = "INSERT INTO tickets (fecha,hora,tipo,problema,area_solicitante,observaciones,prioridad,adjunto) VALUES ('$fecha','$hora','$tipo','$problema','$area_solicitante','$observaciones','$prioridad','$fecha$hora$nombrex')";

        if($conexion->query($sql)){
            echo "<script>alert('SE A GENERADO EL TICKET')</script>";
            header("Refresh:0 , url = tickets.php");
            exit();

        }
        else{
            echo "<script>alert('NO SE REGISTRO EL TICKET')</script>";
            header("Refresh:0 , url = tickets.php");
            exit();

        }
    
    
    mysqli_close($conexion);
?>
