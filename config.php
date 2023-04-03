<?php
## database logingegevens ##
$db_hostname = 'localhost'; // Deze laat je zo staan!
$db_username = '82737_back2'; // hier komt jouw FTP username
$db_password = 'Bradley123!';
//--> Bijv. :: https://passwordsgenerator.net/
$db_database = 'Back_2'; // Je kan maximaal 5 databases aanmaken op https://pma.ict-lab.nl/




## Onderstaande gegevens hoef je niet aan te passen, maar de variabel $con moet je in je verdere scripts gebruiken, 
## of deze hernoemen welke variabelenaam jouw voorkeur heeft:

function bestandcheck()
{



}

try {


    function myExceptionHandler($e)
    {

        echo "FOUT: Er is een exception niet opgevangen. <br>";
        echo "Code: " . $e->getCode() . " </br>";
        echo "Melding: " . $e->getMessage();

    }


## maak de database-verbinding ##
    if($mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database))
    {

        echo "Gelukt!";

    }

    else
    {

        throw new Exception("Er is op dit moment een technische storing. We zorgen ervoor dat het gefixt is!");

    }
} catch (Exception $e)
{

    echo $e->getMessage();
    ini_set('error_log', '../../logs/fout_log');
    error_log('Er is een fout opgetreden: ' . mysqli_connect_error() . " Error nummer: " . mysqli_connect_errno());


}finally
{

    echo "Gefixt!";

}


?>