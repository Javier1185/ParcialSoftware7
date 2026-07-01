<?php

class Sanitizador
{

    public static function limpiar($dato)
    {

        return htmlspecialchars(trim($dato));

    }

    public static function titulo($texto)
    {

        return ucwords(strtolower(trim($texto)));

    }

}
?>