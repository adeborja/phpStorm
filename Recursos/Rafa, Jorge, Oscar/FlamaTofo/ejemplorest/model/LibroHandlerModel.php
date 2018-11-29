<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function getLibro($id,$queryString)
    {

        /*
        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnec null) tion();

        $query = "Select titulo,numpag,codigo from libros where numpag > ? ";

        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param('i', $libro["minpag"]);

        $listaLibros = $prep_query->execute();

        $db_connection->close();

        return $listaLibros;
        */


        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $valid = self::isValid($id);


        if ($valid === true || $id == null) {

            $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
                . \ConstantesDB\ConsLibrosModel::TITULO . ","
                . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
            }

            if($queryString != null){

                $query = $query . " where numpag >= ?";

            }


            $prep_query = $db_connection->prepare($query);

            if($id != null){

                $prep_query->bind_param('s', $id);

            }
            if($queryString != null){

                $prep_query->bind_param('s', $queryString);

            }


            $prep_query->execute();
            $listaLibros = array();


            $prep_query->bind_result($cod, $tit, $pag);

            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);
                $listaLibros[] = $libro;
            }


//            }
        }
        $db_connection->close();

        return $listaLibros;

    }

    public static function deleteLibro($id){

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $valid = self::isValid($id);

        if ($valid === true || $id == null) {

            $query = "Delete from libros";

             $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";


            $prep_query = $db_connection->prepare($query);


            if ($id != null) {

                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaLibros = array();


        }
        $db_connection->close();

        return $listaLibros;

    }

    public static function postLibro($libro){

        $filas = 0;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "Insert into libros (titulo,numpag) Values (?,?)";

        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param("si", $libro->titulo, $libro->numpag);

        $prep_query->execute();

        $filas = $prep_query->affected_rows;

        $db_connection->close();

        return $filas;

    }

    public static function putLibro($id,$libro){

        $filas = 0;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $query = "update libros set numpag = ?, titulo = ? where codigo = ?";

        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param("isi", $libro->numpag, $libro->titulo,$id);

        $prep_query->execute();

        $filas = $prep_query->affected_rows;

        $db_connection->close();

        return $filas;

        /*
        $filas = 0;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //$libroObjeto = new LibroModel($libro->codigo,$libro->titulo,$libro->numpag);

        $query = "update libros set numpag = ?, titulo = ? where codigo = ?";

        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param("isi", $libro->numpag, $libro->titulo,$libro->codigo);

        $prep_query->execute();

        $filas = $prep_query->affected_rows;

        $db_connection->close();

        return $filas;
        */


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