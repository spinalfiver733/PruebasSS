<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
	header("Location: login.html");
} else {
	require 'header.php';

	if ($_SESSION['soporte'] == 1) {
		require_once "../config/Conexion.php";
		date_default_timezone_set('America/Mazatlan');
		$fecha_actual = date("d-m-Y");
		$hora_actual = date("h:i:s");
?>

		<!-- Integrando DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="main-card">
						<div class="card-header">
							<h1 class="main-title">Tickets generados para la JUD de Soporte Técnico</h1>
						</div>

						<!--Tabla de tickets-->
						<?php
						$sql_fetch_todos = "SELECT * FROM tickets WHERE TIPO = 'SOPORTE' ORDER BY id DESC";
						$query = mysqli_query($conexion, $sql_fetch_todos);
						?>
						<div class="table-responsive">
							<table id="tickets-historial" class="display responsive nowrap" style="width:100%">
								<thead>
									<tr>
										<th>Folio</th>
										<th>Estado</th>
										<th>Fecha</th>
										<th>Fecha Cierre</th>
										<th>Tipo</th>
										<th>Problema</th>
										<th>Observaciones</th>
										<th>Área</th>
										<th>Prioridad</th>
										<th>Responsable</th>
										<th>Comentarios</th>
										<th>Tiempo</th>
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

										// Calcular fecha de cierre
										$fecha_cierre = !empty($row['hora_fin']) ? $row['fecha'] : '';
									?>
										<tr>
											<td><strong><?php echo $row['id'] ?></strong></td>
											<td>
												<?php if ($row['estado'] == 'sin asignar') { ?>
													<a href="asignar_ticket_soporte.php?id=<?php echo $row['id']; ?>" class="<?php echo $estado_class; ?>"><?php echo $estado_texto; ?></a>
												<?php } else { ?>
													<span class="<?php echo $estado_class; ?>"><?php echo $estado_texto; ?></span>
												<?php } ?>
											</td>
											<td><strong><?php echo $row['fecha'] ?></strong></td>
											<td><strong><?php echo $fecha_cierre ?></strong></td>
											<td><strong><?php echo $row['tipo'] ?></strong></td>
											<td><strong><?php echo $row['problema'] ?></strong></td>
											<td><strong><?php echo $row['observaciones'] ?></strong></td>
											<td><strong><?php echo $row['area_solicitante'] ?></strong></td>
											<td><strong><?php echo $row['prioridad'] ?></strong></td>
											<td><strong><?php echo $row['responsable'] ?></strong></td>
											<td><strong><?php echo $row['comentario_cierre'] ?></strong></td>
											<td><strong><?php echo $row['tiempo_respuesta'] ?></strong></td>
											<td>
												<a href="imprimir.php?id=<?php echo $row['id']; ?>" class="btn-imprimir">
													<i class="fa fa-print"></i> IMPRIMIR
												</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<!--fin tabla de tickets-->
					</div>
				</div>
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
				$('#tickets-historial').DataTable({
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
						},
						"oAria": {
							"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					},
					"pageLength": 10,
					"order": [
						[0, "desc"]
					], // Ordenar por la primera columna (folio) de forma descendente
					"responsive": true,
					"autoWidth": false,
					"dom": '<"top"lf>rt<"bottom"ip>', // Personaliza la ubicación de elementos
					"columnDefs": [{
							"responsivePriority": 1,
							"targets": [0, 1, 12]
						}, // Folio, Estado y Acciones siempre visibles
						{
							"responsivePriority": 2,
							"targets": [5, 8, 9]
						} // Problema, Prioridad y Responsable son la segunda prioridad
					]
				});

				// Función para exportar a Excel
				$('#exportar-excel').on('click', function() {
					window.location.href = 'exportar_historial_excel.php';
				});

				// Función para exportar a PDF
				$('#exportar-pdf').on('click', function() {
					window.location.href = 'exportar_historial_pdf.php';
				});
			});
		</script>

		<!-- Agregar botones de exportación -->
		<div class="container-fluid mt-3">
			<div class="row">
				<div class="col-12 text-center">
					<button id="exportar-excel" class="btn btn-success mr-2">
						<i class="fas fa-file-excel"></i> Exportar a Excel
					</button>
					<button id="exportar-pdf" class="btn btn-danger">
						<i class="fas fa-file-pdf"></i> Exportar a PDF
					</button>
				</div>
			</div>
		</div>

	<?php
	} else {
		require 'noacceso.php';
	}
	require 'footer.php';
	?>
	<script type="text/javascript" src="scripts/historial.js"></script>
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