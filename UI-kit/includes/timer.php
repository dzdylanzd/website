<?php


$sql = "SELECT top 1 * from bod where Voorwerp = ? order by BodBedrag desc";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($_SESSION['PID']))) {
        while ($alles = $sth->fetch()) {
         $koper = $alles['Gebruiker'];
         $koopBedrag = $alles['BodBedrag'];
        }
    }
}
if(isset($koper)){
$sql = "select * from Gebruiker where Gebruikersnaam = ?";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($_SESSION['PID']))) {
        while ($alles = $sth->fetch()) {
         $kopermail = $alles['Mailadres'];

      
        }
    }
}
}




$sql ="select isVeilingGesloten, LooptijdEinde, Verkoper,Titel  from Voorwerp where VoorwerpNummer = ?";
$sth = $dbh->prepare($sql);
if($sth->execute(array($_SESSION['PID']))){
    while ($row = $sth->fetch()) {
        $verkoper = $row['Verkoper'];
        $titel = $row['Titel'];
       
        if($row["isVeilingGesloten"] == 0){
            echo"<p class=\"witte-tekst\">De veiling is geopend</p>";
            $tijd =   substr(substr_replace($row["LooptijdEinde"], "T", 11,0),0,20) . "+02:00";
            $tijd =  str_replace(" ","",$tijd);
          
            echo "<h3 class=\"timer\"><div class=\"uk-grid-small uk-child-width-auto\" uk-grid uk-countdown=\"date:  $tijd\">
            <div>
                <div class=\"uk-countdown-number uk-countdown-days\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Dagen</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-hours\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Uren</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-minutes\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Minuten</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-seconds\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Seconden</div>
            </div>
        </div></h3>";
        if(strtotime($row["LooptijdEinde"]) < strtotime("now")){
           if(isset($koper)){
            $sqlchangeIsGesloten = "update Voorwerp
            set  isVeilingGesloten = 1 , Koper = ? , Verkoopprijs = ?
            where VoorwerpNummer = ?";
        }else{
            $sqlchangeIsGesloten = "update Voorwerp
            set  isVeilingGesloten = 1 
            where VoorwerpNummer = ?";
        }
            $sql3 = "INSERT into meldingen(bericht,ontvanger) values(?,?)";
           if( $melding = $dbh->prepare($sql3)){
            $melding->execute(array('uw <a href="productPage.php?ID='. $_SESSION['PID'] . '">veiling</a> is gesloten',$verkoper));
            if(isset($koper)){
                $melding = $dbh->prepare($sql3);
            $melding->execute(array('U heeft deze <a href="productPage.php?ID='. $_SESSION['PID'] . '">veiling</a> gewonnen',$koper));

            $to = $kopermail;
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
            }
        }
            $changeIsGesloten = $dbh->prepare($sqlchangeIsGesloten);
            if(isset($koper)){
                if($changeIsGesloten->execute(array($koper,$koopBedrag, $_SESSION['PID']))){
                    echo"<script> window.location.reload();</script>";
                    }
            }else{
                if($changeIsGesloten->execute(array($_SESSION['PID']))){
                    echo"<script> window.location.reload();</script>";
                    }
            }     
           
        }
        }else{
            
            echo"<h2>Sorry, de veiling is gesloten</h2>";
        }
    }
}
?>