<?php
require_once "../config/Conexion.php";

// Configuramos la zona horaria
date_default_timezone_set('America/Mexico_City');
// Obtenemos la hora actual en formato 24 horas para la hora de cierre
$hora_fin = date("H:i:s");

$id = $_POST['id'];
$comentario = $_POST['comentario'];

// Primero obtenemos la hora_inicio del ticket
$sql_inicio = "SELECT hora_inicio FROM tickets WHERE id = '$id'";
$resultado = $conexion->query($sql_inicio);
$row = $resultado->fetch_assoc();
$hora_inicio = $row['hora_inicio'];

// Convertimos las horas a objetos DateTime para poder calcular la diferencia
$inicio = new DateTime($hora_inicio);
$fin = new DateTime($hora_fin);
$intervalo = $inicio->diff($fin);

// Formateamos el tiempo de respuesta en horas:minutos:segundos
$tiempo_respuesta = $intervalo->format('%H:%I:%S');

// Actualizamos el ticket con la hora de fin y el tiempo de respuesta
$sql = "UPDATE tickets SET 
        estado = 'cerrado',
        comentario_cierre = '$comentario',
        hora_fin = '$hora_fin',
        tiempo_respuesta = '$tiempo_respuesta' 
        WHERE id = '$id'";

if($conexion->query($sql)){
    // En lugar de usar una alerta y redireccionar inmediatamente, 
    // mostramos una ventana modal y dejamos que el usuario haga clic en el botón para continuar
    
    // Cerramos la conexión a la base de datos
    mysqli_close($conexion);
    
    // Mostramos la página con la ventana modal
    ?>
    <!doctype html>
    <html>
    <head>
        <meta charset="gb18030">
        <title>CIERRE DE TICKET / CTI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../assets/images/logam.png">
        <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <!-- Plugins Stylesheets -->
        <link rel="stylesheet" href="../assets/css/loader/loaders.css">
        <link rel="stylesheet" href="../assets/css/font-awesome/font-awesome.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/aos/aos.css">
        <link rel="stylesheet" href="../assets/css/swiper/swiper.css">
        <link rel="stylesheet" href="../assets/css/lightgallery.min.css">
        <!-- Template Stylesheet -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- Responsive Stylesheet -->
        <link rel="stylesheet" href="../assets/css/responsive.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
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

        <div class="modal fade" id="mostrarmodal" tabindex="1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width:90%;background-color:#A22547;">
                    <div class="modal-header">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <img src="http://www.gamadero.cdmx.gob.mx/public/src/images/Logo GAM horizontal blanco.png" style="width:100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align: center;">
                                    <h2 style="color: #000000;">SE HA CERRADO EL TICKET #<?php echo $id; ?> EXITOSAMENTE</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-body">
                        <h3 style="color: #ffffff; text-align: center;">Tiempo de resolución: <span style="color:greenyellow;"><?php echo $tiempo_respuesta; ?></span></h3>
                        <br><br>
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <a href="tickets_sistemas.php" class="btn btn-success">
                                    <h3 style="margin-top:10px !important;">Aceptar</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
else{
    echo "<script>alert('NO SE PUDO CERRAR EL TICKET')</script>";
    header("Refresh:0 , url = index.php");
    exit();
}
?>