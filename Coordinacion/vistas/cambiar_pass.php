<?php


require_once "../config/Conexion.php";
	
    $usuario = $_POST['usuario'];
	$pass = $_POST['pass'];    

if ($pass != "") {



$query="UPDATE usuarios SET  clave = '$pass' WHERE nombre ='$usuario'";
    if ($conexion->query($query)) {
 
        header("Location: concepto.php");           

        
    } else {
        echo "Error al Comentar, vuelva a intentarlo";
    }
    
}  

else {
        echo "No ingresó datos";
        header("Location: pass.php?sesion=$usuario");           
    
    }

?>

