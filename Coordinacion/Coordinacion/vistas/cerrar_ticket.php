<!doctype html>
<html>
<head><meta charset="gb18030">
    
    <title>CAMBIO DE CONTRASEÑA / CTI</title>
   
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





        </div>
    </header>
    <!-- Header End -->

    
    
    <?php
    
    $id_archivo = $_GET['id'];
    
    
    
    ?>

   <div class="modal fade" id="mostrarmodal" tabindex="1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"  style="width:90%;background-color:#BC955C;">
           
           
           
           <div class="modal-header">
              
              <div class="col">
                  <div class="row">
                    <div class="col">
                        <img src="http://www.gamadero.cdmx.gob.mx/public/src/images/gam.png" style="width:100%;">
                        </div>                   
                    </div>

                  <div class="row">
                     <h3 style="text-align:center;">accciones llevadas a cabo para dar solución al ticket #  <h3 style="color:greenyellow;"><?php echo $id_archivo ?></h3></h3>
                  </div>
                  
              </div>
              
              
           
              
           </div>
            
            
            
            <form action="cargar_cierre_ticket.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            
                            <input tipe="text" name="id" value="<?php echo $id_archivo ?>" hidden>    

                            <textarea type="text" name="comentario"></textarea>
                        <br><br><br>
                            
                            <div class="row">
                                    <div class="col">
                                        <button class="btn btn-success" type="submit"><h3 style="text-align:center;">agregar comentario</h3></button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-danger"><a onclick="history.back()"><h3 style="text-align:center;">regresar</h3></a></button>
                                    </div>    
                            </div>                        
                                


                    </div>
                
            </form>    
            
      </div>
      </div>


    </div>   
</body>
</html>