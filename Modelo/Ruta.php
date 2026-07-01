<?php

require_once "../config/Conexion.php";

class Ruta
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT id, Nombre FROM cat_rutas ORDER BY Nombre";
        return $this->conexion->query($sql);
    }
}

?>