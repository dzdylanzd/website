<?php
require_once('database.php');
session_start();

$sql = 'select Verkoper  from Voorwerp where VoorwerpNummer = ?';
$sql3 = "INSERT into meldingen(bericht,ontvanger) values(?,?)";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array( $_SESSION['PID']))) {
        while ($alles = $sth->fetch()) {
            $verkoper = $alles['Verkoper'];
            if( $melding = $dbh->prepare($sql3)){
                $melding->execute(array(' <a href= "productPage.php?ID='. $_SESSION['PID'] . '">deze veiling</a> van U is geblokeerd    ',$verkoper));
               }
        }
    }
}





$sql = 'update Voorwerp
Set Geblokkeerd = 1 , IsVeilingGesloten = 1
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


?>