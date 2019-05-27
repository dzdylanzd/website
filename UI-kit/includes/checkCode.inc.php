<?php
include "database.php";
session_start();
$maxTijd = 4 * 60 * 60;
$Mailadres = $_SESSION["Email"];
$sql = "SELECT * FROM VerificatiecodeEmail WHERE Mailadres = ?"; 
if ($sth = $dbh->prepare($sql)) {
  if ($sth->execute(array($Mailadres))) {
      while ($code = $sth->fetch()) {
        if($code['VerificatiecodeEmail'] != $_POST['bevestigingscode']){
          header("Location: ../email-Bevestiging.php?error=foutecode");
          exit();
      }
    } 
  }
}
$datTime = $_SESSION["EmailDateTime"];

$date1 = strtotime(date("Y-m-d H:i:s"));
$date2 = strtotime($datTime);



$secondes =  $date1 - $date2 ;
if (empty($_POST['bevestigingscode'])) {
  header("Location: ../email-Bevestiging.php?error=leegveld");
  exit();
}
else if($secondes > $maxTijd ) {
  header("location: ../email-Bevestiging.php?error=codeNietMeerValide");
  exit();
} else {
  header("location: ../registreren.php");

  $_SESSION["gevalideert"] = true;
}
?>