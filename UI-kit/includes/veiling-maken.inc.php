<?php
session_start();
require_once('database.php');

if(isset($_POST['veiling-maken-button'])){

    if(!isset($_POST['Rubriek'])){
        header("location: ../veiling-Maken.php?error=geenCatogorie");
        exit();
    }
    $betalingsinstructies = "";
    $verzendinstructies = "";
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

$foto1 =  $_SESSION['fotos'][0];
$foto2 =  $_SESSION['fotos'][1];
$foto3 =  $_SESSION['fotos'][2];
$foto4 =  $_SESSION['fotos'][3];

if(empty($titel) || empty($staat) || empty($message)|| empty($prijs) || empty($verzendkosten) || empty($plaatsnaam)){
  header("location: ../veiling-Maken.php?error=leeg");
  exit();
}else if($_SESSION['fotos'][0]== "https://via.placeholder.com/150"){
  header("location: ../veiling-Maken.php?error=geenFoto");
  exit();
}


$sql = "select top 1 VoorwerpNummer from Voorwerp order by VoorwerpNummer desc";
if ($sth = $dbh->prepare($sql)) {
  if ($sth->execute(array())) {
    while ($alles = $sth->fetch()) {     
     $VoorwerpNummer =  $alles['VoorwerpNummer'] + 1;
    }
  }
}

$sql = 'insert into Voorwerp(VoorwerpNummer,Titel,Beschrijving,StartPrijs,Betalingswijze, BetalingsInstructie,Plaatsnaam,Land,Looptijd,LooptijdBegin,Verzendkosten,Verkoper,LooptijdEinde,IsVeilingGesloten,Staat,Valuta,VerzendInstructies)
values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$sqlImage = 'insert into Illustraties(VoorwerpNummer,Illustratiefile)
values(?,?)';
$sqlThumbnail = 'insert into Thumbnail(VoorwerpNummer,Thumbnailfile)
values(?,?)';
$sqlRubriek = 'insert into VoorwerpInRubriek(Voorwerp,RubriekOpLaagsteNiveau)
values(?,?)';

try {
  if ($sth = $dbh->prepare($sql)) {
    $sth->execute(array( $VoorwerpNummer,$titel,$message,$prijs,$betalingswijze,$betalingsinstructies,$plaatsnaam,$land,$lengte,$date,$verzendkosten,$_SESSION['userId'],$eindDatum,0,$staat,$valuta,$verzendinstructies));
    
  }
  if ($sth = $dbh->prepare($sqlImage)) {
    for ($i = 0; $i <= 3; $i++) {
      if( $_SESSION['fotos'][$i] != 'https://via.placeholder.com/150')
      $sth->execute(array($VoorwerpNummer, $_SESSION['fotos'][$i]));
  }
    
  }
  if ($sth = $dbh->prepare($sqlThumbnail)) {
    $sth->execute(array($VoorwerpNummer,$_SESSION['fotos'][0] ));
    
  }
  if ($sth = $dbh->prepare($sqlRubriek)) {
    $sth->execute(array($VoorwerpNummer,$rubriek ));
    
  }
  $_SESSION['fotos'] = array("https://via.placeholder.com/150", "https://via.placeholder.com/150", "https://via.placeholder.com/150", "https://via.placeholder.com/150");
  $_SESSION['index'] = 0;
  header("location: ../mijn-veilingen.php");
  exit();
} 
catch (PDOException $e) {	 
  $error = $e->getMessage();
  header("location: ../veiling-Maken.php?error=$error");
  exit();
}





















}

