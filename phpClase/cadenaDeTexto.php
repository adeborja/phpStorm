<?php
/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 15/10/18
 * Time: 10:11
 */

class cadenaDeTexto
{
    public $texto;

    public function setTexto($nuevoTexto)
    {
        $this->texto=$nuevoTexto;
    }

    //http://php.net/manual/es/function.substr-count.php
    public function vecesPalabra($palabra)
    {
        $veces= substr_count(strtolower($this->texto),strtolower($palabra),0);

        return $veces;
    }

}