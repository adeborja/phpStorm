<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Request.php');

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

        $respuesta = false;

        if($str_array[0] == 'angel' && $str_array == 'asd')
        {
            $respuesta = true;
        }
        else


        return $respuesta;
    }

    /*public static function validarUsuario($user, $pass)
    {
        $valido = false;

        if($user == 'angel' && $pass == 'asd') $valido = true;

        return $valido;
    }*/

    public static function validarUsuario($req)
    {
        $valido = false;


        if($req->getUsuario() == 'angel' && $req->getContrasena() == 'asd') $valido = true;

        return $valido;
    }
}