<html>
<body>



<?php

    require_once "TextoUtil.php";

    $texto = new TextoUtil();

    echo  ("Numero de palabras: ");

    echo $texto->contarPalabras($_POST["texto"]);

    echo "<br>";

    echo "Numero de palabras en un texto: ";

    echo $texto->contarNumeroVecesPalabras($_POST["texto2"], $_POST["palabra"]);






?><br>


</body>
</html>