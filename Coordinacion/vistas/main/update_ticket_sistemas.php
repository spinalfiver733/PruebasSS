<?php

    require_once "../../config/Conexion.php";
 
$tecnico = $_POST['tecnico'];
$id = $_POST['id'];

echo $_POST['tecnico'];
echo $_POST['id'];


        $sql = "UPDATE tickets SET responsable = '$tecnico' where id = '$id')";

        if($conexion->query($sql)){
            echo "<script>alert('SE A REGISTRADO EXITOSAMENTE')</script>";
            header("Refresh:0 , url = modalf.php");
            exit();

        }
        else{
            echo "<script>alert('NO SE REGISTRO')</script>";
            header("Refresh:0 , url = index.php");
            exit();

        }

    
    mysqli_close($conexion);
?>
