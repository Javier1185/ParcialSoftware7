<?php

require_once "../config/Conexion.php";

$conexion = Conexion::obtenerConexion();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_colaboradores.xls");
header("Pragma: no-cache");
header("Expires: 0");

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
    o.OCUPACION AS ocupacion,
    te.Nombre AS planilla,
    p.salario,
    p.fecha_inicio,
    p.fecha_fin,
    p.cargo_activo,
    p.empleado_activo,
    mt.MOTIVO AS motivo_baja
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

echo "<table border='1'>";

echo "<tr>
        <th>ID</th>
        <th>Identidad</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Edad</th>
        <th>Tipo Sangre</th>
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
      </tr>";

while ($fila = $resultado->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$fila["id_colaborador"]."</td>";
    echo "<td>".$fila["identidad"]."</td>";
    echo "<td>".$fila["nombre"]."</td>";
    echo "<td>".$fila["apellido"]."</td>";
    echo "<td>".$fila["edad"]."</td>";
    echo "<td>".$fila["tipo_sangre"]."</td>";
    echo "<td>".$fila["sexo"]."</td>";
    echo "<td>".$fila["nacionalidad"]."</td>";
    echo "<td>".$fila["ruta"]."</td>";
    echo "<td>".$fila["correo"]."</td>";
    echo "<td>".$fila["celular"]."</td>";
    echo "<td>".$fila["ocupacion"]."</td>";
    echo "<td>".$fila["planilla"]."</td>";
    echo "<td>".$fila["salario"]."</td>";
    echo "<td>".$fila["fecha_inicio"]."</td>";
    echo "<td>".$fila["fecha_fin"]."</td>";
    echo "<td>".($fila["cargo_activo"] == 1 ? "Sí" : "No")."</td>";
    echo "<td>".($fila["empleado_activo"] == 1 ? "Sí" : "No")."</td>";
    echo "<td>".$fila["motivo_baja"]."</td>";
    echo "</tr>";
}

echo "</table>";

?>