<?php
session_start();
require_once('database.php');

if(isset($_POST['submit'])){

$telefoonNummer = $_POST['telefoonNummer'];
$gebruiker = $_SESSION['userId'];
echo$gebruiker;

$sql = "
insert into Gebruikerstelefoon(Gebruiker,Telefoonnummer)
values(?,?);";

try {
    if ($sth = $dbh->prepare($sql)) {
        if ($sth->execute(array($gebruiker,$telefoonNummer))) {
            header("location: ../telefoonnummerToevoegen.php");
            exit();
        }else if (strlen($telefoonnummer) < 9) {
            header("location: ../telefoonnummerToevoegen.php?error=8");
            exit();
        }
    }
} 
catch (PDOException $e) {	 
    $error = $e->getMessage();
    header("location: ../telefoonnummerToevoegen.php?error=$error");
    exit();
}



}



?>