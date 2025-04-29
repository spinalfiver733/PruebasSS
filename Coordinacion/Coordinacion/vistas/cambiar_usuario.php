<head><meta charset="utf-8">
    
    <title>Comentarios para el cierre de ticket AGAM / CTI</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/images/logam.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- Plugins Stylesheets -->
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>

</head>
<body>
        <!-- Header Start -->
    <header class="position-absolute w-100">
        <div class="container">


<?php  
                                                         
   require_once "../config/Conexion.php";

    
    $id = $_GET['id'];
    $responsable = $_GET['responsable'];
    $tipo_tecnico = $_GET['tipo'];
                                


?>  


        </div>
    </header>
    <!-- Header End -->

    
<div class="modal fade" id="mostrarmodal" tabindex="1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"  style="width:90%;background-color:#BC955C;">
           
           <div class="modal-header">
              
              <div class="col">
                  <div class="row">
                    <div class="col">
                        <img src="img/cti.png" style="width:100%;">
                        </div>                   
                    </div>
                  




                  
                  <div class="row">
                     <h3 style="text-align:center;">CAMBIAR TÉCNICO RESPONSABLE ACTUAL AL TICKET: <?php echo $id ?> de <?php echo $tipo_tecnico ?><h3 style="color:greenyellow;"><?php echo $responsable ?></h3></h3>
                  </div>
              </div>
           </div>
            
            
            
                    <div class="modal-body">
                <form action="update_ticket_sistemas.php" method="POST" enctype="multipart/form-data">
                     <div style="text-align:center;">
                        <td style="float:center;"><h1 style="color:#9F2241;"><strong> Asignar ticket al técnico: </strong></h1></td>
                        <td style="float:left;">                                
                            <select type="text" name="tecnico">
                                    <?php  
                                            $sql_fetch_todos_problemas = "SELECT * FROM usuarios where conectado = 1 AND direccion = 'tecnico_cti'";
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
</body>
