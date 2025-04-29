<?php

    require_once "../config/Conexion.php";
 
$sesion = $_GET['sesion'];



        $sql = "UPDATE usuarios SET conectado = 0 where nombre = '$sesion' ";

        if($conexion->query($sql)){
            header("Refresh:0 , url = ../ajax/usuarios.php?op=salir");
            exit();

        }


    
    mysqli_close($conexion);
?>
