<?php

require_once "../config/Conexion.php";

$db = new Conexion();
$conexion = $db->conectar();

$sql = "
SELECT
    c.id_colaborador,
    c.identidad,
    c.nombre,
    c.apellido,
    c.edad,
    ts.Nombre AS tipo_sangre,
    c.sexo,
    c.nacionalidad,
    r.Nombre AS ruta,
    c.correo,
    c.celular,
    o.C_OCUP AS ocupacion_id,
    o.OCUPACION AS ocupacion,
    te.id AS planilla_id,
    te.Nombre AS planilla,
    p.salario,
    p.fecha_inicio,
    p.fecha_fin,
    p.cargo_activo,
    p.empleado_activo,
    mt.MOTIVO AS motivo_baja,
    p.firma
FROM colaboradores c
INNER JOIN cat_tiposangre ts ON c.tipo_sangre_id = ts.id
INNER JOIN cat_rutas r ON c.ruta_id = r.id
INNER JOIN perfiles_laborales p ON c.id_colaborador = p.colaborador_id
INNER JOIN cat_ocupaciones o ON p.ocupacion_id = o.C_OCUP
INNER JOIN cat_tipoempleado te ON p.planilla_id = te.id
LEFT JOIN cat_motivos_terminacion mt ON p.motivo_baja_id = mt.C_TERMINACION
ORDER BY c.id_colaborador DESC
";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Colaboradores</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>

<body>

<h1>Reporte de Colaboradores</h1>

<p>
    <a href="../exports/excel.php">Exportar a Excel</a>
</p>

<table>
    <tr>
        <th>ID</th>
        <th>Identidad</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Edad</th>
        <th>Sangre</th>
        <th>Sexo</th>
        <th>Nacionalidad</th>
        <th>Ruta</th>
        <th>Correo</th>
        <th>Celular</th>
        <th>Ocupación</th>
        <th>Planilla</th>
        <th>Salario</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Cargo Activo</th>
        <th>Empleado Activo</th>
        <th>Motivo Baja</th>
        <th>Integridad</th>
    </tr>

    <?php while($fila = $resultado->fetch_assoc()){ ?>

        <?php

        $cadena =
            $fila["salario"] .
            $fila["id_colaborador"] .
            $fila["planilla_id"] .
            $fila["ocupacion_id"] .
            $fila["fecha_inicio"];

        $firmaNueva = openssl_digest($cadena, "sha256");

        if($firmaNueva == $fila["firma"])
        {
            $integridad = "<span style='color:green;font-weight:bold;'>Verde - Válido</span>";
        }
        else
        {
            $integridad = "<span style='color:red;font-weight:bold;'>Rojo - Alterado</span>";
        }

        ?>

        <tr>
            <td><?php echo $fila["id_colaborador"]; ?></td>
            <td><?php echo $fila["identidad"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["apellido"]; ?></td>
            <td><?php echo $fila["edad"]; ?></td>
            <td><?php echo $fila["tipo_sangre"]; ?></td>
            <td><?php echo $fila["sexo"]; ?></td>
            <td><?php echo $fila["nacionalidad"]; ?></td>
            <td><?php echo $fila["ruta"]; ?></td>
            <td><?php echo $fila["correo"]; ?></td>
            <td><?php echo $fila["celular"]; ?></td>
            <td><?php echo $fila["ocupacion"]; ?></td>
            <td><?php echo $fila["planilla"]; ?></td>
            <td><?php echo number_format($fila["salario"], 2); ?></td>
            <td><?php echo $fila["fecha_inicio"]; ?></td>
            <td><?php echo $fila["fecha_fin"]; ?></td>
            <td><?php echo ($fila["cargo_activo"] == 1) ? "Sí" : "No"; ?></td>
            <td><?php echo ($fila["empleado_activo"] == 1) ? "Sí" : "No"; ?></td>
            <td><?php echo $fila["motivo_baja"]; ?></td>
            <td><?php echo $integridad; ?></td>
        </tr>

    <?php } ?>

</table>

</body>
</html>