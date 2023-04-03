<?php
/* Koppel de config.inc pagina */
require 'config.pdo.php';

?>
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
    <input type="text" name="naam" placeholder="Uw naam...">
    <input type="text" name="achternaam" placeholder="Uw achternaam...">
    <input type="text" name="email" placeholder="Uw emailadres...">
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>


<?php
/* Als er op de submit knop is gedrukt dan voert hij alle acties uit */
if(isset($_POST['submit'])) {
    /* Pak de gegevens via de name van de input */
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];

    /* Maak een query waar je alle informatie toevoegd */
    $query = "INSERT INTO PDO(`Naam`, `Achternaam`, `Email`) VALUES (?, ?, ?)";

    /* Als de query wordt voorbereid */
    if ($stmt = $mysqli->prepare($query))
    {
        /* Zet alle gegevens in een array */
        $gegevens = [$naam, $achternaam, $email];

        /* Als de query is goed uitgevoerd  */
        if($stmt->execute($gegevens))
        {

            echo "<script>
				alert('Toevoegen van lid is gelukt');";
            echo "window.location.href = 'uitlezen.php'";
            echo	  "</script>";
            exit;

        }
        /* Anders krijg je foutmelding */
        else
        {

            echo "Fout bij het toevoegen van uw gegevens.<br/>";
            var_dump($gegevens);

        }

    }
    /* Anders krijg je foutmelding */
    else
    {

        echo "Fout in prepared statement.<br/>";

    }
}