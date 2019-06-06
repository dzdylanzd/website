<?php
session_start();
if (isset($_POST['verkoopaccountAanvragen'])) {
    require_once('database.php');

    $Gebruiksernaam = $_SESSION['userId'];



    if (isset($_POST['creditcard'])) {

        if (empty($_POST['creditcard'])) {
            header("location: ../VerkoperWorden.php?errorVerkoper=leegVeld");
            exit();
        } else if (strlen($_POST['creditcard']) != 16) {
            header("location: ../VerkoperWorden.php?errorVerkoper=onjuisteCreditcard");
            exit();
        }

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
            $rekeningnummer = $_POST['rekeningnummer'];
        } catch (PDOException $e) {
            $error = $e->getMessage();
            header("location: ../VerkoperWorden.php?error=$error");
            exit();
        }
    } else if (isset($_POST['bank']) && isset($_POST['rekeningnummer'])) {

        if (empty($_POST['bank']) || empty($rekeningnummer)) {
            header("location: ../VerkoperWorden.php?errorVerkoper=leegVeld");
            exit();
        } else if (strlen($rekeningnummer) < 16) {
            header("location: ../VerkoperWorden.php?errorVerkoper=teKortBank");
            exit();
        }
    }

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
