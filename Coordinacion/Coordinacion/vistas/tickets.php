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
<style>
    body {
    background-color: #f0f0f0; /* Fondo gris claro */
    font-family: Arial, sans-serif;
}

.contenedor-tablas {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px;
}


.tabla-container {
            width: 150%;
            max-width: 900px; /* Evita que la tabla sea demasiado ancha */
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
       
table {
    width: 160%;
    border-collapse: collapse;
    margin: 10px 0;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #003366; /* Azul oscuro */
    color: white;
    position: sticky;
    top: 0;
    z-index: 2;
}

tbody {
    display: block;
    height: 300px; /* Ajusta según necesites */
    overflow-y: auto;
    width: 100%;
}

thead, tbody tr {
    display: table;
    width: 110%;
    table-layout: fixed;
}

.tabla-header {
    text-align: center;
    background-color: #9F2241;
    color: white;
    padding: 10px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    width: 80%;
}

.estado {
    border-radius: 50%;
    color: white;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    display: inline-block;
    width: 90px;
}

.estado-sin-asignar {
    background-color: red;
}

.estado-asignado {
    background-color: cyan;
}

.estado-cerrado {
    background-color: green;
}

.status-online {
    color: green;
    font-weight: bold;
}



</style>

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
</div> 
</div> 

                             
       <!--usuarios conectados-->                                 
                                
 

                     
                     
       <!--usuarios conectados-->              
        <aside style="float:right;background-color:#9F2241;">
        <center>
        <h3>usuarios conectados</h3>
        </center>
            <?php  
                    $sql_fetch_todos = "SELECT * FROM usuarios where conectado = 1";
                    $query = mysqli_query($conexion, $sql_fetch_todos);
            ?>
        <table  border ="1" class="table - table-striped">
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


        <script type="text/javascript" src="scripts/clientes.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>  


