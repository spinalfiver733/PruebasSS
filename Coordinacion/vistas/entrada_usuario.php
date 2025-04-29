<?php

    require_once "../config/Conexion.php";
 
$sesion = $_GET['login'];



        $sql = "UPDATE usuarios SET conectado = 1 where nombre = '$sesion' ";

        if($conexion->query($sql)){
            header("Refresh:0 , url = concepto.php");
            exit();

        }


    
    mysqli_close($conexion);
?>
