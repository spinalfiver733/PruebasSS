<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>

    
    
    <script>setTimeout(&#39;document.location.reload()&#39;,60000); </script>
    
    
    
<head><meta charset="gb18030">

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>CTI / MESA DE SERVICIO AGAM</title>

<link rel="stylesheet" type="text/css" href="../public/css/bootstrap/bootstrap.min.css"/>
 
<script src="../public/js/demo-rtl.js"></script>
 
 
    <link rel="stylesheet" type="text/css" href="../public/css/libs/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/libs/nanoscroller.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/compiled/theme_styles.css"/>
    <link rel="stylesheet" href="../public/css/libs/daterangepicker.css" type="text/css"/>
    <link type="image/x-icon" href="img/gam.png" rel="shortcut icon"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

<!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
  <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
  
    
    <style>
        a{
            color:gray;
        }
        a:hover{
            color:black;
        }
    </style>
</head>
<body style=" background-image: url('http://www.gamadero.cdmx.gob.mx/public/src/images/fondox.png');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">
    
    

    
<div id="theme-wrapper">
    
    
<header class="navbar" id="header-navbar" style=" background-image: url('http://www.gamadero.cdmx.gob.mx/public/src/images/fondox.png');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">

  <div class="row">
      <div class="col-md-5">
        <h3 style="text-align:center;color:white;background-color:#9F2241;font-family:IMPACT;font-size:2em;"><srtong>MESA DE SERVICIO</srtong></h3>    
    </div>
      <div class="col-md-7">
         <img src="img/JAN.png" width="30%">         <img src="img/cti.png" width="30%">

    </div>    
  </div>

    
<div class="container" style="text-align:center;color:white;background-color:#BC955C;">    


<div class="clearfix" style="text-align:center;color:white;background-color:#BC955C;">
<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
<ul class="nav navbar-nav pull-left">
<li>
<a class="btn" id="make-small-nav"><i class="fa fa-bars"></i></a>
</li>
</ul>
</div>

<div class="nav-no-collapse pull-right" id="header-nav">
<ul class="nav navbar-nav pull-left">
<li class="dropdown profile-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" alt=""/>
<span class="hidden-xs"><h1 style="color:white;"><?php echo $_SESSION['nombre']; ?></h1></span> <b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a href="../vistas/pass.php?sesion=<?php echo $_SESSION['nombre']; ?>"><i class="fa fa-user"></i>Cambiar contraseña</a></li>
<li><a href="../vistas/salida_usuario.php?sesion=<?php echo $_SESSION['nombre']; ?>"><i class="fa fa-power-off"></i>Salir</a></li>
</ul>
</li>
</ul>
</div>
</div>
    </div>
    
    
    
    
    
<script language="JavaScript">
function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    horaImprimible = hora + " : " + minuto + " : " + segundo

    document.form_reloj.reloj.value = horaImprimible

    setTimeout("mueveReloj()",1000)
}
</script>
    
    
    
</header>

<div  id="page-wrapper" class="container" style=" background-image: url('http://www.gamadero.cdmx.gob.mx/public/src/images/fondox.png');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;opacity: .9;">

<div id="nav-col" style="color:white;">

<section id="col-left" class="col-left-nano" style="background-color:#9F2241;color:white;">
<div id="col-left-inner" class="col-left-nano-content" style="color:white;">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown" style="color:white;">
<img alt="" src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>"/>
<div class="user-box" style="color:white;">
<span class="name"><?php echo $_SESSION['nombre']; ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu" style="color:white;">
<li><a href="#"><i class="fa fa-user"></i>Perfil</a></li>
<li><a href="../vistas/salida_usuario.php?sesion=<?php echo $_SESSION['nombre']; ?>"><i class="fa fa-power-off"></i>Salir</a></li>
</ul>
</span>
<span class="status">
<i class="fa fa-circle"></i> En Linea
</span>
</div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav" style="color:white;">
<ul class="nav nav-pills nav-stacked" style="color:white;">
       
       <?php 
            if ($_SESSION['escritorio']==1)
            {
              echo '<li>
        <a href="concepto.php" style="color:white;">
        <i class="fa fa-dashboard"></i>
        <span>ESCRITORIO</span>
        </a>
        </li>';
            }
            ?>
        

         <?php 
            if ($_SESSION['mesa']==1)
            {
              echo '<li>
                <a href="ticket_new.php" style="color:white;">
                <i class="fa fa-ticket"></i>
                <span>GENERAR TICKET</span>
                </a>
                </li>';
            }
            ?>
    
    
    
             <?php 
            if ($_SESSION['mesa']==1)
            {
              echo '<li>
                <a href="lista_tickets.php" style="color:white;">
                <i class="fa fa-search"></i>
                <span>FILTROS</span>
                </a>
                </li>';
            }
            ?>
    
    

    
         <?php 
            if ($_SESSION['t_sistemas']==1)
            {
              echo '<li>
                <a href="t_sistemas.php" style="color:white;">
                <i class="fa fa-ticket"></i>
                <span>TICKETS</span>
                </a>
                </li>';
            }
            ?>    
    
         <?php 
            if ($_SESSION['t_soporte']==1)
            {
              echo '<li>
                <a href="t_soporte.php" style="color:white;">
                <i class="fa fa-ticket"></i>
                <span>TICKETS</span>
                </a>
                </li>';
            }
            ?>     
    
         <?php 
            if ($_SESSION['mesa']==1)
            {
              echo '<li>
                <a href="tickets.php" style="color:white;">
                <i class="fa fa-list"></i>
                <span>TICKETS</span>
                </a>
                </li>';
            }
            ?>    
        
    
    
        <?php 
            if ($_SESSION['soporte']==1)
            {
              echo '<li>
                <a href="tickets_soporte.php" style="color:white;">
                <i class="fa fa-bar-chart-o"></i>
                <span>TICKETS SOPORTE</span>

                </a>
                </li>';
            }
            ?>    

            <?php 
            if ($_SESSION['sistemas']==1)
            {
              echo '<li>
                <a href="tickets_sistemas.php" style="color:white;">
                <i class="fa fa-bar-chart-o"></i>
                <span>TICKETS SISTEMAS</span>

                </a>
                </li>';
            }
            ?> 
    
                <?php 
            if ($_SESSION['usuarios']==1)
            {
              echo '<li>
                <a href="usuarios.php" style="color:white;">
                <i class="fa fa-user"></i>
                <span>USUARIOS</span>
                </a>
                </li>';
            }
            ?>
            
           


</ul>
</div>
    
</div>
</section>
    
    
    
    


    
</div>
<!-- Inicio Wrapper -->
<div id="content-wrapper">

<div class="row">
<div class="col-lg-12">
<!-- Fin header PHP -->
    
    
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
