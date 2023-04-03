<?php
/* Koppel de config.inc pagina */
require 'config.pdo.php';
/* Selecteer alles van PDO databasee */
$sql = "SELECT * FROM PDO";
/* Zorg dat de sql tot werkend krijgt */
$results = $mysqli->query($sql);


echo " <a href='toevoegen.php'>Voeg een lid toe</a><br><br>";
/* Terwijl er rijen zijn, moet je al die gegevens pakken */
while($row = $results->fetch())
{

    echo "ID: " . $row['ID']. '<br/>';
    echo "Naam: " . $row['Naam']. ' <br/> ';
    echo "Achternaam: " . $row['Achternaam']. '<br/>';
    echo "Email: " . $row['Email']. "<br/>";
    echo "<a href='aanpassen.php?id=" . $row['ID'] . "'>Aanpassen</a><br>";
    echo "<a href='verwijderen.php?id=" . $row['ID'] . "'>Verwijderen</a><br/><br/>";

}