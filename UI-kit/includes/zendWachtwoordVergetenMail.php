<?php
include "database.php";
session_start();
$random_hash = bin2hex(random_bytes(4));
$to = $_POST['wachtwoorVergetenEmail'];
$subject = "Wachtwoord wijzigen";
$antwoord =  $_POST['beveiligingsvraag'];

$sql = "SELECT AntwoordTekst FROM Gebruiker WHERE Mailadres = ?";
if ($query = $dbh->prepare($sql)) {
    if ($query->execute(array($to))) {
      
        while ($alles = $query->fetch()) {
         
            $pwdCheck = password_verify($antwoord, $alles['AntwoordTekst']);
          
        }
    }
}



if ($pwdCheck) {
    $hashedPwd = password_hash($random_hash, PASSWORD_DEFAULT);
    $sql = "UPDATE Gebruiker SET Wachtwoord = ? WHERE Mailadres = ?";
    if ($query = $dbh->prepare($sql)) {
        $query->execute(array($hashedPwd, $to));
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
Beste meneer/mevrouw,<br> 
Hieronder vindt u een nieuw wachtwoord.<br>
Deze kunt u wijzigen door in te loggen met dit wachtwoord en dan naar de pagina \'Mijn gegevens\' te gaan en uw wachtwoord aan te passen.<br>
Het nieuwe wachtwoord is:  <strong>' . $random_hash . '

</strong><br>
<a href="http://iproject37.icasites.nl/email-Bevestiging.php">Bevestig e-mailadres</a>

<br>
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



    if (empty($_POST['wachtwoorVergetenEmail'])) {
        header("Location: ../wachtwoordVergeten.php?error=legeemail");
    } else {
        if ($pwdCheck) {

            mail($to, $subject, $message, $headers);
            header("Location: ../index.php");
        }else{
            header("Location: ../wachtwoordVergeten.php?error=fout");
            exit();
        }
        
    }
