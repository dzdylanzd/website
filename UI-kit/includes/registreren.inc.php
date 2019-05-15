<?php
session_start();
if (isset($_POST['bevestigings-button']))
{
    require_once('database.php');

    
    // $username = $_POST['uid'];
    // $email = $_POST['mail'];
    // $password = $_POST{"pwd"};
    // $passwordRepeat = $_POST['pwd-repeat'];

    $Gebruiksernaam = $_POST['gebruikersnaam'];
    $voornaam = $_POST['voornaam'];
    $Achternaam = $_POST{"achternaam"};
    $StraatHuisnummer = $_POST['adres1'];
    $Postcode = $_POST['postcode'];
    $Plaatsnaam = $_POST['plaats'];
    $Land = $_POST['land'];
    $Geboortedag = $_POST['geboortedatum'];
    $Mailadress = $_SESSION["Email"];
    $Wachtwoord = $_POST['wachtwoord'];
    $WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
    $VraagNummer = $_POST['bevestigingsvraag'];
    $Antwoordtekst = $_POST['antwoord'];


    //fout meldingen
    //check voor lege velden
    if (empty($Gebruiksernaam)|| empty($voornaam)|| empty($Achternaam)|| empty( $StraatHuisnummer)|| empty($Postcode) || empty($Plaatsnaam) || empty($Land) || empty($Geboortedag) || empty($Mailadress) || empty($Wachtwoord) || empty( $WachtwoordHerhaal) || empty($VraagNummer) ||  empty($Antwoordtekst)   ) 
    {
        header("location: ../registreren.php?error=1");
        exit();

    } 
    else if (!filter_var($Mailadress,FILTER_VALIDATE_EMAIL)) 
        {
          header("location: ../registreren.php?error=2");
          exit();
        exit();
        } 
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$Gebruiksernaam)){
      header("location: ../registreren.php?error=6");
        exit();
        } 
    else if($Wachtwoord !== $WachtwoordHerhaal){
      header("location: ../registreren.php?error=4");
        exit();
        } 
    
    else {

      $sql = "SELECT Gebruikersnaam from Gebruiker where Gebruikersnaam = ?";
      if (!$query = $dbh->prepare($sql)){
        header("location: ../registreren.php?error=7");
        exit();
      } 
    
    else{
        $query = $dbh->prepare($sql);
      $query->execute(array($Gebruiksernaam));
      if($query->fetch()) {
        header("location: ../registreren.php?error=3");
        exit();
        } 
        else {
            

                $sql = "INSERT Gebruiker(Gebruikersnaam,Voornaam,Achternaam,Adresregel1,Postcode,Plaatsnaam,Land,Geboortedatum,Mailadres,Wachtwoord,Vraagnummer,AntwoordTekst,IsAccountVerkoper,DatumMakenAccount) values( ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                if (!$query = $dbh->prepare($sql)){
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
                // $Mailadress = $_SESSION["Email"];
                // $Wachtwoord = $_POST['wachtwoord'];
                // $WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
                // $VraagNummer = $_POST['bevestigingsvraag'];
                // $Antwoordtekst = $_POST['antwoord'];
              
              else{
                $hashedPwd = password_hash($Wachtwoord, PASSWORD_DEFAULT);
                var_dump($hashedPwd);
                Echo " $hashedPwd";
                if($query = $dbh->prepare($sql)){
                  echo"jan";
                }
                $query->execute(array($Gebruiksernaam,$voornaam,$Achternaam,$StraatHuisnummer,$Postcode,$Plaatsnaam,$Land,$Geboortedag,$Mailadress, $hashedPwd,2,$Antwoordtekst,0,date("Y-m-d H:i:s")));
                header("location: ../bezoeker_login.php?signup=success=");
                  exit();
                                            
                }
            }

        }

    }

}

 else 
{
    header("location: ../index.php");
    exit();
}
