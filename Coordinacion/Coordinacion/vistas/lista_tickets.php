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






<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/script.js"></script>
</head>





    <div class="container">
        <div class="table-wrapper">





			<div class="table-filter">
				<div class="row">
                    
                    <div class="col-sm-9">
						<button type="button" class="btn btn-primary"><i class="fa fa-search" onclick="load(1);"></i></button>
						<div class="filter-group">
							<label style="color:black;"><strong>Nombre</strong></label>
							<input type="text" class="form-control" id="name">
						</div>
						<div class="filter-group">
							<label>Ubicación</label>
							<select class="form-control" id="location" onchange="load(1);"> 
								<option value="">Todos</option>
								<option value="SISTEMAS">SISTEMAS</option>
								<option value="SOPORTE">SOPORTE</option>					
							</select>
						</div>
						<div class="filter-group">
							<label>Estado</label>
							<select class="form-control" id="status" onchange="load(1);">
								<option value="">Todos</option>
								<option value="cerrado">Cerrado</option>
								<option value="sin asignar">Sin asignar</option>
								<option value="asignado">Asignado</option>
								<option value="pendiente">Pendiente</option>
							</select>
						</div>
						<span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>

                    <div class="col-sm-3 text-right">
						<div class="show-entries">
							<span>Mostrar</span>
							<select class="form-control" id="per_page" onchange="load(1);">
								<option>5</option>
								<option>10</option>
								<option selected="">15</option>
								<option>20</option>
							</select>
							
						</div>
					</div>


                </div>
			</div>



		<div class="datos_ajax">

		</div>	


            
			
        </div>
    </div>     


    <?php
}
else
{
 require 'noacceso.php';
}
}
require 'footer.php';
?>
