<?php

require_once "../Modelo/Colaborador.php";
require_once "../Modelo/PerfilLaboral.php";
require_once "../Modelo/Validador.php";
require_once "../Modelo/Sanitizador.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $identidad = Sanitizador::limpiar($_POST["identidad"]);
    $nombre = Sanitizador::titulo($_POST["nombre"]);
    $apellido = Sanitizador::titulo($_POST["apellido"]);
    $edad = Sanitizador::limpiar($_POST["edad"]);
    $tipoSangre = Sanitizador::limpiar($_POST["tipo_sangre_id"]);
    $sexo = Sanitizador::limpiar($_POST["sexo"]);
    $nacionalidad = Sanitizador::titulo($_POST["nacionalidad"]);
    $ruta = Sanitizador::limpiar($_POST["ruta"]);
    $correo = Sanitizador::limpiar($_POST["correo"]);
    $celular = Sanitizador::limpiar($_POST["celular"]);

    $ocupacion = Sanitizador::limpiar($_POST["ocupacion"]);
    $planilla = Sanitizador::limpiar($_POST["planilla"]);
    $salario = Sanitizador::limpiar($_POST["salario"]);
    $fechaInicio = Sanitizador::limpiar($_POST["fecha_inicio"]);
    $fechaFin = Sanitizador::limpiar($_POST["fecha_fin"]);
    $cargoActivo = Sanitizador::limpiar($_POST["cargo_activo"]);
    $empleadoActivo = Sanitizador::limpiar($_POST["empleado_activo"]);

    if(!empty($fechaFin))
    {
        $empleadoActivo = 0;
        $motivoBaja = Sanitizador::limpiar($_POST["motivo_baja_id"]);
    }
    else
    {
        $fechaFin = null;
        $motivoBaja = null;
    }

    if(!Validador::validarCorreo($correo))
    {
        die("Correo inválido");
    }

    if(!Validador::validarEdad($edad))
    {
        die("Edad inválida");
    }

    if(!Validador::validarSalario($salario))
    {
        die("Salario inválido");
    }

    $colaborador = new Colaborador();

    $colaborador->setIdentidad($identidad);
    $colaborador->setNombre($nombre);
    $colaborador->setApellido($apellido);
    $colaborador->setEdad($edad);
    $colaborador->setTipoSangre($tipoSangre);
    $colaborador->setSexo($sexo);
    $colaborador->setNacionalidad($nacionalidad);
    $colaborador->setRuta($ruta);
    $colaborador->setCorreo($correo);
    $colaborador->setCelular($celular);

    $idColaborador = $colaborador->guardar();

    $cadena =
        $salario .
        $idColaborador .
        $planilla .
        $ocupacion .
        $fechaInicio;

    $firma = openssl_digest($cadena, "sha256");

    $perfil = new PerfilLaboral();

    $perfil->guardar(
        $idColaborador,
        $ocupacion,
        $planilla,
        $salario,
        $fechaInicio,
        $fechaFin,
        $cargoActivo,
        $empleadoActivo,
        $motivoBaja,
        $firma
    );

    echo "Registro guardado correctamente.";
}

?>