<?php

require_once "../config/Conexion.php";

class TipoEmpleado
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT id, Nombre 
                FROM cat_tipoempleado 
                WHERE Activo = 1 
                ORDER BY Nombre";

        return $this->conexion->query($sql);
    }
}

?>