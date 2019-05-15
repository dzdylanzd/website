<?php

if(isset($_POST['login-submit'])){
    require_once('database.php');

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];

    if (empty($gebruikersnaam) || empty($password)) {
       echo"<script> history.go(-1); </script> ";
        exit();
    }
    else {
     $sql = "SELECT * from Gebruiker where Gebruikersnaam = ? " ;
     if (!$query = $dbh->prepare($sql)){
        history.go(-1);
        exit();
        }
        else {
            $query = $dbh->prepare($sql);
      $query->execute(array($gebruikersnaam));
      if($row = $query->fetch()) {
        $pwdCheck = password_verify($password,$row['Wachtwoord']);
        if ($pwdCheck == false) {
            history.go(-1);
        exit();
        }
        else if($pwdCheck == true){
session_start();
$_SESSION['userId'] = $row['idUsers'];
$_SESSION['userUid'] = $row['UidUsers'];
history.go(-1);
            exit();
           }
           else {
            history.go(-1);
            exit();
           }
    } 
    else {
        history.go(-1);
        exit();
    }
        }
    }

}
else {
    history.go(-1);
    exit();
}