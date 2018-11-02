<?php
/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 29/10/18
 * Time: 9:45
 */

//En este index se va a pintar los datos de los equipos
require_once "Database.php";
require_once "tabla_equipos.php";

//coger la instancia de la base de datos
$db = Database::getInstance();

//Coger la conexion de la instancia cogida
$mysqli = $db->getConnection();

//Escribir la consulta a realizar
$sql_query = "SELECT ". \constantesBBDD\tabla_equipos::ID . ", "
        . \constantesBBDD\tabla_equipos::NOMBRE . ", "
        . \constantesBBDD\tabla_equipos::NUMERO_JUGADORES . " "
    ." FROM ". \constantesBBDD\tabla_equipos::NOMBRE_TABLA;

//Recoger los resultados al realizar la consulta
$result = $mysqli->query($sql_query);

//Pintar los resultados recogidos
if($result->num_rows > 0)
{
   echo '<table border=\"1\">';
   echo '<tr>';
   echo '<td>'. \constantesBBDD\tabla_equipos::ID .'</td>';
   echo '<td>'. \constantesBBDD\tabla_equipos::NOMBRE .'</td>';
   echo '<td>'. \constantesBBDD\tabla_equipos::NUMERO_JUGADORES .'</td>';
   echo '<tr>';

   while($row = $result->fetch_assoc())
   {
       echo '<tr>';
       echo '<td>'. $row[\constantesBBDD\tabla_equipos::ID] .'</td>';
       echo '<td>'. $row[\constantesBBDD\tabla_equipos::NOMBRE] .'</td>';
       echo '<td>'. $row[\constantesBBDD\tabla_equipos::NUMERO_JUGADORES] .'</td>';
       echo '<tr>';
   }
   echo '</table>';
}
