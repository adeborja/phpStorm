<?php
//require_once "cadenaDeTexto.php";
include ("cadenaDeTexto.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $cadena = $_REQUEST['ucadena'];
    $palabra = "hay";
    $textoEscrito = new cadenaDeTexto();
    $textoEscrito->setTexto($cadena);
    $lasveces = $textoEscrito::vecesPalabra($palabra);

    echo "$lasveces";
}