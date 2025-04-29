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
              background-image: linear-gradient(to bottom right, #deded7, yellow);
            border-radius:15px;
            height:60px;
            
        }
        .boton1:hover{
              background-image: linear-gradient(to bottom right, yellow, #deded7);
            border-radius:15px;
            height:60px;
        }        
    
    </style>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<?
            
$f_inicio = $_POST['inicio'];            
$f_fin = $_POST['fin'];            
            
            
            
$sql_fetch_todos_sistemas = "select count(*) from tickets where tipo='SISTEMAS' AND fecha BETWEEN '$f_inicio' AND '$f_fin'; ";
$query_sistemas = mysqli_query($conexion, $sql_fetch_todos_sistemas);
$row_sistemas = mysqli_fetch_row($query_sistemas);
$total_sistemas = $row_sistemas[0];


$sql_fetch_todos_soporte = "select count(*) from tickets where tipo='SOPORTE'  AND fecha BETWEEN '$f_inicio' AND '$f_fin'; ";
$query_soporte = mysqli_query($conexion, $sql_fetch_todos_soporte);
$row_soporte = mysqli_fetch_row($query_soporte);
$total_soporte = $row_soporte[0];
            
            
$sql_fetch_todos_cti = "select count(*) from tickets where tipo='CTI'  AND fecha BETWEEN '$f_inicio' AND '$f_fin'; ";
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
        ["TICKETS DE SISTEMAS", <? echo "$total_sistemas";?>, "orange"],
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
        width: 1200,
        height: 300,
        bar: {groupWidth: "95%"},
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
$f_inicio = $_POST['inicio'];            
$f_fin = $_POST['fin'];  
            
$sql_fetch_todos = "SELECT problema, COUNT(problema)
FROM tickets where fecha BETWEEN '$f_inicio' AND '$f_fin'
GROUP BY problema ;";
$query = mysqli_query($conexion, $sql_fetch_todos);

                while ($row = mysqli_fetch_assoc($query)) { 
                    
                    
                 echo "['" .$row['problema']. "'," .$row['COUNT(problema)']. "],";
                }
                

?>
        ]);

        var options = {
          title: ' PORCENTAJE POR TIPO DE PROBLEMA',
          'is3D':true,    

        };

        var chart = new google.visualization.PieChart(document.getElementById('pay'));

        chart.draw(data, options);
      }
    </script>    
    


</head>

<? $total_tickets = $total_sistemas+$total_soporte+$total_cti;?>





<h1 style="text-align:center;color:black;"><strong>En total se han generado hasta el momento <? echo $total_tickets;?> tickets entre el <?echo $f_inicio;?> y el <?echo $f_fin;?> </strong></h1>

<div class="container">
<form action="estadisticas.php" method="POST" enctype="multipart/form-data" style="background: radial-gradient(circle, white 0%, gray 100%);width:50%;text-align:center;color:black;">
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
</div>



    <div id="barchart_values" style="width: 100%; height: 300px;"></div> 

    <div id="pay" style="width: 100%; height: 800px;"></div> 



<?php
$sql_fetch_todos_problema = "SELECT problema, COUNT(problema)
FROM tickets where fecha BETWEEN '$f_inicio' AND '$f_fin'
GROUP BY problema;   ";
            
    $query_p = mysqli_query($conexion, $sql_fetch_todos_problema);     
?>
            
   <table border="2" class="table-striped">
    <thead style="background-color:gray;color:white;">
        <tr>
            <th>No</th>
            <th>PROBLEMA</th>
            <th>TICKETS</th>
        </tr>
    </thead>
       
    <tbody>
        <?php
        $idpro = 1;
        while ($row_p = mysqli_fetch_assoc($query_p)) { ?>
            <tr>
                <td style="color:black;"><?php echo $idpro ?></td>                
                <td style="color:black;"><?php echo $row_p['problema'] ?></td>
                <td style="color:black;"><?php echo $row_p['COUNT(problema)'] ?></td>
            </tr>
        <?php
            $idpro++;
        } ?>
    </tbody>
       
  </table>  

<br><br>
<br><br>
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