<?php
session_start();


?>


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
<meta http-equiv="refresh" content="10" > 
<body>
    <?php include 'includes\nav-L-M.php';
    include 'includes/defaultMobileNav.php';
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">

            
            <div class="uk-flex-center uk-flex-column">
               
            
                    <div class="registreerbox">

                        <h3>auto Refresh</h3>
                        <?php

                        $sql12= "select * from Voorwerp where LooptijdEinde < getdate() and IsVeilingGesloten = 0";
                        if ($sth12 = $dbh->prepare($sql12)) {
                            if ($sth12->execute(array())) {
                                if($alles = $sth12->fetch() ){
                                    $sth12->execute(array());
                                while ($alles = $sth12->fetch()) {
                               $voorwerpNummer = $row['VoorwerpNummer'];

                        // haal koper en koopBedrag op
$sql = "SELECT top 1 * from bod where Voorwerp = ? order by BodBedrag desc";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($voorwerpNummer))) {
        while ($alles = $sth->fetch()) {
            $koper = $alles['Gebruiker'];
            $koopBedrag = $alles['BodBedrag'];
        }
    }
}
//  haal kopermail op
if (isset($koper)) {
    $sql = "select * from Gebruiker where Gebruikersnaam = ?";
    if ($sth = $dbh->prepare($sql)) {
        if ($sth->execute(array($voorwerpNummer))) {
            while ($alles = $sth->fetch()) {
                $kopermail = $alles['Mailadres'];
            }
        }
    }
}

if (isset($koper)) {
    $sqlchangeIsGesloten = "update Voorwerp
        set  isVeilingGesloten = 1 , Koper = ? , Verkoopprijs = ?
        where VoorwerpNummer = ?";
} else {
    $sqlchangeIsGesloten = "update Voorwerp
        set  isVeilingGesloten = 1 
        where VoorwerpNummer = ?";
}
// stuur een meldig naar de verkoper
$sql3 = "INSERT into meldingen(bericht,ontvanger) values(?,?)";
if ($melding = $dbh->prepare($sql3)) {
    $melding->execute(array('uw <a href="productPage.php?ID=' . $voorwerpNummer. '">veiling</a> is gesloten', $verkoper));
    // stuur een melding naar de koper
    if (isset($koper)) {
        $melding = $dbh->prepare($sql3);
        $melding->execute(array('U heeft deze <a href="productPage.php?ID=' . $voorwerpNummer . '">veiling</a> gewonnen', $koper));

        $to = $kopermail;
        $subject = "U heeft een veiling gewonnen!";
        // email bericht
        $message = '
            <html>
            <head>
            <title>EenmaalAndermaal</title>
            </head>
            <body>
            
            Beste ' . $voorletter . '. ' . $achternaam . ',<br><br>

            Gefeliciteerd! U heeft de veiling ' . $titel . ' gewonnen!<br><br>
            
            U kan de veiling vinden op de \'Mijn biedingen\' pagina, of via onderstaande link.<br><br>

            <a href="http://iproject37.icasites.nl/productPage.php?ID=' . $voorwerpNummer . '">Productpagina gewonnen veiling</a><br><br><br>


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
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        // zend email naar koper
        mail($to, $subject, $message, $headers);
    }
}
// sluit de veiling
$changeIsGesloten = $dbh->prepare($sqlchangeIsGesloten);
if (isset($koper)) {
    if ($changeIsGesloten->execute(array($koper, $koopBedrag, $voorwerpNummer))) {
        echo "<script> window.location.reload();</script>";
    }
} else {
    if ($changeIsGesloten->execute(array($voorwerpNummer))) {
        echo "<script> window.location.reload();</script>";
    }
}


}
                                }
}
}

                        ?>
                        
                    </div>
                    
            </div>
        </div>
    </div>

        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>