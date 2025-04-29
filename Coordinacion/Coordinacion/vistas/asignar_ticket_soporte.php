<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
    
    
}
else
{
require 'header.php';

if ($_SESSION['soporte']==1)
{
require_once "../config/Conexion.php";
date_default_timezone_set('America/Mazatlan');
$fecha_actual = date("d-m-Y");
$hora_actual = date("h:i:s");

    
$id_ticket = $_GET['id'];    
    
?>
    
<style>
    button{
        background-image: linear-gradient(to right, green, greenyellow);
    }
    button:hover {
          background-image: linear-gradient(to left, green , greenyellow);
    }
</style>


<!-- Inicio Contenido PHP-->
        <div class="col-lg-12" style="background-color:#7D2735;">
            <div class="main-box clearfix" style="background-color:#98989A;color:white;">

                <div class="row">


 <div class="main-box-body clearfix" >
    <div class="col-sm-12">
        <div class="small-box bg-aqua">



            <div class="inner">
                <br>
                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;">Asignación del ticket # <?php echo $id_ticket ?></h1>      


                   <!--usuarios tabla-->              
                        <?php  
                                $sql_fetch_todos = "SELECT * FROM tickets WHERE TIPO = 'SOPORTE' AND id = '$id_ticket'";
                                $query = mysqli_query($conexion, $sql_fetch_todos);
                        ?>


<div class="table-responsive">                        
                    <table border ="1" class="table table-striped">


                        <thead>
                            <tr>
                                <td>id</td>
                                <td>fecha</td>
                                <td>hora</td>
                                <td>tipo</td>
                                <td>problema</td>
                                <td>comentarios</td>                                
                                <td>area que solicita</td>
                                <td>estado</td>
                                <td>prioridad</td>
                                <td>responsable actualmente</td>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $idpro = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td style="color:black;"><?php echo $row['id'] ?></td>
                                    <td style="color:black;"><?php echo $row['fecha'] ?></td>
                                    <td style="color:black;"><?php echo $row['hora'] ?></td>
                                    <td style="color:black;"><?php echo $row['tipo'] ?></td>
                                    <td style="color:black;"><?php echo $row['problema'] ?></td>
                                    <td style="color:black;"><?php echo $row['observaciones'] ?></td>                              
                                    <td style="color:black;"><?php echo $row['area_solicitante'] ?></td>
                                    <td style="color:black;"><?php echo $row['estado'] ?></td>                                    
                                    <td style="color:black;"><?php echo $row['prioridad'] ?></td>
                                    <td style="color:black;"><?php echo $row['responsable'] ?></td>
   

                                </tr>
                            <?php
                                $idpro++;
                            } ?>
                        </tbody>
                    </table>
                
                
                
                        
                <form action="update_ticket_soporte.php" method="POST" enctype="multipart/form-data">
                     <div style="text-align:center;">
                        <td style="float:center;"><h1 style="color:#9F2241;"><strong> Asignar ticket al técnico: </strong></h1></td>
                        <td style="float:left;">                                
                            <select type="text" name="tecnico">
                                    <?php  
                                            $sql_fetch_todos_problemas = "SELECT * FROM usuarios where conectado = 1 AND direccion = 'tecnico_soporte'";
                                            $query_problemas = mysqli_query($conexion, $sql_fetch_todos_problemas);
                                        foreach ($query_problemas as $opciones_problemas): 

                                    ?>                                

                            <option value="<?php echo $opciones_problemas ['nombre']?>" style="color:green;"><h1><?php echo $opciones_problemas ['nombre']?></h1></option>

                                    <?php endforeach ?>
                            </select>
                        </td>
                         
                         <input type="text" value="<?php echo $id_ticket;?>" hidden name="id">
                            <br><br>
                            <button type="submit" style="width: 50%;height: 100px;"><strong><h1 style="color:white;"> ASIGNAR TICKET <li class="fa fa-arrow-right"></li></h1></strong></button>                         
                    </div> 
                    

                    
                </form>    


            </div>
        </div>
      </div>






</div>
                

                <div class="main-box-body clearfix" >
                </div>
                
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

<script type='text/javascript'>
	document.oncontextmenu = function(){return false}
</script>


<script type='text/javascript'>
$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>