<?php

session_start();

$gebruiksernsam = $_SESSION['userId'] ;
$to = $_SESSION["EmailDateTime"] ;


$subject = "gefeliciteerd u ben lid";


$message = '
<!DOCTYPE html>
<html>

<head>
    <title>EenmaalAndermaal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body>
Beste meneer/mevrouw,<br> 
Bedankt dat u voor EenmaalAndermaal heeft gekozen.<br>
u bent nu lid geworden van onze prachtige site.<br>
u kunt no inloggen door op de inlog knop te klikken en uw gegevens in te vullen<br>
uw gebruikersnaam is:  <strong>' . $gebruiksernsam . '


<br>
Bedankt dat u voor ons heeft gekozen!<br>
iConcepts
</body>

</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@eenmaalandermaal.nl>' . "\r\n";

$to = "somebody@example.com";
$subject = '
<!DOCTYPE html>
<html>

<head>
    <title>EenmaalAndermaal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body>
Beste meneer/mevrouw,<br> 
Bedankt dat u voor EenmaalAndermaal heeft gekozen.<br>
u bent nu lid geworden van onze prachtige site.<br>
u kunt no inloggen door op de inlog knop te klikken en uw gegevens in te vullen<br>
uw gebruikersnaam is:  <strong>' . $gebruiksernsam . '


<br>
Bedankt dat u voor ons heeft gekozen!<br>
iConcepts
</body>

</html>
';
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);



    if(mail("someone@example.com","My subject","hoit")){
    header("Location: ../index.php");
    exit();
    }

