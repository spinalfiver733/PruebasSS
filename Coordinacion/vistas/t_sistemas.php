<meta http-equiv="refresh" content="60" />
<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
	header("Location: login.html");
} else {
	require 'header.php';

	if ($_SESSION['t_sistemas'] == 1) {
		require_once "../config/Conexion.php";
		date_default_timezone_set('America/Mexico_City');
		$fecha_actual = date("d-m-Y");
		$hora_actual = date("h:i:s");

		$nombre_sesion = $_SESSION["nombre"];
?>
		<!-- Integrando DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

		<style>
			:root {
				--color-primary: #9F2241;
				--color-secondary: #BC955C;
				--color-bg: #f4f2f0;
			}

			body {
				background-color: var(--color-bg);
			}

			/* Título del contenido */
			.content-title {
				color: var(--color-primary);
				text-align: center;
				font-weight: bold;
				margin: 15px 0;
				font-size: 20px;
			}

			/* DataTables personalizado para parecerse a la imagen */
			#tickets-table th {
				background-color: var(--color-primary);
				color: white;
				font-weight: bold;
				text-align: center;
				border: 1px solid #ddd;
				vertical-align: middle;
			}

			#tickets-table td {
				border: 1px solid #ddd;
				padding: 8px;
				vertical-align: middle;
			}

			#tickets-table tr:nth-child(odd) {
				background-color: rgba(255, 255, 255, 0.9);
			}

			#tickets-table tr:nth-child(even) {
				background-color: rgba(0, 0, 0, 0.03);
			}

			.status-sin-asignar {
				background-color: rgba(114, 28, 37, 0.62);
				color: white !important;
				font-weight: bold;
				text-align: center;
			}

			.status-asignado {
				background-color: rgba(12, 83, 96, 0.67);
				color: white;
				font-weight: bold;
				text-align: center;
			}

			.status-cerrado {
				background-color: rgba(21, 87, 36, 0.61);
				color: white;
				font-weight: bold;
				text-align: center;
			}

			.status-pendiente {
				background-color: rgba(236, 188, 27, 0.85);
				color: black;
				font-weight: bold;
				text-align: center;
			}

			/* Botón Imprimir */
			.btn-imprimir {
				background-color: var(--color-primary);
				color: white;
				border: none;
				padding: 6px 15px;
				border-radius: 4px;
				display: block;
				width: 100%;
				text-align: center;
				text-decoration: none;
				margin-bottom: 2px;
			}

			.btn-imprimir:hover {
				background-color: var(--color-secondary);
				color: white;
				text-decoration: none;
			}

			/* Personalización de DataTables */
			.dataTables_wrapper .dataTables_length,
			.dataTables_wrapper .dataTables_filter {
				margin-bottom: 15px;
			}

			.dataTables_wrapper .dataTables_length select {
				padding: 4px;
				border: 1px solid #ddd;
				border-radius: 4px;
			}

			.dataTables_wrapper .dataTables_filter input {
				padding: 6px;
				border: 1px solid #ddd;
				border-radius: 4px;
			}

			.dataTables_wrapper .dataTables_paginate .paginate_button.current {
				background: var(--color-primary) !important;
				color: white !important;
				border-color: var(--color-primary) !important;
			}

			.dataTables_info {
				padding: 10px 0;
			}

			/* Footer personalizado */
			.footer-custom {
				text-align: center;
				margin-top: 20px;
			}

			.footer-custom img {
				max-width: 200px;
				height: auto;
			}
		</style>

		<!-- Inicio Contenido PHP-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h3 class="content-title">Tickets que te fueron asignados</h3>

					<?php
					$sql_fetch_todos = "SELECT * FROM tickets WHERE tipo = 'SISTEMAS' AND responsable = '$nombre_sesion' ORDER BY id DESC";
					$query = mysqli_query($conexion, $sql_fetch_todos);
					?>

					<table id="tickets-table" class="display responsive nowrap" style="width:100%">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Estado</th>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Tipo</th>
								<th>Problema</th>
								<th>Área</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($query)) {
								// Determinar la clase del estado
								$estado_class = '';
								$estado_texto = '';

								switch ($row['estado']) {
									case 'sin asignar':
										$estado_class = 'status-sin-asignar';
										$estado_texto = 'SIN ASIGNAR';
										break;
									case 'asignado':
										$estado_class = 'status-asignado';
										$estado_texto = 'ASIGNADO';
										break;
									case 'cerrado':
										$estado_class = 'status-cerrado';
										$estado_texto = 'CERRADO';
										break;
									case 'pendiente':
										$estado_class = 'status-pendiente';
										$estado_texto = 'PENDIENTE';
										break;
									default:
										$estado_class = '';
										$estado_texto = $row['estado'];
								}
							?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td class="<?php echo $estado_class; ?>"><?php echo $estado_texto; ?></td>
									<td><?php echo $row['fecha']; ?></td>
									<td><?php echo $row['hora']; ?></td>
									<td><?php echo $row['tipo']; ?></td>
									<td><?php echo $row['problema']; ?></td>
									<td><?php echo $row['area_solicitante']; ?></td>
									<td>
										<a href="imprimir.php?id=<?php echo $row['id']; ?>" class="btn-imprimir">
											<i class="fa fa-print"></i> Imprimir
										</a>
										<a href="cerrar_ticket.php?id=<?php echo $row['id']; ?>" class="btn-imprimir">
											<i class="fa fa-check-circle"></i> Cerrar
										</a>
										<a href="pendiente_ticket.php?id=<?php echo $row['id']; ?>" class="btn-imprimir">
											<i class="fa fa-clock"></i> Pendiente
										</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Logo CTI en el pie de página -->
			<div class="footer-custom">
				<img src="../files/img/cti_logo.png" alt="Logo CTI">
			</div>
		</div>
		<!-- Fin Contenido PHP-->

		<!-- jQuery y DataTables JS -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

		<!-- Inicialización de DataTables -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tickets-table').DataTable({
					"language": {
						"sProcessing": "Procesando...",
						"sLengthMenu": "Mostrar _MENU_ registros",
						"sZeroRecords": "No se encontraron resultados",
						"sEmptyTable": "Ningún dato disponible en esta tabla",
						"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix": "",
						"sSearch": "Buscar:",
						"sUrl": "",
						"sInfoThousands": ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst": "Primero",
							"sLast": "Último",
							"sNext": "Siguiente",
							"sPrevious": "Anterior"
						}
					},
					"pageLength": 10,
					"order": [
						[0, "desc"]
					],
					"columnDefs": [{
						"targets": [7],
						"orderable": false
					}]
				});
			});
		</script>

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