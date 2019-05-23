<?php

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


$sql = "select top 1 VoorwerpNummer from Voorwerp order by VoorwerpNummer desc";
if ($sth = $dbh->prepare($sql)) {
  if ($sth->execute(array())) {
    while ($alles = $sth->fetch()) {     
     $VoorwerpNummer =  $alles['VoorwerpNummer'] + 1;
    }
  }
}















}

