<?php


require_once "../config/Conexion.php";
	
    $id = $_POST['id'];
	$comentario = $_POST['comentario'];    




$query="UPDATE tickets SET  comentario_cierre = '$comentario',estado='cerrado' WHERE id='$id'";
    if ($conexion->query($query)) {
 
        header("Location: concepto.php");           

        
    } else {
        echo "Error al Comentar, vuevla a intentarlo";
    }

?>

