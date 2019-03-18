<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function getLibro($id)
    {
        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like libro/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {
            $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
                . \ConstantesDB\ConsLibrosModel::TITULO . ","
                . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }
            else{
                $listaLibros = array();
            }

            $prep_query->execute();
            //$listaLibros = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);

                if($id != null)
                {
                    $listaLibros = $libro;
                }
                else
                {
                    $listaLibros[] = $libro;
                }
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
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
        $sentencia = ("insert into libros (titulo, numpag) values (?,?) ");

        //sentencia preparada a partir de la anterior
        $sentencia_preparada = $db_conexion->prepare($sentencia);

        //bindear los parametros: i = integer, s = string
        $sentencia_preparada -> bind_param('si', $libro->titulo, $libro->numpag);

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
            $sentencia = ("delete from libros");

            //Si la id no es null, añadimos a la sentencia
            if($id != null)
            {
                $sentencia = $sentencia . " where " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
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


    public static function putLibro($libro)
    {
        $filasAfectadas = -1;

        $db = DatabaseModel::getInstance();
        $db_conexion = $db->getConnection();

        $sentencia = ("update libros set titulo = ?, numpag = ? where codigo = ?");

        $sentencia_preparada = $db_conexion->prepare($sentencia);

        $sentencia_preparada->bind_param('sii', $libro->titulo, $libro->numpag, $libro->codigo);

        $sentencia_preparada->execute();

        $filasAfectadas = $sentencia_preparada->affected_rows;

        $db_conexion->close();

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