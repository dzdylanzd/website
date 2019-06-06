<?php
include "database.php";
session_start();
$gebruikersnaam = 'test';
$gebruikersnaam = $_SESSION['userId'];


$to = $_SESSION['userUid'];

$subject = "Veiling geblokkeerd - EenmaalAndermaal";

$sql = 'SELECT * FROM Gebruiker WHERE Gebruikersnaam = ?';
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruikersnaam))) {
        while ($row = $sth->fetch()) {
            $voorletter = substr($row['Voornaam'], 0, 1);
            $achternaam = $row['Achternaam'];
        }
    }
}

$sql = 'SELECT * FROM Voorwerp WHERE VoorwerpNummer = ? ';
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array( $_SESSION['PID']))) {
        while ($row = $sth->fetch()) {
            $titelGeblokkeerd = $row['Titel'];
            $geblokkeerd = $row['Geblokkeerd'];
        }
    }
}

$bericht = '
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

Wegens ongepast gedrag heeft een beheerder besloten een van uw veilingen
te blokkeren. We hopen voor uw begrip.<br><br>

Het gaat om de veiling ' . $titelGeblokkeerd . '.<br><br>

Er kan nu niet meer op deze veiling worden geboden en hij kan door niemand worden gezien behalve u.<br><br>

Vindt u deze actie onterecht? Neem dan contact met ons op.<br><br><br>


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
if( $geblokkeerd ){
mail($to, $subject, $bericht, $headers);
}

