<?php

class TextoUtil{


    public static function contarPalabras($texto){

        $arrayPalabras = str_word_count($texto,1);
        $numeroPalabras = 0;

        for($i = 0; $i < sizeof($arrayPalabras); $i++){

            $numeroPalabras++;
        }

        print $numeroPalabras;
    }

    public static function contarNumeroVecesPalabras($texto, $palabra){

        $arrayPalabras = str_word_count($texto,1);
        $numeroPalabras = 0;

        for($i = 0; $i < sizeof($arrayPalabras); $i++){

            if ($palabra == $arrayPalabras[$i])

                $numeroPalabras++;
        }

        print $numeroPalabras;
    }


}