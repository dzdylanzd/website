<?php

if(isset($_POST['login-submit'])){
    require_once('database.php');

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];

    if (empty($gebruikersnaam) || empty($password)) {
        header("Location: ../bezoeker_login.php?error=emptyfields");
        exit();
    }
    else {
     $sql = "SELECT * from Gebruiker where Gebruikersnaam = ? " ;
     if (!$query = $dbh->prepare($sql)){
         header("location: ../bezoeker_login.php?error=sqlerror");
        exit();
        }
        else {
            $query = $dbh->prepare($sql);
      $query->execute(array($gebruikersnaam,$gebruikersnaam));
      if($row = $query->fetch()) {
        $pwdCheck = password_verify($password,$row['pwdUsers']);
        if ($pwdCheck == false) {
            header("location: ../bezoeker_login.php?error=wrongpwd");
        exit();
        }
        else if($pwdCheck == true){
session_start();
$_SESSION['userId'] = $row['idUsers'];
$_SESSION['userUid'] = $row['UidUsers'];
header("location: ../bezoeker_login.php?login=success");
            exit();
           }
           else {
            header("location: ../bezoeker_login.php?error=wrongpwd");
            exit();
           }
    } 
    else {
        header("location: ../bezoeker_login.php?error=nouser");
        exit();
    }
        }
    }

}
else {
    header("location: ../bezoeker_login.php?error=test");
    exit();
}