<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 25/04/19
 * Time: 10:41
 */
class Autenticacion
{
    //Metodo que comprueba que un usuario exista en la base de datos y que su
    //contraseña sea correcta. Devuelve true si es correcta y false si no
    public static function comprobarUsuario($cadenaBase64)
    {
        //convertir la cadena de base64 a texto normal
        $cadena = base64_decode($cadenaBase64);

        //Separar usuario de contraseña
        $str_array = explode(":", $cadena);

        //Comprobar que usuario y contraseña sean correctos
        //TODO: revisar lo de almacenamiento de contraseñas para decidir el mejor modelo



        return true;
    }
}