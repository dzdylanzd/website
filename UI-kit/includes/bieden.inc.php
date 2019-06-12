<?php


session_start();
require_once('database.php');


$productid =  $_SESSION['PID'];
$bod =  $_POST['bod'];
$gebruiker =  $_SESSION['userId'];
$bodTijd = date("Y-m-d H:i:s");


$sql = "SELECT top 1 * from Bod where Voorwerp = ? order by BodBedrag desc";
$sql2 = "SELECT StartPrijs FROM Voorwerp WHERE VoorwerpNummer = ?";
if ($sth = $dbh->prepare($sql2)) {
    if ($sth->execute(array($_GET["ID"]))) {
        while ($row = $sth->fetch()) {
            $minimumVerhoging = $row['StartPrijs'];
            $bod =  $minimumVerhoging;
        }
    }
}

// haal minimum bod op
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($_GET["ID"]))) {
        while ($row = $sth->fetch()) {
            $bod = $row['BodBedrag'];
            if ($bod <= 50) {
                $minimumVerhoging = $row['BodBedrag'] + 0.5;
            } else if ($bod > 50 && $bod <= 500) {
                $minimumVerhoging = $row['BodBedrag'] + 1;
            } else if ($bod > 500 && $bod <= 1000) {
                $minimumVerhoging =  $row['BodBedrag'] + 5;
            } else if ($bod > 1000 && $bod <= 5000) {
                $minimumVerhoging =  $bod + 10;
            } else {
                $minimumVerhoging =  $row['BodBedrag'] + 50;
            }
        }
    }
}
$_SESSION['minimumVerhoging'] = $minimumVerhoging;




//als je niet bent ingelogd mag je niet bieden
if (!isset($_SESSION['userId'])) {
    header("location: $_SERVER[HTTP_REFERER]&error=notLoggedIn");
    exit();
} else if (!empty($bod)) {
    //haal het vorige bod op

    $sqlVorigeBod = 'SELECT top 1 * from bod where Voorwerp = ? and BodDagTijd not in (
        select top 1 BodDagTijd from bod where Voorwerp = ? order by BodDagTijd desc
        )order by BodDagTijd desc';
    if ($sth = $dbh->prepare($sqlVorigeBod)) {
        if ($sth->execute(array($productid, $productid))) {
            while ($row = $sth->fetch()) {
                $vorigeBieder = $row['Gebruiker'];
                $vorigeBod = $row['BodBedrag'];
            }
        }
    }



    $sql = 'insert into bod(Voorwerp,BodBedrag,Gebruiker,BodDagTijd)
Values (?,?,?,?)';

    // bepaald de miniumumVerhoging

    //het bod moet groter zijn dan de minimumVerhoging
    if ($bod <  $_SESSION['minimumVerhoging']) {
        header("location: $_SERVER[HTTP_REFERER]&error=teLaagBod");
        exit();
    }

    // haalt op of de vielig al dicht is
    $sql2 = "select isVeilingGesloten from Voorwerp where VoorwerpNummer = ?";
    $sth = $dbh->prepare($sql2);
    if ($sth->execute(array($productid))) {
        while ($row = $sth->fetch()) {
            if (!$row['isVeilingGesloten']) {
                try {
                    // zet bod in database en stuur melding aar vorige bieder
                    $query = $dbh->prepare($sql);
                    $query->execute(array($productid, $bod, $gebruiker, $bodTijd));
                    if (isset($vorigeBieder)) {
                        $sql3 = "INSERT into Meldingen(Bericht,Ontvanger) values(?,?)";
                        if ($melding = $dbh->prepare($sql3)) {
                            $melding->execute(array('U bent overboden op  <a href= "productPage.php?ID=' . $_SESSION['PID'] . '">deze veiling</a> het huidige bod = ' . $bod .   '', $vorigeBieder));
                        }
                    }
                    header("location: $_SERVER[HTTP_REFERER]");
                    exit();
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                    header("location: $_SERVER[HTTP_REFERER]&error=$error");
                    exit();
                }
            } else {
                header("location: $_SERVER[HTTP_REFERER]&error=veilingGesloten");
                exit();
            }
        }
    }
} else {
    header("location: $_SERVER[HTTP_REFERER]&error=leeg");
    exit();
}
