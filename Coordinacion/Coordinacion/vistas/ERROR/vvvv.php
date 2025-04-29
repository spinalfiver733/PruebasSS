
<meta http-equiv="refresh" content="60" />
    <title>Tickets Generados</title>
    <style>
        .banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #7D2735;
            z-index: 1000;
            padding: 10px;
            text-align: center;
        }

        .banner h1 {
            font-family: impact;
            color: #9F2241;
            background-color: white;
            border-radius: 20px;
            padding: 10px;
            display: inline-block;
        }

        .contenido {
            margin-top: 80px; /* Ajusta según la altura del banner */
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: blue;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-responsive {
            max-height: 500px; /* Ajusta la altura según necesites */
            overflow-y: auto;
        }
    </style>
</head>
<body>
<?php
// Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");
} else {
    require 'header.php';

    if ($_SESSION['mesa'] == 1) {
        require_once "../config/Conexion.php";
        date_default_timezone_set('America/Mazatlan');
        $fecha_actual = date("d-m-Y");
        $hora_actual = date("h:i:s");
?>
        <!-- Banner fijo -->
        <div class="banner">
            <h1><strong>Tickets generados</strong></h1>
        </div>

        <div class="contenido">
            <div class="col-lg-12" style="background-color:#7D2735;">
                <div class="main-box clearfix" style="background-color:#98989A;color:white;">
                    <div class="row">
                        <div class="main-box-body clearfix">
                            <div class="col-sm-8">
                                <div class="small-box blue">
                                    <div class="inner">
                                        <?php  
                                            $sql_fetch_todos = "SELECT * FROM tickets ORDER BY id DESC";
                                            $query = mysqli_query($conexion, $sql_fetch_todos);
                                            $numero = mysqli_num_rows($query);
                                        ?>
                                        <div class="table-responsive">
                                            <table border="1" class="table table-striped">
                                                <thead>
                                                    <tr style="color:white;background-color:blue;">
                                                        <td style="color:white;font-size:1.5em;">ID</td>
                                                        <td style="color:white;font-size:1.5em;">Fecha</td>
                                                        <td style="color:white;font-size:1.5em;">Hora</td>
                                                        <td style="color:white;font-size:1.5em;">Tipo</td>
                                                        <td style="color:white;font-size:1.5em;">Problema</td>
                                                        <td style="color:white;font-size:1.5em;">Área que solicita</td>
                                                        <td style="color:white;font-size:1.5em;">Prioridad</td>
                                                        <td style="color:white;font-size:1.5em;">Responsable</td>
                                                        <td style="color:white;font-size:1.5em;">Estado</td>
                                                        <td style="color:white;font-size:1.5em;">Comentarios de cierre</td>
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
                                                            <td style="background-color:<?php echo ($row['estado'] == 'sin asignar') ? 'red' :
                                                                                        (($row['estado'] == 'asignado') ? 'cyan' :
                                                                                        (($row['estado'] == 'cerrado') ? 'green' : 'orange')); ?>;border-radius:50%;">
                                                                <a style="color:white;text-align:center;"><?php echo strtoupper($row['estado']); ?></a>
                                                            </td>
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
                            </div>

                            <!-- Usuarios conectados -->
                            <aside style="float:right;background-color:#9F2241;padding:10px;border-radius:10px;">
                                <h3 style="color:white;">Usuarios conectados</h3>
                                <?php  
                                    $sql_fetch_todos = "SELECT * FROM usuarios WHERE conectado = 1";
                                    $query = mysqli_query($conexion, $sql_fetch_todos);
                                ?>
                                <table border="1" class="table table-striped">
                                    <tbody>
                                        <?php
                                        $idpro = 1;
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <tr>
                                                <td style="color:black;"><?php echo $idpro ?></td>
                                                <td style="color:black;"><?php echo $row['nombre'] ?></td>
                                                <td><span class="status" style="color:black;">
                                                    <i class="fa fa-circle" style="color:green;"></i> En Línea
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php
                                            $idpro++;
                                        } ?>
                                    </tbody>
                                </table>
                            </aside>
                            <!-- Fin usuarios conectados -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';
}
ob_end_flush();
?>

<script type="text/javascript" src="scripts/clientes.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>  

<script type='text/javascript'>
    document.oncontextmenu = function(){ return false; }
</script>
