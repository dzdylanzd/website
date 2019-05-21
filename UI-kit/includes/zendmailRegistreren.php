<?php

session_start();

$gebruiksernsam = $_SESSION['userId'];
$to = $_SESSION['userUid'];


$subject = "gefeliciteerd u ben lid";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: <info@eenmaalandermaal.nl>' . "\r\n";

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
u kunt nu inloggen door op de inlog knop te klikken en uw gegevens in te vullen<br>
uw gebruikersnaam is:  <strong>' . $gebruiksernsam . '

</strong>
<br>
Bedankt dat u voor ons heeft gekozen!<br>
iConcepts
</body>

</html>
';



if (mail($to, $subject, $message, $headers)) {
    header("Location: ../index.php");
    exit();
}
