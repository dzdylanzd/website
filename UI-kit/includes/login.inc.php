<?php

if (isset($_POST['login-submit'])) {
    require_once('database.php');

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];
//kijk of velden leeg zijn
    if (empty($gebruikersnaam) || empty($password)) {
        if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
            header("location: $_SERVER[HTTP_REFERER]&errorLogin=leeg");
            exit();
        } else {
            header("location: $_SERVER[HTTP_REFERER]?errorLogin=leeg");
            exit();
        }
        exit();
    } else {

        //check of gebruiker bestaat
        $sql = "SELECT * from Gebruiker where Gebruikersnaam = ? ";
        $query = $dbh->prepare($sql);
        $query->execute(array($gebruikersnaam));;
        $row = $query->fetch();
        $BestaatGebruiker = $row['Gebruikersnaam'];
        if (!isset($BestaatGebruiker)) {
            if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                header("location: $_SERVER[HTTP_REFERER]&errorLogin=GebruikerBestaatNiet");
                exit();
            } else {
                header("location: $_SERVER[HTTP_REFERER]?errorLogin=GebruikerBestaatNiet");
                exit();
            }
            
        } else {
            $query = $dbh->prepare($sql);
            $query->execute(array($gebruikersnaam));
           //check of gebruiker geblokkerd is 
            if ($row = $query->fetch()) {
                if($row['Geblokkeerd']){
                    header("location: $_SERVER[HTTP_REFERER]?errorLogin=geblokkeerd");
                exit();
                }
                //check wachtwoord
                $pwdCheck = password_verify($password, $row['Wachtwoord']);
                if ($pwdCheck == false) {
                    if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                        header("location: $_SERVER[HTTP_REFERER]&errorLogin=verkeerdwachtwoord");
                        exit();
                    } else {
                        header("location: $_SERVER[HTTP_REFERER]?errorLogin=verkeerdwachtwoord");
                        exit();
                    }
                    exit();
                } else if ($pwdCheck == true) {

                    // start de sessie en login
                    session_start();
                    $_SESSION['userId'] = $row['Gebruikersnaam'];
                    $_SESSION['userUid'] = $row['Mailadres'];
                    $_SESSION['soortGebruiker'] = $row['SoortGebruiker'];
                    $sql = 'insert into LoginActiviteit(Gebruikersnaam)
                    values (?)';
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array( $row['Gebruikersnaam']))) {
                        echo "<script> history.go(-1); </script> ";
                    }

                 
                    exit();
                } else {
                    //verkeerd wachtwoord
                    if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                        header("location: $_SERVER[HTTP_REFERER]&errorLogin=verkeerdwachtwoord");
                    } else {
                        header("location: $_SERVER[HTTP_REFERER]?errorLogin=verkeerdwachtwoord");
                    }
                }
            } else {
                //sql error
                if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                    header("location: $_SERVER[HTTP_REFERER]&errorLogin=sql");
                } else {
                    header("location: $_SERVER[HTTP_REFERER]?errorLogin=sql");
                }
            }
        }
    }
} else {
    // sql error
    if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
        header("location: $_SERVER[HTTP_REFERER]&errorLogin=error");
    } else {
        header("location: $_SERVER[HTTP_REFERER]?errorLogin=error");
    }
    exit();
}
