<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 30/11/18
 * Time: 9:42
 */
require_once "ConsCapituloModel.php";

class CapituloHandlerModel
{

    public static function getCapitulo($id,$queryString)
    {
        $listaCapitulos = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $valid = self::isValid($id);


        if ($valid === true || $id == null) {

            $query = "SELECT " . \ConstantesDB\ConsCapituloModel::ID . ","
                . \ConstantesDB\ConsCapituloModel::IDLIBRO . ","
                . \ConstantesDB\ConsCapituloModel::TITULO . ","
                . \ConstantesDB\ConsCapituloModel::PAGINAINICIO . ","
                . \ConstantesDB\ConsCapituloModel::PAGINAFIN . " FROM " . \ConstantesDB\ConsCapituloModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsCapituloModel::ID . " = ?";
            }

            if($queryString != null){

                $query = $query . " WHERE " . \ConstantesDB\ConsCapituloModel::TITULO . " = ?";

            }


            $prep_query = $db_connection->prepare($query);

            if ($id != null)
            {
                $prep_query->bind_param('i', $id);
            }

            if ($queryString != null)
            {
                $prep_query->bind_param('s', $queryString);
            }


            $prep_query->execute();
            $listaCapitulos = array();


            $prep_query->bind_result($id,$idLibro, $tit, $pagIni, $pagFin);

            while ($prep_query->fetch()) {
                $id = NumberFormatter::INTEGER_DIGITS($id);
                $idLibro = NumberFormatter::INTEGER_DIGITS($idLibro);
                $pagIni = NumberFormatter::INTEGER_DIGITS($pagIni);
                $pagFin = NumberFormatter::INTEGER_DIGITS($pagFin);
                $tit = utf8_encode($tit);
                $capitulo = new clsCapituloModel($tit, $pagIni, $pagFin, $id, $idLibro);
                $listaCapitulos[] = $capitulo;
            }

        }
        $db_connection->close();

        return $listaCapitulos;

    }

    public static function postCapitulo($capitulo)
    {
        $filasAfectadas = -1;

        //Obtener una instancia de la base de datos
        $db = DatabaseModel::getInstance();

        //Abrir conexion con la base de datos
        $db_conexion = $db->getConnection();

        //sentencia a utilizar, será sentencia preparada
        $sentencia = ("INSERT INTO " . \ConstantesDB\ConsCapituloModel::TABLE_NAME . " ( "
            . \ConstantesDB\ConsCapituloModel::IDLIBRO . " , "
            . \ConstantesDB\ConsCapituloModel::TITULO . " , "
            . \ConstantesDB\ConsCapituloModel::PAGINAINICIO . " , "
            . \ConstantesDB\ConsCapituloModel::PAGINAFIN . " ) VALUES (?,?,?,?) ");

        //sentencia preparada a partir de la anterior
        $sentencia_preparada = $db_conexion->prepare($sentencia);

        //bindear los parametros: i = integer, s = string
        $sentencia_preparada -> bind_param('isii', $capitulo->idLibro, $capitulo->titulo, $capitulo->paginaInicio, $capitulo->paginaFin);

        //ejecutar la sentencia
        $sentencia_preparada -> execute();

        //recoger cuantas filas han sido afectadas
        $filasAfectadas = $sentencia_preparada->affected_rows;

        //cerrar la conexion
        $db_conexion->close();

        return $filasAfectadas;

    }


    public static function deleteCapitulo($id)
    {
        $filasAfectadas = -1;

        //Obtener una instancia de la base de datos
        $db = DatabaseModel::getInstance();

        //Abrir conexion con la base de datos
        $db_conexion = $db->getConnection();

        //Comprobar si la id existe en la base de datos
        $valid = self::isValid($id);

        //Si el id es valido o es null, entramos. Si es null, borra todos los capitulos
        if($valid == true || $id == null)
        {
            //sentencia a utilizar
            $sentencia = ("DELETE FROM " . \ConstantesDB\ConsCapituloModel::TABLE_NAME . "");

            //Si la id no es null, añadimos a la sentencia
            if($id != null)
            {
                $sentencia = $sentencia . " WHERE " . \ConstantesDB\ConsCapituloModel::ID . " = ?";
            }

            //sentencia preparada a partir de la anterior
            $sentencia_preparada = $db_conexion->prepare($sentencia);

            if($id != null)
            {
                $sentencia_preparada->bind_param('i', $id);
            }

            $sentencia_preparada->execute();

            $filasAfectadas = $sentencia_preparada->affected_rows;
        }

        $db_conexion->close();

        return $filasAfectadas;
    }


    public static function putCapitulo($capitulo)
    {
        $filasAfectadas = -1;

        $db = DatabaseModel::getInstance();
        $db_conexion = $db->getConnection();

        $sentencia = ("update " . \ConstantesDB\ConsCapituloModel::TABLE_NAME .
            " set " . \ConstantesDB\ConsCapituloModel::IDLIBRO ." = ?, "
            . \ConstantesDB\ConsCapituloModel::TITULO ." = ?, "
            . \ConstantesDB\ConsCapituloModel::PAGINAINICIO . " = ?, "
            . \ConstantesDB\ConsCapituloModel::PAGINAFIN . " =? where "
            . \ConstantesDB\ConsCapituloModel::ID . " = ?");

        $sentencia_preparada = $db_conexion->prepare($sentencia);

        $sentencia_preparada -> bind_param('isii', $capitulo->idLibro, $capitulo->titulo, $capitulo->paginaInicio, $capitulo->paginaFin);

        $sentencia_preparada->execute();

        $filasAfectadas = $sentencia_preparada->affected_rows;

        $db_conexion->close();

        return $filasAfectadas;
    }




    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }
}