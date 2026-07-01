<?php

require_once "../config/Conexion.php";

class MotivoTerminacion
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT C_TERMINACION, MOTIVO 
                FROM cat_motivos_terminacion 
                ORDER BY MOTIVO";

        return $this->conexion->query($sql);
    }
}

?>