<?php
require_once('database.php');

$gebruiker = $_POST['gebruikersnaam'];

$sql = 'update Gebruiker 
set Geblokeerd = 1 
where Gebruikersnaam = ?'; 

try {
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array($gebruiker))) {
        header("location: ../blokkeerGebruiker.php");
        exit();
    }

} 
catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ../blokkeerGebruiker.php?error=dezeGebruikerBestaatNiet");
    exit();
  }


?>