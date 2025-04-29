<?php

    require_once "../config/Conexion.php";
 
$id = $_POST['id'];
$tipo = $_POST['tipo'];
$problema = $_POST['problema'];
$area_solicitante = $_POST['area_solicitante'];
$observaciones = $_POST['observaciones'];
$prioridad = $_POST['prioridad'];



        $sql = "UPDATE tickets SET tipo = '$tipo',problema = '$problema',area_solicitante='$area_solicitante',observaciones = '$observaciones',prioridad = '$prioridad' where id = '$id' ";

        if($conexion->query($sql)){
            echo "<script>alert('SE A ACTUALIZADO LA INFORMACIÓN DEL TICKET')</script>";
            header("Refresh:0 , url = tickets.php");
            exit();

        }
        else{
            echo "<script>alert('NO SE ACTUALIZÓ LA INFORMACIÓN')</script>";
            header("Refresh:0 , url = index.php");
            exit();

        }

    
    mysqli_close($conexion);
?>
