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

<form name="inloggen" action="" method="post">
    <input type="text" name="email" value="iemand@gmail.com" />
    <input type="password" name="password" value="wachtwoord" />
    <input type="submit" name="submit" value="inloggen" />
</form>
<?php

if(isset($_POST['submit']))
{
    echo "------------------- Backend -----------------";
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    echo "<br>e-mail: $email";
    echo "<br>wachtwoord: $password";

    echo "<br>Domein naam: $_SERVER[HTTP_HOST]";
    echo "<br>Browser:	$_SERVER[HTTP_USER_AGENT]";
    echo "<br>IP-adres:		$_SERVER[REMOTE_ADDR]";
    echo "<br>FilePath:		$_SERVER[SCRIPT_FILENAME]";
    echo "<br>Server-Name:		$_SERVER[SERVER_NAME]";

}

?>


</body>
</html>