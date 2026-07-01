<?php

require_once "../Modelo/Ruta.php";
require_once "../Modelo/Ocupacion.php";
require_once "../Modelo/TipoEmpleado.php";
require_once "../Modelo/TipoSangre.php";
require_once "../Modelo/MotivoTerminacion.php";

$ruta = new Ruta();
$rutas = $ruta->listar();

$ocupacion = new Ocupacion();
$ocupaciones = $ocupacion->listar();

$tipoEmpleado = new TipoEmpleado();
$tiposEmpleado = $tipoEmpleado->listar();

$tipoSangre = new TipoSangre();
$tiposSangre = $tipoSangre->listar();

$motivoTerminacion = new MotivoTerminacion();
$motivos = $motivoTerminacion->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Colaboradores</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>

<body>

<h1>Formulario de Registro de Colaboradores</h1>

<form action="../Controlador/ColaboradorController.php" method="POST">

<h2>Datos del Colaborador</h2>

<label>Identidad</label>
<input type="text" name="identidad" required>

<label>Nombre</label>
<input type="text" name="nombre" required>

<label>Apellido</label>
<input type="text" name="apellido" required>

<label>Edad</label>
<input type="number" name="edad" required>

<label>Tipo de Sangre</label>
<select name="tipo_sangre_id" required>
    <option value="">Seleccione</option>

    <?php while($fila = $tiposSangre->fetch_assoc()){ ?>
        <option value="<?php echo $fila['id']; ?>">
            <?php echo $fila['Nombre']; ?>
        </option>
    <?php } ?>
</select>

<label>Sexo</label>
<select name="sexo" required>
    <option value="">Seleccione</option>
    <option value="Masculino">Masculino</option>
    <option value="Femenino">Femenino</option>
</select>

<label>Nacionalidad</label>
<input type="text" name="nacionalidad" required>

<label>Ruta</label>
<select name="ruta" required>
    <option value="">Seleccione</option>

    <?php while($fila = $rutas->fetch_assoc()){ ?>
        <option value="<?php echo $fila['id']; ?>">
            <?php echo $fila['Nombre']; ?>
        </option>
    <?php } ?>
</select>

<label>Correo</label>
<input type="email" name="correo" required>

<label>Celular</label>
<input type="text" name="celular" required>

<hr>

<h2>Perfil Laboral</h2>

<label>Puesto</label>
<select name="ocupacion" required>
    <option value="">Seleccione</option>

    <?php while($fila = $ocupaciones->fetch_assoc()){ ?>
        <option value="<?php echo $fila['C_OCUP']; ?>">
            <?php echo $fila['OCUPACION']; ?>
        </option>
    <?php } ?>
</select>

<label>Planilla</label>
<select name="planilla" required>
    <option value="">Seleccione</option>

    <?php while($fila = $tiposEmpleado->fetch_assoc()){ ?>
        <option value="<?php echo $fila['id']; ?>">
            <?php echo $fila['Nombre']; ?>
        </option>
    <?php } ?>
</select>

<label>Salario</label>
<input type="number" step="0.01" name="salario" required>

<label>Fecha Inicio</label>
<input type="date" name="fecha_inicio" required>

<label>Fecha Fin</label>
<input type="date" id="fecha_fin" name="fecha_fin">

<label>Cargo Activo</label>
<select name="cargo_activo">
    <option value="1">Sí</option>
    <option value="0">No</option>
</select>

<label>Empleado Activo</label>
<select name="empleado_activo">
    <option value="1">Sí</option>
    <option value="0">No</option>
</select>

<label>Motivo Baja</label>
<select id="motivo_baja" name="motivo_baja_id" disabled>
    <option value="">Seleccione</option>

    <?php while($fila = $motivos->fetch_assoc()){ ?>
        <option value="<?php echo $fila['C_TERMINACION']; ?>">
            <?php echo $fila['MOTIVO']; ?>
        </option>
    <?php } ?>
</select>

<br><br>

<input type="submit" value="Guardar">

</form>

<footer>
    <p>© <?php echo date("Y"); ?> iTECH Contrataciones. All rights reserved.</p>
    <p>Email: contrataciones@itech.com</p>
    <p>Teléfono: +507 6067-0480</p>
</footer>

<script>
const fechaFin = document.getElementById("fecha_fin");
const motivo = document.getElementById("motivo_baja");

fechaFin.addEventListener("change", function(){

    if(this.value !== "")
    {
        motivo.disabled = false;
        motivo.required = true;
    }
    else
    {
        motivo.disabled = true;
        motivo.required = false;
        motivo.value = "";
    }

});
</script>

</body>
</html>