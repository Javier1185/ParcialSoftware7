<?php

class Conexion
{
    private static string $host = "localhost";
    private static string $usuario = "root";
    private static string $password = "";
    private static string $baseDatos = "itech_contrataciones";
    private static string $puerto = "3306";

    // Instancia única de la conexión
    private static ?mysqli $instancia = null;

    // Evita crear objetos desde fuera
    private function __construct()
    {
    }

    // Evita clonar el objeto
    private function __clone()
    {
    }

    public static function obtenerConexion(): mysqli
    {
        if (self::$instancia === null) {
            self::$instancia = new mysqli(
                self::$host,
                self::$usuario,
                self::$password,
                self::$baseDatos,
                (int) self::$puerto
            );

            if (self::$instancia->connect_error) {
                die("Error de conexión: " . self::$instancia->connect_error);
            }

            self::$instancia->set_charset("utf8");
        }

        return self::$instancia;
    }
}