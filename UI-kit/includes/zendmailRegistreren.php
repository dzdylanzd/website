<?php

session_start();

$gebruiksersnaam = $_SESSION['userId'];
$to = $_SESSION['userUid'];


$subject = "Welkom bij EenmaalAndermaal!";

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
U kunt nu beginnen met het bieden op veilingen!<br>
Wilt u inloggen? Dit kan door op de inlogknop te klikken en uw gegevens in te vullen.<br>
Uw gebruikersnaam is:  <strong>' . $gebruiksersnaam . '.

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
