<?php
include "database.php";
session_start();
$gebruikersnaam = 'test';
$gebruikersnaam = $_SESSION['userId'];
$random_hash = bin2hex(random_bytes(4));
$_SESSION["EmailDateTime"] = date("Y-m-d H:i:s");
$to = $_SESSION['userUid'];
$_SESSION["Email"] = $to;
$subject = "Activatie verkoopaccount - EenmaalAndermaal";

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

U heeft een verzoek gedaan tot het activeren van uw verkoopaccount.<br><br>

Hieronder vindt u de activatiecode om uw account te veranderen tot verkoopaccount. 
Dit kunt u doen door op \'Verkoopaccount activeren\' te klikken 
of door op de onderstaande link te klikken. <br><br>

Uw activatiecode is: <strong>' . $random_hash . '</strong><br><br>

<a href="http://iproject37.icasites.nl/verkoperActiveren.php">Verkoopaccount activeren</a><br><br><br>


Met vriendelijke groeten,<br>
iConcepts<br>
Heyendaalseweg 98<br>
6525 EE Nijmegen<br>
<a href=http://iproject37.icasites.nl>EenmaalAndermaal</a><br>

<img src="http://iproject37.icasites.nl/media/logomail.png" alt="Logo" height="150px" width="150px">
</body>

</html>
';

$sql = "INSERT INTO VerificatiecodeVerkoper(Gebruikersnaam,VerificatiecodeVerkoper) VALUES (?, ?)";
try {
    $query = $dbh->prepare($sql);
    if ($query->execute(array($gebruikersnaam, $random_hash))) { }
} catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ../verkoperWorden.php?error=$error");
    exit();
}

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@eenmaalandermaal.nl>' . "\r\n";
mail($to, $subject, $bericht, $headers);
header("Location: ../VerkoperActiveren.php");
