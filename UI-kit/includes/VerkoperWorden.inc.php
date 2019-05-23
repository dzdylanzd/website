<?php
session_start();
if (isset($_POST['verkoopaccountAanvragen'])) {
    require_once('database.php');

    $Gebruiksernaam = $_SESSION['userId'];

    if (isset($_POST['creditcard'])) {
        $creditcard = $_POST['creditcard'];
        $identificatieMethode = "Creditcard";
        $sql = "INSERT  INTO Verkoper( Gebruiker, ControleOptie, Creditcard) VALUES (?, ?, ?)";
        $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
        try { $query = $dbh->prepare($sql2);
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
    } else if (isset($_POST['bank']) && isset($_POST['rekeningnummer'])) {
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
     }else{
        header("location: ../index.php");
        exit();
    }


    header("location: ../VerkoperWorden.php?error=leeg");
    exit();
}

