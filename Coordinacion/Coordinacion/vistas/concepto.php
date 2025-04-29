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

if ($_SESSION['escritorio']==1 || $_SESSION['t_soporte']==1 || $_SESSION['t_sistemas']==1 || $_SESSION['t_cti']==1)
{

    
$nombre= $_SESSION["nombre"];    
require_once "../config/Conexion.php";

        $sql_entrada = "UPDATE usuarios SET conectado = 1 where nombre = '$nombre' ";

        if($conexion->query($sql_entrada)){



    
   
    
?>
    <!-- Inicio Contenido PHP-->

<head>
    
    <style>
     
        .boton1{
              background-image: linear-gradient(to bottom right, #deded7, green);
            border-radius:15px;
            height:60px;
            
        }
        .boton1:hover{
              background-image: linear-gradient(to bottom right, green, #deded7);
            border-radius:15px;
            height:60px;
        }        
    
    </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<?
$sql_fetch_todos_sistemas = "select count(*) from tickets where tipo='SISTEMAS'; ";
$query_sistemas = mysqli_query($conexion, $sql_fetch_todos_sistemas);
$row_sistemas = mysqli_fetch_row($query_sistemas);
$total_sistemas = $row_sistemas[0];

$sql_fetch_todos_soporte = "select count(*) from tickets where tipo='SOPORTE';";
$query_soporte = mysqli_query($conexion, $sql_fetch_todos_soporte);
$row_soporte = mysqli_fetch_row($query_soporte);
$total_soporte = $row_soporte[0];
            
$sql_fetch_todos_cti = "select count(*) from tickets where tipo='CTI';";
$query_cti = mysqli_query($conexion, $sql_fetch_todos_cti);
$row_cti = mysqli_fetch_row($query_cti);
$total_cti = $row_cti[0];
          
?>


  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "TICKETS", { role: "style" } ],
        ["TICKETS DE SOPORTE", <? echo "$total_soporte";?>, "blue"],
        ["TICKETS DE SISTEMAS", <? echo "$total_sistemas";?>, "#900C3F"],
        ["TICKETS DE CTI", <? echo "$total_cti";?>, "gray"],
  
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        width: 1000,
        height: 300,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>

    
    


    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['TICKETS', 'PROBLEMAS'],
<?php
$sql_fetch_todos = "SELECT problema, COUNT(problema)
FROM tickets
GROUP BY problema
HAVING COUNT(problema) > 1;;";
$query = mysqli_query($conexion, $sql_fetch_todos);

                while ($row = mysqli_fetch_assoc($query)) { 
                    
                    
                 echo "['" .$row['problema']. "'," .$row['COUNT(problema)']. "],";
                }
                

?>
        ]);

        var options = {
          title: ' PORCENTAJE POR TIPO DE PROBLEMA',
            width: 1000,            
            'legend':'left',
            'is3D':true,    
        };

        var chart = new google.visualization.PieChart(document.getElementById('pay'));

        chart.draw(data, options);
      }
    </script>

    
    

</head>

<? $total_tickets = $total_sistemas+$total_soporte+$total_cti;?>





<h1 style="text-align:center;color:black;"><strong>En total se han generado hasta el momento <? echo $total_tickets;?> tickets</strong></h1>

<div class="container">

<table>
    <tr>
        <td style="background: radial-gradient(circle, white 0%, gray 100%);width:100%;text-align:center;color:black;border-radius:15px;width:50%;">
            <form action="estadisticas.php" method="POST" enctype="multipart/form-data">
                <table style="text-align:center;">
                    
                   <h2><strong>FILTRO DE RESULTADOS POR FECHA</strong></h2>
                    <tr>
                        <td class="col-md-4">
                        <label><strong>FECHA DE INICIO DD-MM-AA</strong></label><br>
                            <input type="text" name="inicio" >
                        </td>


                        <td class="col-md-4">
                            <label><strong>FECHA DE FIN DD-MM-AA</strong></label><br>
                            <input type="text" name="fin" >    
                        </td>


                        <td class="col-md-4"><button type="submit" style="width:100%;" class="boton1"><i class="fa fa-search"></i></button> </td>


                    </tr>    
                </table>    
            </form>            
        </td>      
    </tr>
</table>    

    
</div>
    



    <div id="barchart_values" style="width: 100%; height: 200px;"></div> 





    <div id="pay" style="width: 100%; height: 800px;"></div> <br><br>



<?php
$sql_fetch_todos_problema = "SELECT problema, COUNT(problema)
FROM tickets
GROUP BY problema
HAVING COUNT(problema) > 1;   ";
            
    $query = mysqli_query($conexion, $sql_fetch_todos_problema);

                

?>
            
   <table border="2" class="table-striped">
    <thead style="background-color:gray;color:white;">
        <tr>
            <th>PROBLEMA</th>
            <th>TICKETS</th>
        </tr>
    </thead>
       
    <tbody>
        <?php
        $idpro = 1;
        while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td style="color:black;"><?php echo $row['problema'] ?></td>
                <td style="color:black;"><?php echo $row['COUNT(problema)'] ?></td>
            </tr>
        <?php
            $idpro++;
        } ?>
    </tbody>
       
  </table>   


    <!-- Fin Contenido PHP-->



    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
<?php 
}        }
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