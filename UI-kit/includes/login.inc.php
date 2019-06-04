<?php

if (isset($_POST['login-submit'])) {
    require_once('database.php');

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];

    if (empty($gebruikersnaam) || empty($password)) {
        if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
            header("location: $_SERVER[HTTP_REFERER]&errorLogin=leeg");
        } else {
            header("location: $_SERVER[HTTP_REFERER]?errorLogin=leeg");
        }
        exit();
    } else {
        $sql = "SELECT * from Gebruiker where Gebruikersnaam = ? ";
        if (!$query = $dbh->prepare($sql)) {
            if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                exit();
                header("location: $_SERVER[HTTP_REFERER]&errorLogin=GebruikerBestaatNiet");
            } else {
                header("location: $_SERVER[HTTP_REFERER]?errorLogin=GebruikerBestaatNiet");
                exit();
            }
            exit();
        } else {
            $query = $dbh->prepare($sql);
            $query->execute(array($gebruikersnaam));
           
            if ($row = $query->fetch()) {
                if($row['Geblokeerd']){
                    header("location: $_SERVER[HTTP_REFERER]?errorLogin=geblokeerd");
                exit();
                }
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
                    if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                        header("location: $_SERVER[HTTP_REFERER]&errorLogin=verkeerdwachtwoord");
                    } else {
                        header("location: $_SERVER[HTTP_REFERER]?errorLogin=verkeerdwachtwoord");
                    }
                }
            } else {
                if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
                    header("location: $_SERVER[HTTP_REFERER]&errorLogin=sql");
                } else {
                    header("location: $_SERVER[HTTP_REFERER]?errorLogin=sql");
                }
            }
        }
    }
} else {
    if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
        header("location: $_SERVER[HTTP_REFERER]&errorLogin=error");
    } else {
        header("location: $_SERVER[HTTP_REFERER]?errorLogin=error");
    }
    exit();
}
