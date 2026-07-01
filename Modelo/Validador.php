<?php

class Validador
{

    public static function validarCorreo($correo)
    {

        return filter_var($correo,FILTER_VALIDATE_EMAIL);

    }

    public static function validarEdad($edad)
    {

        return ($edad>=18);

    }

    public static function validarTexto($texto)
    {

        return !empty(trim($texto));

    }

    public static function validarSalario($salario)
    {

        return is_numeric($salario);

    }

}
?>