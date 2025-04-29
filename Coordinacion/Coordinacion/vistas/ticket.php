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

if ($_SESSION['mesa']==1 || $_SESSION['soporte']==1 || $_SESSION['sistemas']==1 || $_SESSION['cti']==1  )
{
require_once "../config/Conexion.php";
date_default_timezone_set('America/Mazatlan');
$fecha_actual = date("d-m-Y");
$hora_actual = date("h:i:s");
    
    $id = $_GET['id'];

                    $sql_fetch_todos = "SELECT * FROM tickets where id = $id";
                    $query = mysqli_query($conexion, $sql_fetch_todos);


?>
    <!-- Inicio Contenido PHP-->
        <div class="col-lg-12" style="background-color:#7D2735;">
            <div class="main-box clearfix" style="background-color:#98989A;color:white;">

                <div class="row">

                
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-12">
                        <div class="small-box bg-aqua">
                            
                            
                            
                        <div class="inner">
                                <br>
                                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;"><strong>Detalles del ticket <h1 style="color:red;font-size:1.5em;"><?php echo $id;?></h1></strong></h1>      
                            
                            <br>
                            <a><button class="btn btn-large"><li class="fa fa-print"></li></button></a>
                                
                                
                   <!--usuarios tabla-->              
                        <?php  
                                $sql_fetch_todos = "SELECT * FROM tickets where id = $id";
                                $query = mysqli_query($conexion, $sql_fetch_todos);
                        ?>
                    <table border ="1" class="table table-striped">


                        <thead>
                            <tr>
                                <td>id</td>
                                <td>fecha</td>
                                <td>hora</td>
                                <td>tipo</td>
                                <td>problema</td>
                                <td>area que solicita</td>
                                <td>estado</td>
                                <td>prioridad</td>
                                <td>responsable actualmente</td>
                                <td>VER</td>

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
                                    <td style="color:black;"><?php echo $row['area_solicitante'] ?></td>
                                    <td style="color:black;"><?php echo $row['estado'] ?></td>                                    
                                    <td style="color:black;"><?php echo $row['prioridad'] ?></td>
                                    <td style="color:black;"><?php echo $row['responsable'] ?></td>

                                <td style="color:black;"><a href="ticket.php?id=<?php echo $row['id'];?>"><button class="btn"><li class="fa fa-eye"></li></button></a></td>    

                                </tr>
                            <?php
                                $idpro++;
                            } ?>
                        </tbody>
                    </table>
                             
                                
 

                                
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
