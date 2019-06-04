<?php
include "includes/database.php";
session_start();
$random_hash = bin2hex(random_bytes(3));
$emailCode = $random_hash;
$_SESSION["EmailDateTime"] = date("Y-m-d H:i:s");
$to = $_POST['emailbevestiging'];
$_SESSION["Email"] = $to;
$subject = "E-mailbevestiging - EenmaalAndermaal";

if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
    header("location: ./email-Bevestiging.php?error=fouteEmail");
    exit();
  } 

$sql = "SELECT *  from VerificatiecodeEmail where Mailadres = ?";
if (!$query = $dbh->prepare($sql)) {
    header("location: ./email-Bevestiging.php?error=7");
    exit();
} else {
    $query = $dbh->prepare($sql);
    $query->execute(array($to));
    while ($alles = $query->fetch()) {  
        if( $alles['DatumEinde'] > getdate()) {
            $sqlDeleteCode = 'delete VerificatiecodeEmail where Mailadres = ?';
            $query2 = $dbh->prepare($sqlDeleteCode);
            $query2->execute(array($to));
        }else{
            header("location: ./email-Bevestiging.php?error=CodeAlOntvangen");
            exit();
        }
    }
}

$sql = "INSERT INTO VerificatiecodeEmail(Mailadres,VerificatiecodeEmail) VALUES (?, ?)";
if (empty($to)) {
    header("location: ./email-Bevestiging.php?error=legeEmail");
    exit();
}
try {
    $query = $dbh->prepare($sql);
    if ($query->execute(array($to, $emailCode))) { }
} catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ./email-Bevestiging.php?error=$error");
    exit();
}

$sql = "SELECT Mailadres from Gebruiker where Mailadres = ?";
if (!$query = $dbh->prepare($sql)) {
    header("location: ./email-Bevestiging.php?error=7");
    exit();
} else {
    $query = $dbh->prepare($sql);
    $query->execute(array($to));
    if ($query->fetch()) {
        header("location: ./email-Bevestiging.php?error=emailInGebruik");
        exit();
    } else { }
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
Beste ' . $to . '<br><br>

Bedankt dat u voor EenmaalAndermaal heeft gekozen. <br><br>

Hieronder vindt u de code om uw e-mailadres te bevestigen. 
Dit kunt u doen door de code in te voeren op de website of door op onderstaande link te klikken.<br><br>

Uw bevestigingscode is: <strong>' . $emailCode . '</strong><br><br>

<a href="http://iproject37.icasites.nl/email-Bevestiging.php">Bevestig e-mailadres</a><br><br><br>


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



if (empty($_POST['emailbevestiging'])) {
    header("Location: email-Bevestiging.php?error=legeEmail");
} else {
    mail($to, $subject, $message, $headers);
    header("Location: email-Bevestiging.php?error=succes");
}
