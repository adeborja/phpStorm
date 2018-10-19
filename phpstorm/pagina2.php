<?php
/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 8/10/18
 * Time: 10:47
 */
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_REQUEST['uname'];
    $edad = $_REQUEST['uedad'];
    $genero = $_REQUEST['ugenero'];

    echo "Tu nombre es $name <br>";
    echo "Tu edad es $edad <br>";
    echo "Eres $genero";
    if($genero=='Hombre')
    {
        echo '<body style="background-color: blue">';
    }
    else
    {
        echo '<body style="background-color: pink">';
    }

}

