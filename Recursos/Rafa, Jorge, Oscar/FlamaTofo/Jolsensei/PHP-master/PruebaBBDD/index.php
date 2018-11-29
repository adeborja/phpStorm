<?php
/**
 * Created by PhpStorm.
 * User: jobando
 * Date: 26/10/18
 * Time: 8:24
 */

require_once "Database.php";
require_once "Table.php";

echo "Esto funca";


//We also could have done:
//use \Constantes_DB\tabla1;
// And now we can use the class without preceding it with the namespace:
// echo tabla1::COD;

$db = Database::getInstance();
$mysqli = $db->getConnection();
$sql_query = "SELECT ". \Constantes_DB\tabla1::ID . " , "
    . \Constantes_DB\tabla1::NOMBRE . " , "
    . \Constantes_DB\tabla1::APELLIDOS . " , "
    . \Constantes_DB\tabla1::EDAD . " "
    ." FROM ". \Constantes_DB\tabla1::TABLE_NAME;




$result = $mysqli->query($sql_query);

if ($result->num_rows > 0) {
    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<td>'. \Constantes_DB\tabla1::ID  .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::NOMBRE  .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::APELLIDOS  .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::EDAD .'</td>';
    echo '</tr>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. $row[\Constantes_DB\tabla1::ID]  .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::NOMBRE]  .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::APELLIDOS]  .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::EDAD] .'</td>';
        echo '</tr>';
    }
    echo '</table>';
}
