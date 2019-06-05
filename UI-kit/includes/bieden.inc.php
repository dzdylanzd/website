<?php
session_start();
require_once('database.php');


$productid =  $_SESSION['PID'];
$bod =  $_POST['bod'];
$gebruiker =  $_SESSION['userId'];
$bodTijd = date("Y-m-d H:i:s");
if(!isset($_SESSION['userId'])){
    header("location: $_SERVER[HTTP_REFERER]&error=notLoggedIn");
    exit();
}else if(!empty($bod)){


    $sqlVorigeBod = 'SELECT top 1 * from bod where Voorwerp = ? and BodDagTijd not in (
        select top 1 BodDagTijd from bod where Voorwerp = ? order by BodDagTijd desc
        )order by BodDagTijd desc';
if ($sth = $dbh->prepare($sqlVorigeBod)) {
    if ($sth->execute(array($productid,$productid))) {
        while ($row = $sth->fetch()) {
$vorigeBieder = $row['Gebruiker'];
$vorigeBod = $row['BodBedrag'];
        }
    }
}



$sql = 'insert into bod(Voorwerp,BodBedrag,Gebruiker,BodDagTijd)
Values (?,?,?,?)';

// bepaald de miniumumVerhoging


if($bod <  $_SESSION['minimumVerhoging'] ){
    header("location: $_SERVER[HTTP_REFERER]&error=teLaagBod");
        exit();
}


$sql2 ="select isVeilingGesloten from Voorwerp where VoorwerpNummer = ?";
$sth = $dbh->prepare($sql2);
if($sth->execute(array($productid))){
    while ($row = $sth->fetch()) {
       if(!$row['isVeilingGesloten']) {
        try {
            $query = $dbh->prepare($sql);
            $query->execute(array($productid,$bod,$gebruiker,$bodTijd));
            if(isset($vorigeBieder)){
                $sql3 = "INSERT into Meldingen(Bericht,Ontvanger) values(?,?)";
                if( $melding = $dbh->prepare($sql3)){
                 $melding->execute(array('U bent overboden op  <a href= "productPage.php?ID='. $_SESSION['PID'] . '">deze veiling</a> het huidige bod = ' . $bod .   '',$vorigeBieder));
                }
                }
            header("location: $_SERVER[HTTP_REFERER]");
            exit();
        } 
        catch (PDOException $e) {	
        $error = $e->getMessage();
        header("location: $_SERVER[HTTP_REFERER]&error=$error");
        exit();
        }
       }else{
        header("location: $_SERVER[HTTP_REFERER]&error=veilingGesloten");
        exit();
       }
    }
}
}else{
    header("location: $_SERVER[HTTP_REFERER]&error=leeg");
        exit();
}


