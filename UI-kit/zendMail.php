<?php
session_start();
$random_hash = bin2hex(random_bytes(3));
$_SESSION["emailCode"] = $random_hash;
$_SESSION["EmailDateTime"] = date("Y-m-d H:i:s");
$to = $_POST['emailbevestiging'];
$_SESSION["Email"] = $to;
$subject = "HTML email";

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
Hieronder vindt u de code om uw e-mailadres te bevestigen.<br>
Dit kunt u doen door op \'registeren\' te klikken of door op de onderstaande link te klikken<br>
De bevestigingscode is:  <strong>' . $random_hash . '

</strong><br>
<a href="http://iproject37.icasites.nl/email-Bevestiging.php">Bevestig e-mailadres</a>

<br>
<br>
Bedankt dat u voor ons heeft gekozen!<br>
Iconcepts
</body>

</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
header("location: email-Bevestiging.php");
?>