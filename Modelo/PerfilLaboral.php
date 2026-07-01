<?php

require_once "../config/Conexion.php";

class PerfilLaboral
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function guardar(
        $colaborador,
        $ocupacion,
        $planilla,
        $salario,
        $fechaInicio,
        $fechaFin,
        $cargoActivo,
        $empleadoActivo,
        $motivo,
        $firma
    )
    {
        $sql = "INSERT INTO perfiles_laborales
        (
            colaborador_id,
            ocupacion_id,
            planilla_id,
            salario,
            fecha_inicio,
            fecha_fin,
            cargo_activo,
            empleado_activo,
            motivo_baja_id,
            firma
        )
        VALUES
        (?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conexion->prepare($sql);

        if(!$stmt)
        {
            die("Error en prepare perfil laboral: " . $this->conexion->error);
        }

        $stmt->bind_param(
            "iiidssiiss",
            $colaborador,
            $ocupacion,
            $planilla,
            $salario,
            $fechaInicio,
            $fechaFin,
            $cargoActivo,
            $empleadoActivo,
            $motivo,
            $firma
        );

        if(!$stmt->execute())
        {
            die("Error al guardar perfil laboral: " . $stmt->error);
        }

        return true;
    }
}

?>