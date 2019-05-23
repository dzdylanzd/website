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

$sql = 'insert into bod(Voorwerp,BodBedrag,Gebruiker,BodDagTijd)
Values (?,?,?,?)';

$sql2 ="select isVeilingGesloten from Voorwerp where VoorwerpNummer = ?";
$sth = $dbh->prepare($sql2);
if($sth->execute(array($productid))){
    while ($row = $sth->fetch()) {
       if(!$row['isVeilingGesloten']) {
        try {
            $query = $dbh->prepare($sql);
            $query->execute(array($productid,$bod,$gebruiker,$bodTijd));
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


