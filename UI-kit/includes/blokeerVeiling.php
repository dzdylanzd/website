<?php
require_once('database.php');
session_start();
$sql = 'update Voorwerp
Set Geblokkeerd = 1 , IsVeilingGesloten = 1
where VoorwerpNummer = ?';
try {
   
    if ($sth = $dbh->prepare($sql)) {
        if ($sth->execute(array( $_SESSION['PID']))) {
            header("location: $_SERVER[HTTP_REFERER]");
            exit();
        }
    }   
} 
catch (PDOException $e) {	 
$error = $e->getMessage();
header("location: $_SERVER[HTTP_REFERER]&error=$error");
} 


?>