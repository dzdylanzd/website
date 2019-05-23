<?php
session_start();
require_once('database.php');

if(isset($_POST['veiling-maken-button'])){

    if(!isset($_POST['Rubriek'])){
        header("location: ../veiling-Maken.php?error=geenCatogorie");
        exit();
    }
$rubriek = $_POST['Rubriek'];
$titel = $_POST['titel'];
$staat = $_POST['staat'];
$message = $_POST['message'];
$lengte = $_POST['lengte'];
$valuta = $_POST['valuta'];
$prijs = $_POST['prijs'];
$verzendkosten = $_POST['verzendkosten'];
$verzendinstructies = $_POST['verzendinstructies'];
$betalingswijze = $_POST['betalingswijze'];
$betalingsinstructies = $_POST['betalingsinstructies'];
$plaatsnaam = $_POST['plaatsnaam'];
$land = $_POST['land'];
$date = date("Y-m-d H:i:s");
$eindDatum = date("Y-m-d H:i:s", strtotime($date. " + $lengte days"));

$foto1 = str_replace("uploud/","", $_SESSION['fotos'][0]);
$foto2 = str_replace("uploud/","", $_SESSION['fotos'][1]);
$foto3 = str_replace("uploud/","", $_SESSION['fotos'][2]);
$foto4 = str_replace("uploud/","", $_SESSION['fotos'][3]);


$sql = "select top 1 VoorwerpNummer from Voorwerp order by VoorwerpNummer desc";
if ($sth = $dbh->prepare($sql)) {
  if ($sth->execute(array())) {
    while ($alles = $sth->fetch()) {     
     $VoorwerpNummer =  $alles['VoorwerpNummer'] + 1;
    }
  }
}

$sql = 'insert into Voorwerp(VoorwerpNummer,Titel,Beschrijving,StartPrijs,Betalingswijze, BetalingsInstructie,Plaatsnaam,Land,Looptijd,LooptijdBegin,Verzendkosten,Verkoper,LooptijdEinde,IsVeilingGesloten,Staat,Valuta)
value(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$sqlImage = 'insert into Illustraties(VoorwerpNummer,Illustratiefile)
value(?,?),(?,?),(?,?),(?,?)';
$sqlThumbnail = 'insert into Thumbnail(VoorwerpNummer,Thumbnailfile)
value(?,?)';

try {
  if ($sth = $dbh->prepare($sql)) {
    $sth->execute(array( $VoorwerpNummer,$titel,$message,$prijs,$betalingswijze,$betalingsinstructie,$plaatsnaam,$land,$lengte,$date,$verzendkosten,$_SESSION['userId'],$eindDatum,0,$staat,$valuta));
    
  }
  if ($sth = $dbh->prepare($sqlImage)) {
    $sth->execute(array($VoorwerpNummer,$foto1,$VoorwerpNummer,$foto2,$VoorwerpNummer,$foto3,$VoorwerpNummer,$foto4 ));
    
  }
  if ($sth = $dbh->prepare($sqlThumbnail)) {
    $sth->execute(array($VoorwerpNummer,$foto1 ));
    
  }
} 
catch (PDOException $e) {	 
  $error = $e->getMessage();
  header("location: ../veiling-maken?error=$error");
  exit();
}





















}

