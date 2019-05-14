<?php
if (isset($_POST['signup-submit']))
{
    require_once('database.php');

    
    // $username = $_POST['uid'];
    // $email = $_POST['mail'];
    // $password = $_POST{"pwd"};
    // $passwordRepeat = $_POST['pwd-repeat'];

    $Gebruiksernaam = $_POST['uid'];
    $voornaam = $_POST['mail'];
    $Achternaam = $_POST{"pwd"};
    $Straat = $_POST['pwd-repeat'];
    $Huinummer = "";
    $Postcode = "";
    $Plaatsnaam = "";
    $Land = "";
    $Geboortedag = "";
    $Mailadress = "";
    $Wachtwoord = "";
    $WachtwoordHerhaal = "";
    $VraagNummer = "";
    $Antwoordtekst = "";
    $acounttype = "";


    //fout meldingen
    //check voor lege velden
    if (empty($username)|| empty($email)|| empty($password)|| empty($passwordRepeat)) 
    {
        header("location: ../bezoeker_registeren.php?error=emptyfields&uid=".$username."$mail=".$email);
        exit();

    } 
    else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
        {
            header("location: ../bezoeker_registeren.php?error=invalidmail&uid=".$email);
        exit();
        } 
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("location: ../bezoeker_registeren.php?error=invaliduid&mail=".$username);
        exit();
        } 
    else if($password !== $passwordRepeat){
        header("location: ../bezoeker_registeren.php?error=passwordcheckuid=".$username."&email=".$email);
        exit();
        } 
    
    else {

      $sql = "SELECT UidUsers FROM users WHERE UidUsers = ?";
      if (!$query = $dbh->prepare($sql)){
        header("location: ../bezoeker_registeren.php?error=sqlerror=");
        exit();
      } 
    
    else{
        $query = $dbh->prepare($sql);
      $query->execute(array($username));
      if($query->fetch()) {
        header("location: ../bezoeker_registeren.php?error=usertaken&email=".$email);
        exit();
        } 
        else {
            

                $sql = "INSERT INTO users(UidUsers, emailUsers, pwdUsers) VALUES(?,?,?)";
                if (!$query = $dbh->prepare($sql)){
                  header("location: ../bezoeker_registeren.php?error=sqlerror=");
                  exit();
                } 
              
              else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $query = $dbh->prepare($sql);
                $query->execute(array($username,$email,$hashedPwd));
                header("location: ../bezoeker_login.php?signup=success=");
                  exit();
                                            
                }
            }

        }

    }

}

 else 
{
    header("location: ../bezoeker_registeren.php");
    exit();
}

?>