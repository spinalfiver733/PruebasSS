<?php

    require_once "../config/Conexion.php";
 
$id = $_GET['id'];



        $sql = "UPDATE tickets SET tipo='',estado='sin asignar',responsable='sin atender' where id = '$id' ";

        if($conexion->query($sql)){
            echo "<script>alert('SE A LIMPIADO LA INFORMACIÓN DEL TICKET')</script>";
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