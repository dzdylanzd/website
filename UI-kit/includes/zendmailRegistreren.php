<?php
session_start();
include 'database.php';

$gebruikersnaam = $_SESSION['userId'];
$to = $_SESSION['userUid'];

$subject = "Bedankt voor uw registratie! - EenmaalAndermaal";

$sql = 'SELECT * FROM Gebruiker WHERE Gebruikersnaam = ?';
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruikersnaam))) {
        while ($row = $sth->fetch()) {
            $voorletter = substr($row['Voornaam'], 0, 1);
            $achternaam = $row['Achternaam'];
        }
    }
}

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
Beste ' . $voorletter . '. ' . $achternaam . ',<br><br>
Bedankt dat u een account heeft gemaakt op EenmaalAndermaal, u kunt nu beginnen met het bieden op veilingen!<br><br>
Wilt u inloggen? Dit kan door op de inlogknop te klikken en uw gegevens in te vullen.<br><br>
Uw gebruikersnaam is: ' . $gebruikersnaam . '<br><br>
U kunt ten alle tijden uw gegevens wijzigen op de pagina: ‘Mijn gegevens’ onder uw profiel.<br><br><br>

Met vriendelijke groeten,<br>
iConcepts<br>
Heyendaalseweg 98<br>
6525 EE Nijmegen<br>
<a href=http://iproject37.icasites.nl>EenmaalAndermaal</a><br>

<img src="http://iproject37.icasites.nl/media/logo.png" alt="Logo" height="150px" width="150px">

</body>

</html>
';



if (mail($to, $subject, $message, $headers)) {
    header("Location: ../index.php");
    exit();
}
