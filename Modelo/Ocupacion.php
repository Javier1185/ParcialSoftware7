<?php

require_once "../config/Conexion.php";

class Ocupacion
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT C_OCUP, OCUPACION 
                FROM cat_ocupaciones 
                WHERE Activo = 1 
                ORDER BY OCUPACION";

        return $this->conexion->query($sql);
    }
}

?>