<?php
/* Laat alle errors zien */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/* Voer je gegevens in voor je database */
$db_hostname = 'localhost';
$db_username = '82737_back2';
$db_password = 'Bradley123!';
$db_database = 'Back_2';

/* Maak een new PDO aan waar je alle informatie van je database kan opzeggen*/
try
{

    $mysqli = new PDO("mysql:host={$db_hostname};dbname={$db_database}", $db_username, $db_password);


}
/* Als het niet werkt dan schakelt hij het uit met een message */
catch( PDOException $e )
{

    die( $e->getMessage());

}