

<table border="2">
<thead>  
<tr>
<th>Nombre</th>
<th>Imagen</th>
</tr>
</thead>
<tbody>
<?php
require "../config/Conexion.php";

$ruta=$_POST['idpago'];
$sql= "SELECT 'imagen' FROM 'pagos' where 'idpago'=$ruta";
$resultado = $conexion->query($sql);
while($row = $resultado->fetch_assoc()){

?>
<tr>
<td><?php echo $row['idpago'];?></td> 
<td><img src='../files/comprobantes/".$imagen."' height='50px' width='50px' ></td>

</tr> 
<?php
            }
?>
</tbody>  
</table>