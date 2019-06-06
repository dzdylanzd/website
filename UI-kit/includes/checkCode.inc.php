<?php
include "database.php";
session_start();

$Mailadres = $_SESSION["Email"];
$sql = "SELECT * FROM VerificatiecodeEmail WHERE Mailadres = ?"; 
if ($sth = $dbh->prepare($sql)) {
  if ($sth->execute(array($Mailadres))) {
      while ($code = $sth->fetch()) {
        //check of de code niet meer valide is
        if($code['DatumEinde']  < date("Y-m-d H:i:s")){
         

          header("Location: ../email-Bevestiging.php?error=codeNietMeerGeldig");
          exit();
        }
        // check of code klopt
        if($code['VerificatiecodeEmail'] != $_POST['bevestigingscode']){
          header("Location: ../email-Bevestiging.php?error=foutecode");
          exit();
      }
    } 
  }
}
//check of veld leeg is
if (empty($_POST['bevestigingscode'])) {
  header("Location: ../email-Bevestiging.php?error=leegveld");
  exit();
} else {
  header("location: ../registreren.php");

  $_SESSION["gevalideert"] = true;
}
