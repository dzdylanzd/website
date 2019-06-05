<?php
require_once('database.php');

$gebruiker = $_POST['gebruikersnaam'];
if(issest($_POST('GebruikerDeblokkeren'))){
$BlokkeerStatus = 0;
}else if(issest($_POST('GebruikerBlokkeren'))){
  
  $BlokkeerStatus = 1;

}
$sql = 'update Gebruiker 
set Geblokeerd = ? 
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
    header("location: ../blokkeerGebruiker.php?error=dezeGebruikerBestaatNiet");
    exit();
  }


?>