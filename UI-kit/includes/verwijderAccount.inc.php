<?php
session_start();
require_once('database.php');
$gebruiker =  $_SESSION['userId'];
$email = $_SESSION['userUid'];
$sql = 'delete Gebruiker where Gebruikersnaam = ?';
$sqlUpdates = "
UPDATE Voorwerp
set IsVeilingGesloten = 1
where Verkoper = ?

UPDATE Voorwerp
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
// verwijder en update tabbelen om gebruiker te verwijderen
if ($sth = $dbh->prepare($sqlUpdates)) {
    if ($sth->execute(array($gebruiker,$gebruiker,$gebruiker,$gebruiker,$email))) {
    }
}

$gebruiker =  $_SESSION['userId'];
// verwijder gebruiker
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruiker))) {
        header("location: logout.php");
        exit();
    }
}
