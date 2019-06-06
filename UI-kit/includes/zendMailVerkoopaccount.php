<?php
include "database.php";
session_start();
$gebruikersnaam = 'test';
$gebruikersnaam = $_SESSION['userId'];


$to = $_SESSION['userUid'];

$subject = "Verkoopaccount bevestiging - EenmaalAndermaal";

$sql = 'SELECT * FROM Gebruiker WHERE Gebruikersnaam = ?';
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruikersnaam))) {
        while ($row = $sth->fetch()) {
            $voorletter = substr($row['Voornaam'], 0, 1);
            $achternaam = $row['Achternaam'];
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

Uw account is vanaf nu officieel een verkoopaccount. Dit
betekent dat u kan beginnen met het plaatsen van veilingen!<br><br>

Als u naar de \'Mijn veilingen\' pagina gaat, vindt u de knop om een nieuwe veiling te maken.<br><br><br>


Met vriendelijke groeten,<br>
iConcepts<br>
Heyendaalseweg 98<br>
6525 EE Nijmegen<br>
<a href=http://iproject37.icasites.nl>EenmaalAndermaal</a><br>

<img src="http://iproject37.icasites.nl/media/logomail.png" alt="Logo" height="150px" width="150px">
</body>

</html>
';

//  headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@eenmaalandermaal.nl>' . "\r\n";
mail($to, $subject, $bericht, $headers);

