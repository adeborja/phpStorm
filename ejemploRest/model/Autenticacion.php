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

    public static function validarUsuarioBasico($user, $pass)
    {
        $valido = false;

        if($user == 'angel' && $pass == 'asd') $valido = true;

        return $valido;
    }

    public static function validarUsuario($req)
    {
        $valido = false;


        //TODO: añadir inspeccion de token en $req, no solo el usuario
        if($req->getUsuario()!=null)
        {
            //Abrir conexion con la base de datos
            $db = DatabaseModel::getInstance();
            $db_connection = $db->getConnection();

            //Preparar la sentencia que mandamos a la base de datos
            $query = "SELECT "
                . \ConsUsuarioModel::PASS .
                " FROM " . \ConsUsuarioModel::TABLE_NAME .
                " WHERE " . \ConsUsuarioModel::USER . " = ?";



            $prep_query = $db_connection->prepare($query);


            //$aux = $req->usuario;
            $nombre_usuario = $req->getUsuario();
            if($nombre_usuario != null)
            {
                $prep_query->bind_param('s', $nombre_usuario);
            }



            $prep_query->execute();

            $prep_query->bind_result($pass);

            while ($prep_query->fetch())
            {
                //if($pass != null) $pass_hash = utf8_encode($pass); //no es necesario
                if($pass != null || password_verify($req->getContrasena(), $pass))
                {
                    $valido = true;
                }
            }

            /*if($pass != null || password_verify($req->getContrasena(), $pass_hash))
            {
                $valido = true;
            }*/

            $db->closeConnection();
        }


        return $valido;
    }
}