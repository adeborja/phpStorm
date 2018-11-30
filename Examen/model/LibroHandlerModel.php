<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 30/11/18
 * Time: 9:42
 */
require_once "ConsLibroModel.php";

class LibroHandlerModel
{

    public static function getLibro($id,$queryString)
    {
        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $valid = self::isValid($id);


        if ($valid === true || $id == null) {

            $query = "SELECT " . \ConstantesDB\ConsLibroModel::ID . ","
                . \ConstantesDB\ConsLibroModel::TITULO . ","
                . \ConstantesDB\ConsLibroModel::PAGS . ","
                . \ConstantesDB\ConsLibroModel::CAPITULOS . " FROM "
                . \ConstantesDB\ConsLibroModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibroModel::ID . " = ?";
            }

            if($queryString != null){

                $query = $query . " WHERE " . \ConstantesDB\ConsLibroModel::TITULO . " = ?";

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
            $listaLibros = array();


            $prep_query->bind_result($id, $tit, $pag, $cap);

            while ($prep_query->fetch()) {
                $id = NumberFormatter::INTEGER_DIGITS($id);
                $tit = utf8_encode($tit);
                $pag = NumberFormatter::INTEGER_DIGITS($pag);
                $cap = NumberFormatter::INTEGER_DIGITS($cap);

                $libro = new clsCapituloModel($tit, $pag, $cap, $id);
                $listaLibros[] = $libro;
            }

        }
        $db_connection->close();

        return $listaLibros;

    }

    public static function postLibro($libro)
    {
        $filasAfectadas = -1;

        //Obtener una instancia de la base de datos
        $db = DatabaseModel::getInstance();

        //Abrir conexion con la base de datos
        $db_conexion = $db->getConnection();

        //sentencia a utilizar, será sentencia preparada
        $sentencia = ("INSERT INTO " . \ConstantesDB\ConsLibroModel::TABLE_NAME . " ( "
            . \ConstantesDB\ConsLibroModel::TITULO . " , "
            . \ConstantesDB\ConsLibroModel::PAGS . " , "
            . \ConstantesDB\ConsLibroModel::CAPITULOS . " ) VALUES (?,?,?) ");

        //sentencia preparada a partir de la anterior
        $sentencia_preparada = $db_conexion->prepare($sentencia);

        //bindear los parametros: i = integer, s = string
        $sentencia_preparada -> bind_param('sii', $libro->titulo, $libro->numpag, $libro->capitulos);

        //ejecutar la sentencia
        $sentencia_preparada -> execute();

        //recoger cuantas filas han sido afectadas
        $filasAfectadas = $sentencia_preparada->affected_rows;

        //cerrar la conexion
        $db_conexion->close();

        return $filasAfectadas;

    }


    public static function deleteLibro($id)
    {
        $filasAfectadas = -1;

        //Obtener una instancia de la base de datos
        $db = DatabaseModel::getInstance();

        //Abrir conexion con la base de datos
        $db_conexion = $db->getConnection();

        //Comprobar si la id existe en la base de datos
        $valid = self::isValid($id);

        //Si el id es valido o es null, entramos. Si es null, borra todos los libros
        if($valid == true || $id == null)
        {
            //sentencia a utilizar
            $sentencia = ("DELETE FROM " . \ConstantesDB\ConsLibroModel::TABLE_NAME . "");

            //Si la id no es null, añadimos a la sentencia
            if($id != null)
            {
                $sentencia = $sentencia . " WHERE " . \ConstantesDB\ConsLibroModel::ID . " = ?";
            }

            //sentencia preparada a partir de la anterior
            $sentencia_preparada = $db_conexion->prepare($sentencia);

            if($id != null)
            {
                $sentencia_preparada->bind_param('i', $id);
            }

            $sentencia_preparada->execute();

            //SERÍA ADECUADO BORRAR AQUÍ TAMBIÉN LOS CAPITULOS RELACIONADOS CON EL LIBRO
            //A BORRAR, O TODOS LOS CAPITULOS SI SE BORRAN TODOS LOS LIBROS. SI EL CODIGO
            //NO ESTA INCLUIDO ES POR FALTA DE TIEMPO EN EL EXAMEN. EN CASO DE BORRAR TODOS
            //LOS LIBROS EL COMANDO SERÍA "DELETE FROM CAPITULOS" Y EN CASO DE SER DE UN
            //LIBRO CONCRETO SERIA "DELETE FROM CAPITULOS WHERE IDLIBRO=?"

            $filasAfectadas = $sentencia_preparada->affected_rows;
        }

        $db_conexion->close();

        return $filasAfectadas;
    }


    public static function putLibro($libro)
    {
        $filasAfectadas = -1;

        $db = DatabaseModel::getInstance();
        $db_conexion = $db->getConnection();

        $sentencia = ("update " . \ConstantesDB\ConsLibroModel::TABLE_NAME .
            " set " . \ConstantesDB\ConsLibroModel::TITULO ." = ?, "
            . \ConstantesDB\ConsLibroModel::PAGS . " = ?, "
            . \ConstantesDB\ConsLibroModel::CAPITULOS . " =? where "
            . \ConstantesDB\ConsLibroModel::ID . " = ?");

        $sentencia_preparada = $db_conexion->prepare($sentencia);

        $sentencia_preparada -> bind_param('sii', $libro->titulo, $libro->numpag, $libro->capitulos);

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