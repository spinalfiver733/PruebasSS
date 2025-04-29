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

if ($_SESSION['mesa']==1)
{
require_once "../config/Conexion.php";
date_default_timezone_set('America/Mazatlan');
$fecha_actual = date("d-m-Y");
$hora_actual = date("h:i:s");
    
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
                                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;"><strong>Tickets generados</strong></h1>      
                                
                                
       <!--usuarios conectados-->              
            <?php  
                    $sql_fetch_todos = "SELECT * FROM tickets ORDER BY id DESC";
                    $query = mysqli_query($conexion, $sql_fetch_todos);
                    $numero = mysqli_num_rows($query);

            ?>
                            

<div class="table-responsive">

        
        <table border ="1" class="table table-striped">
   




            
            <thead>
                <tr style="color:white;background-color:blue;">
                    <td style="color:white;font-size:1.5em;">id</td>                    
                    <td style="color:white;font-size:1.5em;">fecha</td>
                    <td style="color:white;font-size:1.5em;">hora</td>
                    <td style="color:white;font-size:1.5em;">tipo</td>
                    <td style="color:white;font-size:1.5em;">problema</td>
                    <td style="color:white;font-size:1.5em;">área que solicita</td>
                    <td style="color:white;font-size:1.5em;">prioridad</td>
                    <td style="color:white;font-size:1.5em;">responsable</td>
                    <td style="color:white;font-size:1.5em;">estado</td>
                    <td style="color:white;font-size:1.5em;">comentarios de cierre</td>                    
                    
                </tr>
            </thead>
            
            <tbody class="contenidobusqueda">
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td style="color:black;"><strong><?php echo $row['id'] ?></strong></td>                        
                        <td style="color:black;"><strong><?php echo $row['fecha'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['hora'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['tipo'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['problema'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['area_solicitante'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['prioridad'] ?></strong></td>
                        <td style="color:black;"><strong><?php echo $row['responsable'] ?></strong></td>
                        
                        
                            <?php 
                              if ($row['estado'] == 'sin asignar'){
                                  ?>
                                  <td style="background-color:red;border-radius:50%;">  
                                      <a style="color:black;text-align:center;color:white;">SIN ASIGNAR</a></td>
                                    <?php
                              }
                                  else if  ($row['estado'] == 'asignado'){                                ?>
                                 <td  style="background-color:cyan;border-radius:50%;">   <a style="color:black;text-align:center;">ASIGNADO</a></td>
                                    <?php
                                  }
                                  else if  ($row['estado'] == 'cerrado'){                                ?>
                                 <td  style="background-color:green;border-radius:50%;color:white;">   <a style="color:black;text-align:center;color:white;">CERRADO</a></td>
                                    <?php
                                  }         
                                  else if  ($row['estado'] == 'pendiente'){                                ?>
                                 <td  style="background-color:orange;border-radius:50%;">   <a style="color:white;text-align:center;">PENDIENTE</a></td>
                                    <?php
                                  }                                                               
                            ?>
   
                        <td style="color:black;"><strong><?php echo $row['comentario_cierre'] ?></strong></td>
                        
                        
                    
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
        <aside style="float:right;background-color:#9F2241;">
        <h3>usuarios conectados</h3>
            <?php  
                    $sql_fetch_todos = "SELECT * FROM usuarios where conectado = 1";
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


        <script type="text/javascript" src="scripts/clientes.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>  


