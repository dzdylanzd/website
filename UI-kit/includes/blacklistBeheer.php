<?php
require_once('database.php');
$sqlT = 'insert into Blacklist
values(?)';
$sqlV = 'delete from Blacklist where item = ?';
if(isset($_POST['blacklistItemT'])){
$item = $_POST['blacklistItemT'];
if(empty($_POST['blacklistItemT'])){
    header("location: ../beheerderLogging.php?error=veldLeeg");
    exit();
}
try {
    $sth = $dbh->prepare($sqlT);
    if ($sth->execute(array($item))) {
        header("location: ../beheerderLogging.php");
        exit();
    }

} 
catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ../beheerderLogging.php?error=$error");
    exit();
  }
}


if(isset($_POST['blacklistItemV'])){
    $item = $_POST['blacklistItemV'];
    if(empty($_POST['blacklistItemV'])){
        header("location: ../beheerderLogging.php?error=veldLeeg");
        exit();
    }
    try {
        $sth = $dbh->prepare($sqlV);
        if ($sth->execute(array($item))) {
            header("location: ../beheerderLogging.php");
            exit();
        }
    
    } 
    catch (PDOException $e) {
        $error = $e->getMessage();
        header("location: ../beheerderLogging.php?error=$error");
        exit();
      }
}


?>