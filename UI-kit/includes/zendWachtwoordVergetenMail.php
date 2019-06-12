<?php
include "database.php";
session_start();
$random_hash = bin2hex(random_bytes(4));
$to = $_POST['wachtwoordVergetenEmail'];
$subject = "Wachtwoord vergeten - EenmaalAndermaal";
$antwoord =  $_POST['beveiligingsvraag'];
// haal het antwoord op
$sql = "SELECT AntwoordTekst FROM Gebruiker WHERE Mailadres = ?";
if ($query = $dbh->prepare($sql)) {
    if ($query->execute(array($to))) {

        while ($alles = $query->fetch()) {
            // check of de vraag klopt
            $pwdCheck = password_verify($antwoord, $alles['AntwoordTekst']);
        }
    }
}
// als de vraag klopt zet niet random wachtwoord
if ($pwdCheck) {
    $hashedPwd = password_hash($random_hash, PASSWORD_DEFAULT);
    $sql = "UPDATE Gebruiker SET Wachtwoord = ? WHERE Mailadres = ?";
    if ($query = $dbh->prepare($sql)) {
        $query->execute(array($hashedPwd, $to));
    }
}
// bepaal voor en achternaam
$sql = 'SELECT * FROM Gebruiker WHERE Mailadres = ?';
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($to))) {
        while ($row = $sth->fetch()) {
            $voorletter = substr($row['Voornaam'], 0, 1);
            $achternaam = $row['Achternaam'];
        }
    }
}

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

U heeft een verzoek gedaan tot het resetten van uw wachtwoord. U kan uw wachtwoord wijzigen
door in te loggen met een nieuw tijdelijk wachtwoord, die is gegeven aan het eind van deze mail.<br><br>

U kan dit wachtwoord wijzigen, als u naar de pagina \'Mijn gegevens\' gaat en op de knop \'Wijzig gegevens\'
klikt, onderaan de pagina.<br><br>

Uw gebruikersnaam is: <strong>' . $gebruikersnaam . '</strong><br><br>

Uw nieuw, tijdelijke wachtwoord is: <strong>' . $random_hash . '</strong>

<a href="http://iproject37.icasites.nl/wachtwoordVergeten.php">Wijzig wachtwoord link</a><br><br><br>


Met vriendelijke groeten,<br>
iConcepts<br>
Heyendaalseweg 98<br>
6525 EE Nijmegen<br>
<a href=http://iproject37.icasites.nl>EenmaalAndermaal</a><br>

<img src="http://iproject37.icasites.nl/media/logomail.png" alt="Logo" height="150px" width="150px">

</body>

</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@eenmaalandermaal.nl>' . "\r\n";

if (empty($_POST['wachtwoordVergetenEmail'])) {
    header("Location: ../wachtwoordVergeten.php?error=legeemail");
} else {
    // stuur mail
    if ($pwdCheck) {
        mail($to, $subject, $message, $headers);
        header("Location: ../index.php");
    } else {
        header("Location: ../wachtwoordVergeten.php?error=fout");
        exit();
    }
}
