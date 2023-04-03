<?php
//Start de sessie
session_start();

//Koppel de conig.php aan de form pagina
require 'config.php';

//Als er geen token is dan creeër je een nieuwe token
if(!isset($_SESSION['token']))
{
    //Maak een token aan met 32 bytes
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    //Sessie van de code is gelijk aan de variable token
    $_SESSION['token'] = $token;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        li
        {
          list-style-type: none;
        }

    </style>
</head>
<body>

<form method="post">
    <input type="hidden" name="csfrtoken" value="<?php echo $_SESSION['token'];?>">
    <ul>
        <li><label for="User">User: </label><input type="text" name="user" placeholder="username"></li>
        <li><label for="Email">Email: </label><input type="email" name="email" placeholder="email"></li>
        <li><label for="Age">Age: </label><input type="number" name="age"></li>
        <li><label for="Date">Date: </label><input type="date" name="date"></li>
        <li><label for="Pass">Pass: </label><input type="password" name="pass" placeholder="password"></li>
        <li><input type="submit" name="submit" value="Submit"></li>
    </ul>
</form>

<?php
//Als er op een submit button gedrukt wordt, dan voert hij de code uit
if(isset($_POST['submit']))
{
    //Als er een token bestaat dan voert hij de registratie code uit
    if($_SESSION['token'] == $_POST['csfrtoken'])
    {

        //Maak 5 variables aan voor de gebruiker om te registreren
        $user = $_POST['user'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $date = $_POST['date'];
        $pass = sha1($_POST['pass']);

        //Split de date variable in de string parameter
        $split = explode("-", $date);

        //Als de user alleen letters bevat dan toon je de user
        if (preg_match("/^[a-zA-Z]/", $user))
        {

            echo $user . "<br>";

            //Als de email een geldige email is dan toon je de email
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {

                echo $email . "<br>";


                //Als leeftijd een nummer bevat dan toon je de leeftijd
                if (is_numeric($age)) {

                    echo $age . "<br>";


                    //Als de datum lager is dan de huidige datum en dat het een datum bevat dan toon je het datum
                    if ($split[0] <= date('Y') && $date != "")
                    {

                        echo $date . "<br>";


                        //Als het wachtwoord letters en cijfers bevatten dan toon je het wachtwoord
                        if (preg_match('/^[0-9a-f]{40}$/i', $pass))
                        {

                            echo $pass . "<br>";

                        }
                        //Anders wordt er aangetoont dat het ongeldig is
                        else
                        {
                            echo "Invalid Pass";
                        }

                    }else
                    {
                        echo "Invalid date";
                    }

                }else
                {
                    echo "Invalid Age";
                }

            }else
            {
                echo "Invalid Email";
            }

        }else
        {
            echo "Invalid username";
        }

        //Maak een functie aan genaamd uuid4
        function uuid4()
        {

            //Genereer een random string van 16 bytes
            $data = openssl_random_pseudo_bytes(16);

            //
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            $data[8] = chr(ord($data[8]) & 0x3f  | 0x80);


            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s', str_split(bin2hex($data), 4));

            //Ontvang de resultaat van de variable
            return $uuid;

        }

        //Maak een variable aan waarin je de functie aanroept
        $uuidv4 = uuid4();

        //Als de query goed wordt uitgevoerd dan voegt hij alle velden toe in de database
        if($stmt = mysqli_prepare($mysqli, "INSERT INTO veipro (`ID`, `User`, `Email`, `Age`, `Date`, `Pass`) VALUES (? ,? ,? ,? ,? ,?)")){
            //Voeg de variable toe
            mysqli_stmt_bind_param($stmt, 'sssiss', $uuidv4, $user, $email, $age, $date, $pass);

            //Voer de query uit
            mysqli_stmt_execute($stmt);

            //Lees de resultaten uit
            $result = mysqli_stmt_get_result($stmt);

            //Sluit de statement
            mysqli_stmt_close($stmt);

        }
        //Anders krijg je een foutmelding
        else{
            echo "Fout: ";
            var_dump($mysqli);
        }



    }
}


?>
</body>
</html>