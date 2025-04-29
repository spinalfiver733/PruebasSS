


	<meta http-equiv="refresh" content="60" />



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

if ($_SESSION['t_cti']==1)
{
require_once "../config/Conexion.php";
date_default_timezone_set('America/Mazatlan');
$fecha_actual = date("d-m-Y");
$hora_actual = date("h:i:s");
    
$nombre_sesion = $_SESSION["nombre"];    
    
?>
    <!-- Inicio Contenido PHP-->
        <div class="col-lg-12" style="background-color:#7D2735;">
            <div class="main-box clearfix" style="background-color:#98989A;color:white;">

                <div class="row">

                
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-8">
                        <div class="small-box bg-aqua">
                            
                            
                            
                            <div class="inner">
                                <br>
                                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;">Tickets que te fueron asignados</h1>      
                                
                                
       <!--usuarios conectados-->              
            <?php 
                    $sql_fetch_todos = "SELECT * FROM tickets WHERE tipo = 'CTI' AND responsable = '$nombre_sesion'  ORDER BY id DESC";
                    $query = mysqli_query($conexion, $sql_fetch_todos);
            ?>

<div class="table-responsive">            
        <table border ="1" class="table table-striped">
            
            
            <thead>
                <tr style="color:white;background-color:blue;">
                    <td>folio</td>
                    <td>fecha</td>
                    <td>hora</td>
                    <td>tipo</td>
                    <td>problema</td>
                    <td>observaciones</td>                    
                    <td>area que solicita</td>
                    <td>prioridad</td>
                    <td>responsable</td>
                    <td>estado</td>                    
                    <td>IMPRIMIR</td>
                    
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
                        <td style="color:black;"><?php echo $row['prioridad'] ?></td>
                        <td style="color:black;"><?php echo $row['responsable'] ?></td>
                        
                            <?php 
                              if ($row['estado'] == 'sin asignar'){
                                  ?>
                                  <td style="background-color:red;border-radius:50%;">  
                                      <a href="asignar_ticket.php?id=<?php echo $row['id'] ;?>" style="color:black;text-align:center;">SIN ASIGNAR</a></td>
                                    <?php
                              }
                                  else if  ($row['estado'] == 'asignado'){                                ?>
                                 <td  style="background-color:cyan;border-radius:50%;">   <a style="color:black;text-align:center;">ASIGNADO</a></td>
                                    <?php
                                  }
                                  else if  ($row['estado'] == 'cerrado'){                                ?>
                                 <td  style="background-color:green;border-radius:50%;">   <a style="color:black;text-align:center;">CERRADO</a></td>
                                    <?php
                                  }         
                                  else if  ($row['estado'] == 'pendiente'){                                ?>
                                 <td  style="background-color:orange;border-radius:50%;">   <a style="color:white;text-align:center;">PENDIENTE</a></td>
                                    <?php
                                  }                                                               
                            ?>
                        
                    <td style="color:black;">
                        <a href="imprimir.php?id=<?php echo $row['id'];?>" style="color:black;"><button style="width:100%;height:50px;"><li class="fa fa-print"> IMPRIMIR TICKET</li></button>
                        </a>
                        <a href="cerrar_ticket.php?id=<?php echo $row['id'];?>" style="color:black;"><button style="width:100%;height:50px;"><li class="fa fa-close"> CERRAR TICKET</li></button>
                        </a>   
                        <a href="pendiente_ticket.php?id=<?php echo $row['id'];?>" style="color:black;"><button style="width:100%;height:50px;"><li class="fa fa-clock-o"> MARCAR COMO PENDIENTE </li></button>
                        </a>                          
                    </td>  
                    
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
</div>        
       <!--usuarios conectados-->                                 
                                
 

                                
                            </div>
                        </div>
                      </div>
                     
                     
                     
       <!--usuarios conectados-->              
        <aside style="float:right;background-color:gray;text-align:center;">
        <h2 STYLE="COLOR:WHITE;"><STRONG>USUARIOS CONECTADOS : SISTEMAS</STRONG></h2>
            <?php  
                    $sql_fetch_todos = "SELECT * FROM usuarios where conectado = 1 AND direccion = 'tecnico_cti'";
                    $query = mysqli_query($conexion, $sql_fetch_todos);
            ?>
        <table border ="1" class="table - table-striped">
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td style="color:black;"><?php echo $idpro ?></td>
                        <td style="color:black;"><?php echo $row['nombre'] ?></td>
                        <td><span class="status" style="color:black;">
                            <i class="fa fa-circle" style="color:green;"></i> En Linea
                            </span>
                        </td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        </aside>
       <!--usuarios conectados-->              

                     
                     
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