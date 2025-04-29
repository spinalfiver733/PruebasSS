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

    $id = $_GET['id']



    
?>






<style>
    .button_green{
        background-image: linear-gradient(to right, green, greenyellow);
    }
    .button_green:hover {
          background-image: linear-gradient(to left, green , greenyellow);
    }
    
    .button_red{
        background-image: linear-gradient(to right, yellow, red);
    }
    .button_red:hover {
          background-image: linear-gradient(to left, yellow , red);
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
                            
  
<?  
     $sql_fetch_todos = "SELECT * FROM tickets where id = '$id'";
    $query = mysqli_query($conexion, $sql_fetch_todos);
    foreach ($query as $opciones): 
    
?>          
                            
                            
                            <form name="form_reloj">
                                <h3 style="color:green;float:left;"><strong>Fecha: <?php echo $fecha_actual;?>     :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::    Hora:  <input style="background-color:cyan;" type="text" name="reloj" readonly size="10"></strong></h3>
                                   
                                </form>                            
                            
                            <div class="inner">
                                 <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;">Editar ticket # <?echo $id;?> asignado a <?echo $opciones['responsable'];?></h1>      
                                

                                
                                
                            <form action="update_ticket.php" method="POST" enctype="multipart/form-data">   


                                
                                        
                
                                <br><br>
                                
                                <table class="table table-striped">
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong>Tipo de ticket: </strong></h2></td>
                                        <td style="float:left;">                                
                                            <select name="tipo" value="<?echo $opciones['tipo'];?>" style="font-size:1.5em;">
                                                  <option value="<?echo $opciones['tipo'];?>" style="color:black;" active><?echo $opciones['tipo'];?></option>
                                                  <option value="CTI" style="color:black;">TICKET PARA CTI</option>
                                                  <option value="SOPORTE" style="color:black;">TICKET SOPORTE</option>
                                                  <option value="SISTEMAS" style="color:black;">TICKET SISTEMAS</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Problema a resolver: </strong></h2></td>
                                        <td style="float:left;">  
                                            <input name="problema" value="<? echo $opciones['problema']?>" style="color:black;font-size:1.5em;width:600px;">
                                            

                                        </td>
                                    </tr>  
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Área en la que se presenta el problema: </strong></h2></td>
                                        <td style="float:left;">                                
                                          <input type="text" name="area_solicitante" style="color:black;font-size:1.5em;width:600px;" value="<? echo $opciones['area_solicitante'];?>"> 
                                        </td>
                                    </tr>  
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Dirigirse a: </strong></h2></td>
                                        <td style="float:left;">                                
                                          <input type="text" name="observaciones" style="width:700px;color:black;font-size:1em;" value="<?echo $opciones['observaciones'];?>">
                                        </td>
                                    </tr>      
                                    
                                    <tr>
                                        <td style="float:center;"><h2 style="color:#9F2241;"><strong> Prioridad: </strong></h2></td>
                                        <td style="float:left;">                                
                                            <select name="prioridad"  style="font-size:1.5em;" value="<?echo $opciones['prioridad'];?>">
                                                  <option value="<?echo $opciones['prioridad'];?>" style="color:black;" active><?echo $opciones['prioridad'];?></option>                                                
                                                <option value="NORMAL" style="color:black;">NORMAL</option>
                                                <option value="URGENTE" style="color:black;">URGENTE</option>
                                            </select>                                           
                                        </td>
                                        
                                        
                                        
                                    </tr>    
                                    
                                    
                                    
                                </table>
                



<?php endforeach ?>                        
    
    

                                

                                
                                

                                <input type="text" name="fecha" value="<?php echo $fecha_actual;?>" hidden>
                                <input type="text" name="hora" value="<?php echo $hora_actual;?>" hidden>
                                <input type="text" value="<? echo $id?>" name="id" hidden>

                                <tr>
                                 <td>
                                     <button class="button_green" type="submit" style="width: 40%;height: 100px;"><strong><h1 style="color:white;"><li class="fa fa-ticket"></li><strong> ACTUALIZAR TICKET</strong></h1></strong></button>
                                    </td>
                                 <td>   <button onclick="history.back()" class="button_red" style="width: 40%;height: 100px;"><strong><h1 style="color:white;"><li class="fa fa-ticket"></li><strong> REGRESAR</strong></h1></strong></button>
                                    </td>    
                                </tr>


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