<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con Scroll</title>
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.scroll {
            width: 100%;
            border-spacing: 0;
            border: 2px solid black;
        }

        table.scroll thead,
        table.scroll tbody {
            display: block;
        }

        table.scroll tbody {
            height: 150px; /* Ajusta la altura del scroll */
            overflow-y: auto;
            overflow-x: hidden;
        }

        table.scroll thead th,
        table.scroll tbody td {
            width: 140px;
            border: 1px solid black;
            text-align: center;
        }

        table.scroll thead th {
            background-color: blue;
            color: white;
            font-size: 1.5em;
            height: 40px;
            line-height: 40px;
        }

        table.scroll thead th:last-child {
            width: 156px;
        }

        tbody tr td {
            color: black;
            font-weight: bold;
        }

        /* Estilos para el estado */
        .estado-sin-asignar {
            background-color: red;
            color: white;
            border-radius: 50%;
            text-align: center;
        }

        .estado-asignado {
            background-color: cyan;
            text-align: center;
        }

        .estado-cerrado {
            background-color: green;
            color: white;
            text-align: center;
        }

        .estado-pendiente {
            background-color: orange;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="table-responsive">
    <table class="scroll">
        <thead>
            <tr>
                <th>id</th>
                <th>fecha</th>
                <th>hora</th>
                <th>tipo</th>
                <th>problema</th>
                <th>área que solicita</th>
                <th>prioridad</th>
                <th>responsable</th>
                <th>estado</th>
                <th>comentarios de cierre</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2025-02-25</td>
                <td>10:30 AM</td>
                <td>Soporte Técnico</td>
                <td>Error en sistema</td>
                <td>TI</td>
                <td>Alta</td>
                <td>Juan Pérez</td>
                <td class="estado-pendiente">PENDIENTE</td>
                <td>En espera de revisión</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2025-02-24</td>
                <td>3:15 PM</td>
                <td>Mantenimiento</td>
                <td>Falla en aire acondicionado</td>
                <td>Instalaciones</td>
                <td>Media</td>
                <td>María López</td>
                <td class="estado-cerrado">CERRADO</td>
                <td>Reparado con éxito</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
