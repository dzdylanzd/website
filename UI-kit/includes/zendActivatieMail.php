<?php
include "database.php";
session_start();
$Gebruiksernaam = $_SESSION['userId'];
$random_hash = bin2hex(random_bytes(4));
$_SESSION["EmailDateTime"] = date("Y-m-d H:i:s");
$to = $_SESSION['userUid'];
$_SESSION["Email"] = $to;
$subject = "verificatie code verkoper";
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
Beste '.$Gebruikersnaam.',<br> 
Bedankt dat u voor EenmaalAndermaal heeft gekozen.<br>
Hieronder vindt u de code om uw verkoopaccount te activeren.<br>
Dit kunt u doen door op \'Verkoopaccount activeren\' te klikken<br>
De verificatiecode is:  <strong>' . $random_hash . '</strong>
<br>
<br>
Bedankt dat u voor ons heeft gekozen!<br>
iConcepts
</body>

</html>
';

$sql = "INSERT  INTO VerificatiecodeVerkoper(Gebruikersnaam,Verificatiecode) VALUES (?, ?)";
try {
    $query = $dbh->prepare($sql);
    if ($query->execute(array($Gebruiksernaam, $random_hash))) { }
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
mail($to, $subject, $message, $headers);
header("Location: ../VerkoperActiveren.php");
