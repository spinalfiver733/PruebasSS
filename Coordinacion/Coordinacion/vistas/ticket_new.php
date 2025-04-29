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
    button{
        background-image: linear-gradient(to right, green, greenyellow);
    }
    button:hover {
          background-image: linear-gradient(to left, green , greenyellow);
    }
</style>


<body onload="mueveReloj()">
    <!-- Inicio Contenido PHP-->
        <div class="col-lg-12" style="background-color:#7D2735;text-align:center;">
            <div class="main-box clearfix" style="  background-image: linear-gradient( #eff1f6 ,  #d7d9de );">

                <div class="row" onload="mueveReloj()">

                
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-8">
                        <div class="small-box bg-aqua">
                            
                                <form name="form_reloj">
                                <h3 style="color:green;float:left;"><strong>Fecha: <?php echo $fecha_actual;?>     :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::    Hora:  <input style="background-color:cyan;" type="text" name="reloj" readonly size="10"></strong></h3>
                                   
                                </form>                            
                            
                            <div class="inner">
                                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;">Generar nuevo ticket</h1>      
                                

                                
                                
                            <form action="cargar_ticket.php" method="POST" enctype="multipart/form-data">   


                                
                            
    
    
                                <br><br>
                                
                                <table class="table table-striped">
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong>Tipo de ticket: </strong></h2></td>
                                        <td style="float:left;">                                
                                            <select name="tipo" style="font-size:1.5em;">
                                                  <option value="CTI" style="color:black;">TICKET PARA CTI</option>
                                                  <option value="SOPORTE" style="color:black;">TICKET SOPORTE</option>
                                                  <option value="SISTEMAS" style="color:black;">TICKET SISTEMAS</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Problema a resolver: </strong></h2></td>
                                        <td style="float:left;">                                
                                            <select name="problema"  style="font-size:1.5em;">
                                                    <?php  
                                                            $sql_fetch_todos_problemas = "SELECT * FROM catalogo_problemas";
                                                            $query_problemas = mysqli_query($conexion, $sql_fetch_todos_problemas);
                                                        foreach ($query_problemas as $opciones_problemas): 

                                                    ?>                                

                                            <option value="<?php echo $opciones_problemas ['concepto']?>" style="color:black;"><?php echo $opciones_problemas ['concepto']?></option>

                                                    <?php endforeach ?>
                                            </select>
                                        </td>
                                    </tr>  
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Área en la que se presenta el problema: </strong></h2></td>
                                        <td style="float:left;">                                
                                          <input type="text" name="area_solicitante" style="width:600px;font-size:1.5em;"> 
                                        </td>
                                    </tr>  
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Dirigirse a: </strong></h2></td>
                                        <td style="float:left;">                                
                                          <input type="text" name="observaciones" style="width: 700px;height: 100px;color:black;font-size:1.5em;">
                                        </td>
                                    </tr>      
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Prioridad: </strong></h2></td>
                                        <td style="float:left;">                                
                                            <select name="prioridad"  style="font-size:1.5em;">
                                                <option value="NORMAL" style="color:black;">NORMAL</option>
                                                <option value="URGENTE" style="color:black;">URGENTE</option>
                                            </select>                                           
                                        </td>
                                    </tr>    
                                    
                                    
                                    
                                </table>
                                

                                
                                

                                <input type="text" name="fecha" value="<?php echo $fecha_actual;?>" hidden>
                                <input type="text" name="hora" value="<?php echo $hora_actual;?>" hidden>


                                    <button type="submit" style="width: 100%;height: 100px;"><strong><h1 style="color:white;"><li class="fa fa-ticket"></li><strong> GENERAR TICKET</strong></h1></strong></button>

                            </form>    

                                
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
    
    
    </body>
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