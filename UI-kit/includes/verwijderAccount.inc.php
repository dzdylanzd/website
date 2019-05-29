<?php
session_start();
require_once('database.php');
$gebruiker =  $_SESSION['userId'];
$email = $_SESSION['userUid'];
$sql = 'delete Gebruiker where Gebruikersnaam = ?';
$sqlUpdates = "UPDATE Voorwerp
SET Koper = 'Onbekend'
WHERE Koper = ?

UPDATE Voorwerp
SET Verkoper = 'Onbekend'
WHERE Verkoper = ?

UPDATE Bod
SET Gebruiker = 'Onbekend'
WHERE Gebruiker = ?

DELETE FROM VerificatiecodeEmail
WHERE Mailadres = ?";

if ($sth = $dbh->prepare($sqlUpdates)) {
    if ($sth->execute(array($gebruiker,$gebruiker,$gebruiker,$email))) {
    }
}

$gebruiker =  $_SESSION['userId'];

if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruiker))) {
        header("location: logout.php");
        exit();
    }
}
