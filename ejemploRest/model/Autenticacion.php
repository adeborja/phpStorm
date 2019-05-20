<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Request.php');
require_once(__ROOT__.'/jwt/JWT.php');

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

            $db->closeConnection();
        }


        return $valido;
    }

    //Documentacion jwt
    //https://github.com/firebase/php-jwt
    //https://medium.com/memorias-de-un-techie/jwt-jugando-con-autenticaci%C3%B3n-con-tokens-6123e56bf505
    //https://www.anerbarrena.com/php-strtotime-4930/
    //https://anexsoft.com/implementacion-de-json-web-token-con-php
    //https://www.sitepoint.com/php-authorization-jwt-json-web-tokens/

    //Archivos: https://github.com/firebase/php-jwt/blob/master/src/JWT.php

    public static function validarUsuarioDevuelveToken($req)
    {
        $key = "4N631";

        $token = $req->getToken();
        $jwt = null;

        //Primero comprobar si el token es valido en caso de haberlo

        //Si hay token y es valido, se genera uno nuevo y se devuelve.
        //Si no hay token pero hay datos de usuario, se comprueba si son correctos
        //Si no se cumplen las anteriores, devuelve false
        //TODO: capturar excepcion y mostrar mensajes de error


        //$token_valido = false;
        $token_decodificado = null;

        if($token != null)
        {
            try
            {
                //Lo comentado no es necesario porque el token de por si ya comprueba si issuedAt es valido
                $token_decodificado = JWT::decode($token, $key, array('HS256'));

                //Se genera un nuevo token
                $jwt = self::generarToken();
            }
            catch (Exception $e)
            {
                throw $e;
            }

            /*catch (BeforeValidException $e)
            {
                $jwt = 50; //Codigo que indica que el token no es valido todavia
            }
            catch (ExpiredException $e)
            {
                $jwt = 51; //Codigo que indica que el token ha expirado
            }
            catch (SignatureInvalidException $e)
            {
                $jwt = 52; //Codigo que indica que el token no tiene firma valida
            }
            catch (Exception $e)
            {
                $jwt = 53; //Indica que ha ocurrido cualquier otro error
            }*/





        }
        else
        {
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
                    if($pass != null && password_verify($req->getContrasena(), $pass))
                    {
                        //Aquí se genera el token
                        $jwt = self::generarToken();
                    }
                }

                $db->closeConnection();
            }
        }


        return $jwt;
    }

    private static function generarToken()
    {
        $key = "4N631";

        $token = array(
            "iat" => strtotime("now"),
            "exp" => strtotime("+5 seconds")
        );

        $jwt = JWT::encode($token, $key);

        return $jwt;
    }
}