<?php
session_start();
if (isset($_POST['verkoopaccountAanvragen'])) {
    require_once('database.php');

    $Gebruiksernaam = $_SESSION['userId'];


    // als je gekozen hebt voor creditcard
    if (isset($_POST['creditcard'])) {
        // check voor leeg veld
        if (empty($_POST['creditcard'])) {
            header("location: ../VerkoperWorden.php?errorVerkoper=leegVeld");
            exit();
        }
        // check voor lengte creditcard
        else if (strlen($_POST['creditcard']) != 16) {
            header("location: ../VerkoperWorden.php?errorVerkoper=onjuisteCreditcard");
            exit();
        }
        // voeg toe aan verkoper en verander accounttype
        $creditcard = $_POST['creditcard'];
        $identificatieMethode = "Creditcard";
        $sql = "INSERT  INTO Verkoper( Gebruiker, ControleOptie, Creditcard) VALUES (?, ?, ?)";
        $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
        try {
            $query = $dbh->prepare($sql2);
            if ($query->execute(array("V", $Gebruiksernaam))) {
                $query = $dbh->prepare($sql);
                if ($query->execute(array($Gebruiksernaam, $identificatieMethode, $creditcard))) {
                    header("location: ../index.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            header("location: ../VerkoperWorden.php?error=$error");
            exit();
        }
    }
    // als je gekozen hebt voor mail
    else if (isset($_POST['bank']) && isset($_POST['rekeningnummer'])) {
// check voor lege velden
        if (empty($_POST['bank']) || empty($_POST['rekeningnummer'])) {
            header("location: ../VerkoperWorden.php?errorVerkoper=leegVeld");
            exit();
        }
// voeg toe aan verkoper en verander accounttype
        $bank = $_POST['bank'];
        $rekeningnummer = $_POST['rekeningnummer'];
        $identificatieMethode = "Post";
        $sql2 = "INSERT  INTO Verkoper( Gebruiker, ControleOptie, Bank, Bankrekening) VALUES (?, ?, ?, ?)";
        $sql1 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
        try {
            $query = $dbh->prepare($sql1);
            if ($query->execute(array("A", $Gebruiksernaam))) {
                $query = $dbh->prepare($sql2);
                if ($query->execute(array($Gebruiksernaam, $identificatieMethode, $bank, $rekeningnummer))) {
                    // ga naar zend mail
                    header("location: zendActivatieMail.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            header("location: ../VerkoperWorden.php?error=$error");
            exit();
        }
    } else {
        header("location: ../index.php");
        exit();
    }
}
