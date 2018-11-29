<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function getLibro($id, $queryString)
    {
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



            if ($id != null) {

                $prep_query->bind_param('s', $id);
            }

            if($queryString != null){

                $prep_query->bind_param('s', $queryString);

            }

            $prep_query->execute();
            $listaLibros = array();



            $prep_query->bind_result($cod, $tit, $pag);

            if($id != null){

                while ($prep_query->fetch()) {
                    $tit = utf8_encode($tit);
                    $listaLibros = new LibroModel($cod, $tit, $pag);
                }

            }else{

                while ($prep_query->fetch()) {
                    $tit = utf8_encode($tit);
                    $libro = new LibroModel($cod, $tit, $pag);
                    $listaLibros[] = $libro;
                }

            }


        }
        $db_connection->close();

        return $listaLibros;
    }


    public static function postLibro($libro)
    {

        $filasAfectadas = 0;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


            $query = ("insert into libros (titulo,numpag) values  (?,?)");

            $prep_query = $db_connection->prepare($query);

            $prep_query->bind_param("si",  $libro->titulo, $libro->numpag);

            $prep_query->execute();

            $filasAfectadas = $prep_query->affected_rows;

            $db_connection->close();

        return $filasAfectadas;
    }


    public static function deleteLibro($id)
{
    $filasAfectadas = 0;

    $db = DatabaseModel::getInstance();
    $db_connection = $db->getConnection();


    $valid = self::isValid($id);

    //If the $id is valid or the client asks for the collection ($id is null)
    if ($valid === true || $id == null) {

        $query = ("delete from libros");


        if ($id != null) {
            $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD  . " = ?";
        }

        $prep_query = $db_connection->prepare($query);

        if ($id != null) {
            $prep_query->bind_param('i', $id);
        }

        $prep_query->execute();

        $filasAfectadas = $prep_query->affected_rows;
    }
    $db_connection->close();

    return $filasAfectadas;

}


    public static function putLibro($libro, $id)
    {
        $filasAfectadas = 0;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $query = ("update libros set numpag = ?, titulo = ? where codigo = ?");


        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param('isi', $libro->numpag, $libro->titulo, $id);

        $prep_query->execute();


        $filasAfectadas = $prep_query->affected_rows;

        $db_connection->close();

        return $filasAfectadas;

    }




    //returns true if $id is a valid id for a book
    //In this case, it will be valid if it only contains
    //numeric characters, even if this $id does not exist in
    // the table of books
    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}