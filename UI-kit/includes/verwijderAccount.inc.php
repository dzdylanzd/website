<?php
session_start();
require_once('database.php');
$sql = 'delete Gebruiker where Gebruikersnaam = ?';

$gebruiker =  $_SESSION['userId'];

if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($gebruiker))) {
        header("location: logout.php");
        exit();
    }
}
