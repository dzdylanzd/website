<?php
session_start();
include('database.php');
  $voornaam = $_POST['voornaam'];
  $Achternaam = $_POST["achternaam"];
  $StraatHuisnummer = $_POST['adres1'];
  $Postcode = $_POST['postcode'];
  $Plaatsnaam = $_POST['plaats'];
  $Land = $_POST['land'];
  $Geboortedag = $_POST['geboortedatum'];
 $Mailadres = $_POST['Email'];
  $Wachtwoord = $_POST['wachtwoord'];
  $WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
  $voorkeur1 =  $_POST['voorkeur1'];
  $voorkeur2 =  $_POST['voorkeur2'];
  $voorkeur3 =  $_POST['voorkeur3'];
  $gebruikersnaam = $_SESSION['userId'];

  if( empty($voornaam) || empty($Achternaam) || empty($StraatHuisnummer) || empty($Postcode) || empty($Plaatsnaam) || empty($Land) || empty($Geboortedag) ){
    header("location: ../index.php?error=1");
    exit();
  } else if (($voorkeur1 == $voorkeur2 || $voorkeur1 == $voorkeur3) || ($voorkeur2 == $voorkeur1 || $voorkeur2 == $voorkeur3) || ($voorkeur3 == $voorkeur1 || $voorkeur3 == $voorkeur2)) {
    header("location: ../index.php?error=11");
    exit();
  }else{
    $sql = 'UPDATE Gebruiker
    SET Voornaam = ? , Achternaam = ?, Adresregel1 = ?, Postcode = ?,Plaatsnaam = ?,Land = ?,Geboortedatum = ?,Mailadres = ?
    WHERE Gebruikersnaam = ?';
    $sql2 = "delete * from voorkeur where gebruikersnaam = ?";
    if ($sth = $dbh->prepare($sql)) {
        if ($sth->execute(array($voornaam,$Achternaam,$StraatHuisnummer,$Postcode,$Plaatsnaam,$Land,$Geboortedag,$Mailadres, $gebruikersnaam))) {
            header("location: ../index.php");
            exit();
        }else{
            header("location: ../index.php?error=7");
            exit(); 
        }
    }else{
        header("location: ../index.php?error=7");
        exit(); 
    }
  }