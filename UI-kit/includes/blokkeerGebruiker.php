<?php
require_once('database.php');

$gebruiker = $_POST['gebruikersnaam'];

if(isset($_POST['GebruikerDeblokkeren'])){
$BlokkeerStatus = 0;
}else if(isset($_POST['GebruikerBlokkeren'])){
  
  $BlokkeerStatus = 1;

}
$sql = 'update Gebruiker 
set Geblokkeerd = ? 
where Gebruikersnaam = ?'; 

try {
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array( $BlokkeerStatus,$gebruiker))) {
        header("location: ../blokkeerGebruiker.php");
        exit();
    }

} 
catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ../blokkeerGebruiker.php?error=$error");
    exit();
  }


  // hidde hier moet mail van blokeer gebruiker


?>