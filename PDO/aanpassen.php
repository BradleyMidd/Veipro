<?php
/* Koppel de config.inc pagina */
require 'config.pdo.php';

/* Maak een variable aan genaamd id die gelijk is aan de get functie */
$id = $_GET['id'];

/* Maak een query aan dat alles selecteert van de back2_leden waar de id van back2_leden gelijk is aan de variable id */
$sql = "SELECT * FROM PDO WHERE id = '$id'";

/* Voer de query uit */
$result = $mysqli->query($sql);

/* Pak de rijen uit de back2_leden tabel */
$row = $result->fetch();
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
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="naam" value="<?php echo $row['Naam'] ?>">
    <input type="text" name="achternaam" value="<?php echo $row['Achternaam'] ?>">
    <input type="text" name="email" value="<?php echo $row['Email'] ?>">
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

<?php
/* Als er op de submit knop is gedrukt dan voert hij alle acties uit */
if(isset($_POST['submit']))
{
    /* Pak de gegevens via de name van de input */
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];

    /* Maak een query waar je de gegevens bijwerkt */
    $query = "UPDATE PDO SET Naam = ?, Achternaam = ?, Email = ? WHERE ID = ?";

    /* Zet alle gegevens in een array */
    $gegevens = [$naam, $achternaam, $email, $id];

    /* Als de query wordt voorbereid */
    if($stmt = $mysqli->prepare($query))
    {
        /* Als de query is goed uitgevoerd  */
        if ($stmt->execute($gegevens))
        {

            echo "<script>
				alert('Bewerken van rij $id is gelukt');";
            echo "window.location.href = 'uitlezen.php'";
            echo "</script>";
            exit;


        }
        /* Anders krijg je foutmelding */
        else {

            echo "Fout bij updaten.<br>";
            echo $stmt->error . "<br>";

        }
    }
    /* Anders krijg je foutmelding */
    else
        {
           echo "Fout bij het prepared statement";
        }
}