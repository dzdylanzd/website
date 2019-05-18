<?php
session_start();
if (isset($_POST['bevestigings-button'])) {
  require_once('database.php');


  // $username = $_POST['uid'];
  // $email = $_POST['mail'];
  // $password = $_POST{"pwd"};
  // $passwordRepeat = $_POST['pwd-repeat'];

  $Gebruiksernaam = $_POST['gebruikersnaam'];
  $voornaam = $_POST['voornaam'];
  $Achternaam = $_POST["achternaam"];
  $StraatHuisnummer = $_POST['adres1'];
  $Postcode = $_POST['postcode'];
  $Plaatsnaam = $_POST['plaats'];
  $Land = $_POST['land'];
  $Geboortedag = $_POST['geboortedatum'];
  $Mailadres = $_SESSION["Email"];
  $Wachtwoord = $_POST['wachtwoord'];
  $WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
  $VraagNummer = $_POST['bevestigingsvraag'];
  $Antwoordtekst = $_POST['antwoord'];
  $voorkeur1 =  $_POST['voorkeur1'];
  $voorkeur2 =  $_POST['voorkeur2'];
  $voorkeur3 =  $_POST['voorkeur3'];



  //fout meldingen
  //check voor lege velden
  if (empty($Gebruiksernaam) || empty($voornaam) || empty($Achternaam) || empty($StraatHuisnummer) || empty($Postcode) || empty($Plaatsnaam) || empty($Land) || empty($Geboortedag) || empty($Mailadres) || empty($Wachtwoord) || empty($WachtwoordHerhaal) || empty($VraagNummer) ||  empty($Antwoordtekst)) {
    header("location: ../registreren.php?error=1");
    exit();
  } else if (!filter_var($Mailadres, FILTER_VALIDATE_EMAIL)) {
    header("location: ../registreren.php?error=2");
    exit();
    exit();
  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $Gebruiksernaam)) {
    header("location: ../registreren.php?error=6");
    exit();
  } else if (strlen($Wachtwoord) < 7) {
    header("location: ../registreren.php?error=8");
    exit();
  } else if (strlen($Gebruiksernaam) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($voornaam) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Achternaam) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($StraatHuisnummer) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Postcode) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Plaatsnaam) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Mailadres) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Wachtwoord) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($WachtwoordHerhaal) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (strlen($Antwoordtekst) > 30) {
    header("location: ../registreren.php?error=12");
    exit();
  } else if (!preg_match('/[A-Z]/', $Wachtwoord)) {
    header("location: ../registreren.php?error=9");
    exit();
  } else if (!preg_match('~[0-9]~', $Wachtwoord)) {
    header("location: ../registreren.php?error=10");
    exit();
  } else if ($Wachtwoord !== $WachtwoordHerhaal) {
    header("location: ../registreren.php?error=4");
    exit();
  } else if (($voorkeur1 == $voorkeur2 || $voorkeur1 == $voorkeur3) || ($voorkeur2 == $voorkeur1 || $voorkeur2 == $voorkeur3) || ($voorkeur3 == $voorkeur1 || $voorkeur3 == $voorkeur2)) {
    header("location: ../registreren.php?error=11");
    exit();
  } else {

        $sql = "SELECT Gebruikersnaam from Gebruiker where Gebruikersnaam = ?";
        if (!$query = $dbh->prepare($sql)) {
          header("location: ../registreren.php?error=7");
          exit();
        } else {
          $query = $dbh->prepare($sql);
          $query->execute(array($Gebruiksernaam));
          if ($query->fetch()) {
            header("location: ../registreren.php?error=3");
            exit();
          } else {


            $sql = "INSERT Gebruiker(Gebruikersnaam,Voornaam,Achternaam,Adresregel1,Postcode,Plaatsnaam,Land,Geboortedatum,Mailadres,Wachtwoord,Vraagnummer,AntwoordTekst,IsAccountVerkoper,DatumMakenAccount) values( ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            if (!$query = $dbh->prepare($sql)) {
              header("location: ../registreren.php?error=7");
              exit();
            }

            // $Gebruiksernaam = $_POST['gebruikersnaam'];
            // $voornaam = $_POST['voornaam'];
            // $Achternaam = $_POST{"achternaam"};
            // $StraatHuisnummer = $_POST['adres1'];
            // $Postcode = $_POST['postcode'];
            // $Plaatsnaam = $_POST['plaats'];
            // $Land = $_POST['land'];
            // $Geboortedag = $_POST['geboortedatum'];
            // $Mailadres = $_SESSION["Email"];
            // $Wachtwoord = $_POST['wachtwoord'];
            // $WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
            // $VraagNummer = $_POST['bevestigingsvraag'];
            // $Antwoordtekst = $_POST['antwoord'];

            else {
              $hashedPwd = password_hash($Wachtwoord, PASSWORD_DEFAULT);
              $hashedAnswer = password_hash($Antwoordtekst, PASSWORD_DEFAULT);

              if ($query = $dbh->prepare($sql)) { }
              $query->execute(array($Gebruiksernaam, $voornaam, $Achternaam, $StraatHuisnummer, $Postcode, $Plaatsnaam, $Land, $Geboortedag, $Mailadres, $hashedPwd, $VraagNummer, $hashedAnswer, 0, date("Y-m-d H:i:s")));

              $sql = "INSERT into voorkeur(catogorie,gebruikersnaam) values (?,?),(?,?),(?,?)";
              if ($query = $dbh->prepare($sql)) {
                $query->execute(array($voorkeur1, $Gebruiksernaam, $voorkeur2, $Gebruiksernaam, $voorkeur3, $Gebruiksernaam));
              }
              $_SESSION['userId'] = $Gebruiksernaam;
              $_SESSION['userUid'] = $Mailadres;
              header("location: ../index.php");
              exit();
            }
          }
        }
      }
}else {
  header("location: ../index.php");
  exit();
}
