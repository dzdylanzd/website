<?php
require_once('database.php');

$gebruiker = $_POST['gebruikersnaam'];
$_SESSION['GeblokkerdeGebruiker'] = $gebruiker;
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


//zend mail naar geblokeerde gebruiker
      require_once('zendMailAccountGeblokkeerd.php' );



        header("location: ../blokkeerGebruiker.php");
        exit();
    }

} 
catch (PDOException $e) {
  //error melding
    $error = $e->getMessage();
    header("location: ../blokkeerGebruiker.php?error=$error");
    exit();
  }





?>