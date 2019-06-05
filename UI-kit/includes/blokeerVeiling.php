<?php
require_once('database.php');
session_start();

//stuur de verkoper een melding
$sql = 'select Verkoper  from Voorwerp where VoorwerpNummer = ?';
$sql3 = "INSERT into meldingen(bericht,ontvanger) values(?,?)";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array( $_SESSION['PID']))) {
        while ($alles = $sth->fetch()) {
            $verkoper = $alles['Verkoper'];
            if( $melding = $dbh->prepare($sql3)){
                $melding->execute(array(' <a href= "productPage.php?ID='. $_SESSION['PID'] . '">deze veiling</a> van U is geblokeerd    ',$verkoper));


                $to = $kopermail;
                $subject = "U heeft een veiling gewonnen!";

                $message = '
                    <html>
                    <head>
                    <title>EenmaalAndermaal</title>
                    </head>
                    <body>
                    
                    Beste ' . $voorletter . '. ' . $achternaam . ',<br><br>

                    Gefeliciteerd! U heeft de veiling ' . $titel . ' gewonnen!<br><br>
                    
                    U kan de veiling vinden op de \'Mijn biedingen\' pagina, of via onderstaande link.<br><br>

                    <a href="http://iproject37.icasites.nl/productPage.php?ID=' . $_SESSION['PID'] . '">Productpagina gewonnen veiling</a><br><br><br>


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

                mail($to, $subject, $message, $headers);


               }
        }
    }
}




//blokeer / deblokeer de veiling
$sql = 'update Voorwerp
Set Geblokkeerd = ~Geblokkeerd , IsVeilingGesloten = ~IsVeilingGesloten 
where VoorwerpNummer = ?';
try {
   
    if ($sth = $dbh->prepare($sql)) {
        if ($sth->execute(array( $_SESSION['PID']))) {
            header("location: $_SERVER[HTTP_REFERER]");
            exit();
        }
    }   
} 
catch (PDOException $e) {	 
$error = $e->getMessage();
header("location: $_SERVER[HTTP_REFERER]&error=$error");
}
