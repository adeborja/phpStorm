<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 2/05/19
 * Time: 9:30
 */
class UsuarioHandlerModel
{
    //Funcion para comprobar que un id sea numerico
    private static function esValido($id)
    {
        $res = false;

        if(ctype_digit($id)) $res = true;

        return $res;
    }



    public static function getUsuario($id)
    {
        $ListaUsuarios = null;

        //Comprobar si el id es valido
        $valid = self::esValido($id);

        if($valid || $id == null)
        {
            //Abrir conexion con la base de datos
            $db = DatabaseModel::getInstance();
            $db_connection = $db->getConnection();

            //Preparar la sentencia que mandamos a la base de datos
            $query = "SELECT " . \ConsUsuarioModel::ID . ","
                . \ConsUsuarioModel::USER . //","
                //. \ConsUsuarioModel::PASS .
                "FROM " . \ConsUsuarioModel::TABLE_NAME;

            if($id != null) $query = $query . "WHERE " . \ConsUsuarioModel::ID . " = ?";


            $prep_query = $db_connection->prepare($query);


            if($id != null)
            {
                $prep_query->bind_param('i', $id);
            }
            else
            {
                $ListaUsuarios = array();
            }

            $prep_query->execute();

            $prep_query->bind_result($id, $user);//, $pass);

            while ($prep_query->fetch())
            {
                $user = utf8_encode($user);
                $usuario = new UsuarioModel($id, $user, null);//, $pass);

                if($id != null)
                {
                    $ListaUsuarios = $usuario;
                }
                else
                {
                    $ListaUsuarios[] = $usuario;
                }
            }

            $db->closeConnection();
        }

        return $ListaUsuarios;
    }


    //Como hacer los hash para la contraseña: https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/

    public static function postUsuario($usuario)
    {
        //TODO: verificar que no haya ya un usuario con el mismo nombre

        //Obtener una instancia de la base de datos
        $db = DatabaseModel::getInstance();

        //Abrir conexion con la base de datos
        $db_conexion = $db->getConnection();

        //sentencia a utilizar, será sentencia preparada
        $sentencia = ("insert into usuarios (username, password) values (?,?) ");

        //sentencia preparada a partir de la anterior
        $sentencia_preparada = $db_conexion->prepare($sentencia);

        //Realizar hash a la contraseña
        $pass_hash = password_hash($usuario->password, PASSWORD_BCRYPT);

        //bindear los parametros: i = integer, s = string
        $sentencia_preparada -> bind_param('ss', $usuario->username, $pass_hash);

        //ejecutar la sentencia
        $sentencia_preparada -> execute();

        $lineas = 0;

        if($sentencia_preparada->affected_rows == 1)
        {
            $lineas = 1;
        }

        //cerrar la conexion
        $db->closeConnection();
        //$db_conexion->close();

        return $lineas;
    }
}