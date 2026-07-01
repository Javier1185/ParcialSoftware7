<?php

require_once "../config/Conexion.php";

class Colaborador
{
    private $conexion;

    private $identidad;
    private $nombre;
    private $apellido;
    private $edad;
    private $tipoSangre;
    private $sexo;
    private $nacionalidad;
    private $ruta;
    private $correo;
    private $celular;

    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }

    public function setIdentidad($valor){ $this->identidad = $valor; }
    public function setNombre($valor){ $this->nombre = $valor; }
    public function setApellido($valor){ $this->apellido = $valor; }
    public function setEdad($valor){ $this->edad = $valor; }
    public function setTipoSangre($valor){ $this->tipoSangre = $valor; }
    public function setSexo($valor){ $this->sexo = $valor; }
    public function setNacionalidad($valor){ $this->nacionalidad = $valor; }
    public function setRuta($valor){ $this->ruta = $valor; }
    public function setCorreo($valor){ $this->correo = $valor; }
    public function setCelular($valor){ $this->celular = $valor; }

    public function guardar()
    {
        $sql = "INSERT INTO colaboradores
        (
            identidad,
            nombre,
            apellido,
            edad,
            tipo_sangre_id,
            sexo,
            nacionalidad,
            ruta_id,
            correo,
            celular
        )
        VALUES
        (?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conexion->prepare($sql);

        if (!$stmt)
        {
            die("Error en prepare colaboradores: " . $this->conexion->error);
        }

        $stmt->bind_param(
            "sssisssiss",
            $this->identidad,
            $this->nombre,
            $this->apellido,
            $this->edad,
            $this->tipoSangre,
            $this->sexo,
            $this->nacionalidad,
            $this->ruta,
            $this->correo,
            $this->celular
        );

        if (!$stmt->execute())
        {
            die("Error al guardar colaborador: " . $stmt->error);
        }

        return $this->conexion->insert_id;
    }
}

?>