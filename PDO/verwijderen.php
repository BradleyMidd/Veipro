<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<p>Wilt u deze gegevens verwijderen?</p>
<button type="submit" name="submit" value="Ja">Ja</button>
</form>
</body>
</html>

<?php
/* Koppel de config.inc pagina */
require 'config.pdo.php';
/* Pak de id van de url */
$id = $_GET['id'];
/* Als er op de submit knop is gedrukt dan voert hij alle acties uit */
if(isset($_POST['submit'])) {
    /* Maak een query aan dat een lid verwijderd */
    $query = "DELETE FROM PDO WHERE ID = ?";

    /* Zet alle gegevens in een array */
    $gegevens = [$id];

    /* Als de query wordt voorbereid */
    if ($stmt = $mysqli->prepare($query)) {

        /* Als de query is goed uitgevoerd  */
        if ($stmt->execute($gegevens)) {

            echo "<script>
            alert('Verwijderen van rij $id is gelukt');";
            echo "window.location.href = 'uitlezen.php'";
            echo "</script>";

        }
        /* Anders krijg je foutmelding */
        else {

            echo "Fout bij verwijderen";
            echo $stmt->error . "<br>";

        }

    }
    /* Anders krijg je foutmelding */
    else {

        echo "Fout bij prepared statement";

    }

}