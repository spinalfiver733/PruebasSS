<meta http-equiv="refresh" content="60" />


<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");
} else {
    require 'header.php';

    if ($_SESSION['cti'] == 1) {
        require_once "../config/Conexion.php";
        date_default_timezone_set('America/Mazatlan');
        $fecha_actual = date("d-m-Y");
        $hora_actual = date("h:i:s");

?>

<style>
			/* Variables de colores */
			:root {
				--color-primary: #9F2241;
				/* Color vino institucional */
				--color-secondary: #BC955C;
				/* Color dorado */
				--color-gray: #98989A;
				/* Color gris */
				--color-bg: #f4f2f0;
				/* Color de fondo */
			}

			/* Estilos para la tarjeta principal */
			.main-card {
				background-color: white;
				border-radius: 8px;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
				margin-bottom: 30px;
				padding: 20px;
			}

			.card-header {
				border-bottom: 2px solid var(--color-primary);
				margin-bottom: 20px;
				padding-bottom: 15px;
			}

			.main-title {
				font-family: 'Arial', sans-serif;
				color: #9F2241 !important;
				text-align: center;
				font-weight: bold;
				font-size: 24px;
				margin-bottom: 15px;
				background-color: #f8f9fa;
				padding: 10px;
				border-radius: 5px;
			}

			/* Estilos para los estados */
			.status-sin-asignar {
				background-color: rgba(114, 28, 37, 0.62);
				color: white !important;
				padding: 3px 10px;
				border-radius: 4px;
				font-weight: 500;
				text-align: center;
				display: block;
			}

			.status-asignado {
				background-color: rgba(12, 83, 96, 0.67);
				color: white;
				padding: 3px 10px;
				border-radius: 4px;
				font-weight: 500;
				text-align: center;
				display: block;
			}

			.status-cerrado {
				background-color: rgba(21, 87, 36, 0.61);
				color: white;
				padding: 3px 10px;
				border-radius: 4px;
				font-weight: 500;
				text-align: center;
				display: block;
			}

			.status-pendiente {
				background-color: rgba(236, 188, 27, 0.85);
				color: black;
				padding: 3px 10px;
				border-radius: 4px;
				font-weight: 500;
				text-align: center;
				display: block;
			}

			/* Botón de impresión */
			.btn-imprimir {
				background-color: var(--color-primary);
				color: white;
				border: none;
				border-radius: 4px;
				padding: 5px 10px;
				transition: all 0.3s ease;
				width: 100%;
				text-align: center;
				display: inline-block;
			}

			.btn-imprimir:hover {
				background-color: var(--color-secondary);
				color: white;
				text-decoration: none;
			}

			/* Ajustes para DataTables */
			.dataTables_wrapper .dataTables_length,
			.dataTables_wrapper .dataTables_filter {
				margin-bottom: 15px;
			}

			.dataTables_wrapper .dataTables_info,
			.dataTables_wrapper .dataTables_paginate {
				margin-top: 15px;
			}

			.dataTables_wrapper .dataTables_paginate .paginate_button.current {
				background: var(--color-primary) !important;
				color: white !important;
				border-color: var(--color-primary) !important;
			}

			.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
				background: var(--color-secondary) !important;
				color: white !important;
				border-color: var(--color-secondary) !important;
			}

			table.dataTable thead th {
				background-color: #9F2241;
				color: white;
				border-bottom: 2px solid var(--color-secondary);
			}

			table.dataTable tbody tr:nth-child(even) {
				background-color: #f8f9fa;
			}

			table.dataTable tbody tr:hover {
				background-color: #f2f2f2;
			}

			#tickets-historial td:nth-child(7) {
				max-width: 250px;
				/* Ancho máximo para la columna */
				white-space: normal;
				/* Permitir saltos de línea */
				word-wrap: break-word;
				/* Romper palabras largas */
				overflow-wrap: break-word;
				/* Alternativa a word-wrap para mejor compatibilidad */
			}

			/* Sobrescribir configuración de DataTables */
			table.dataTable td {
				white-space: normal !important;
			}
		</style>
        <!-- Inicio Contenido PHP-->
        <div class="col-lg-12" style="background-color:#7D2735;">
            <div class="main-box clearfix" style="background-color:#98989A;color:white;">

                <div class="row">
                    <div class="main-box-body clearfix">
                        <div class="col-sm-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <br>
                                    <h1 style="text-align:center;font-family:impact;color:#9F2241;background-color:white;border-radius:20px;">Tickets generados para la JUD de Desarrollo de Sistemas</h1>
                                    <!--usuarios conectados-->
                                    <?php
                                    $sql_fetch_todos = "SELECT * FROM tickets WHERE TIPO = 'CTI' GROUP BY id DESC";
                                    $query = mysqli_query($conexion, $sql_fetch_todos);
                                    ?>

                                    <div class="table-responsive">

                                        <table border="1" class="table table-striped">
                                            <thead>
                                                <tr style="color:white;background-color:blue;">
                                                    <td>folio</td>
                                                    <td>fecha</td>
                                                    <td>hora</td>
                                                    <td>tipo</td>
                                                    <td>problema</td>
                                                    <td>observaciones</td>
                                                    <td>area que solicita</td>
                                                    <td>prioridad</td>
                                                    <td>responsable</td>
                                                    <td>estado</td>
                                                    <td>comentarios del cierre</td>
                                                    <td>IMPRIMIR</td>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                while ($row = mysqli_fetch_array($query)) { ?>
                                                    <tr>
                                                        <td style="color:black;"><?php echo $row['id'] ?></td>
                                                        <td style="color:black;"><?php echo $row['fecha'] ?></td>
                                                        <td style="color:black;"><?php echo $row['hora'] ?></td>
                                                        <td style="color:black;"><?php echo $row['tipo'] ?></td>
                                                        <td style="color:black;"><?php echo $row['problema'] ?></td>
                                                        <td style="color:black;"><?php echo $row['observaciones'] ?></td>
                                                        <td style="color:black;"><?php echo $row['area_solicitante'] ?></td>
                                                        <td style="color:black;"><?php echo $row['prioridad'] ?></td>
                                                        <td style="color:black;"><?php echo $row['responsable'] ?></td>

                                                        <?php
                                                        if ($row['estado'] == 'sin asignar') {
                                                        ?>
                                                            <td style="background-color:red;border-radius:50%;">
                                                                <a href="asignar_ticket_cti.php?id=<?php echo $row['id']; ?>" style="color:white;text-align:center;">SIN ASIGNAR</a>
                                                            </td>
                                                        <?php
                                                        } else if ($row['estado'] == 'asignado') {                                ?>
                                                            <td style="background-color:cyan;border-radius:50%;"> <a style="color:black;text-align:center;">ASIGNADO</a></td>
                                                        <?php
                                                        } else if ($row['estado'] == 'cerrado') {                                ?>
                                                            <td style="background-color:green;border-radius:50%;"> <a style="color:white;text-align:center;">CERRADO</a></td>
                                                        <?php
                                                        } else if ($row['estado'] == 'pendiente') {                                ?>
                                                            <td style="background-color:orange;border-radius:50%;"> <a style="color:white;text-align:center;">PENDIENTE</a></td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <td style="color:black;"><?php echo $row['comentario_cierre'] ?></td>



                                                        <td style="color:black;">
                                                            <a href="imprimir.php?id=<?php echo $row['id']; ?>"><button style="width:100%;height:50px;">
                                                                    <li class="fa fa-print"> IMRPIMIR TICKET</li>
                                                                </button>
                                                            </a>

                                                        </td>



                                                    </tr>
                                                <?php
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--usuarios conectados-->




                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="main-box-body clearfix">
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin Contenido PHP-->
    <?php
    } else {
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
    document.oncontextmenu = function() {
        return false
    }
</script>


<script type='text/javascript'>
    $(function() {
        $(document).bind("contextmenu", function(e) {
            return false;
        });
    });
</script>