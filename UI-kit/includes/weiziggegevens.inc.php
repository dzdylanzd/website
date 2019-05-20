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
$oudWachtwoord =  $_POST['oudWachtwoord'];
$Wachtwoord = $_POST['wachtwoord'];
$WachtwoordHerhaal = $_POST['bevestigWachtwoord'];
$voorkeur1 =  $_POST['voorkeur1'];
$voorkeur2 =  $_POST['voorkeur2'];
$voorkeur3 =  $_POST['voorkeur3'];
$gebruikersnaam = $_SESSION['userId'];

if (!empty($oudWachtwoord) && !empty($Wachtwoord) && !empty($WachtwoordHerhaal)) {
    $sql = "SELECT Wachtwoord FROM Gebruiker WHERE Gebruikersnaam = ?";
    if ($query = $dbh->prepare($sql)) {
        if ($query->execute(array($gebruikersnaam))) {

            while ($alles = $query->fetch()) {

                $pwdCheck = password_verify($oudWachtwoord, $alles['Wachtwoord']);
                if (!$pwdCheck) {
                    header("location: ../index.php?error=wachtwoordKomtNietOvereen");
                    exit();
                }
            }
        }
    }


    if (!preg_match('/[A-Z]/', $Wachtwoord)) {
        header("location: ../wijzigen-gegevens.php?error=9");
        exit();
    } else if (!preg_match('~[0-9]~', $Wachtwoord)) {
        header("location: ../wijzigen-gegevens.php?error=10");
        exit();
    } else if (strlen($Wachtwoord) < 7) {
        header("location: ../wijzigen-gegevens.php?error=8");
        exit();
    } else {
        if ($pwdCheck) {
            if ($Wachtwoord == $WachtwoordHerhaal) {
                $hashedPwd = password_hash($Wachtwoord, PASSWORD_DEFAULT);
                $sql = "UPDATE Gebruiker SET Wachtwoord = ? WHERE Gebruikersnaam = ?";
                if ($query = $dbh->prepare($sql)) {
                    $query->execute(array($hashedPwd, $gebruikersnaam));
                }
            }
        }
    }
}








if (empty($voornaam) || empty($Achternaam) || empty($StraatHuisnummer) || empty($Postcode) || empty($Plaatsnaam) || empty($Land) || empty($Geboortedag) || empty($Mailadres)){
    header("location: ../wijzigen-gegevens.php?error=1");
    exit();
} else if (($voorkeur1 == $voorkeur2 || $voorkeur1 == $voorkeur3) || ($voorkeur2 == $voorkeur1 || $voorkeur2 == $voorkeur3) || ($voorkeur3 == $voorkeur1 || $voorkeur3 == $voorkeur2)) {
    header("location: ../wijzigen-gegevens.php?error=11");
    exit();
} else if (!filter_var($Mailadres, FILTER_VALIDATE_EMAIL)) {
    header("location: ../wijzigen-gegevens.php?error=2");
    exit();
  } else {
    $sql = 'UPDATE Gebruiker
    SET Voornaam = ? , Achternaam = ?, Adresregel1 = ?, Postcode = ?,Plaatsnaam = ?,Land = ?,Mailadres = ?, Geboortedatum = ?
    WHERE Gebruikersnaam = ?';
    $sql2 = "delete from voorkeur where gebruikersnaam = ?";
    $sql3 = "INSERT into voorkeur(categorie,gebruikersnaam) values (?,?),(?,?),(?,?)";
    if ($sth = $dbh->prepare($sql)) {
        $_SESSION['userUid'] = $Mailadres;
        if ($sth->execute(array($voornaam, $Achternaam, $StraatHuisnummer, $Postcode, $Plaatsnaam, $Land,$Mailadres,  $Geboortedag, $gebruikersnaam))) {
            if ($sth2 = $dbh->prepare($sql2)) {
                if ($sth2->execute(array($gebruikersnaam))) {
                    if ($sth3 = $dbh->prepare($sql3)) {
                        if ($sth3->execute(array($voorkeur1, $gebruikersnaam, $voorkeur2, $gebruikersnaam, $voorkeur3, $gebruikersnaam))) {
                            header("location: ../index.php");
                            exit();
                        } else {
                            header("location: ../wijzigen-gegevens.php?error=7");
                            exit();
                        }
                    }
                } else {
                    header("location: ../wijzigen-gegevens.php?error=7");
                    exit();
                }
            }
        } else {
            header("location: ../wijzigen-gegevens.php?error=7");
            exit();
        }
    } else {
        header("location: ../wijzigen-gegevens.php?error=7");
        exit();
    }
}
