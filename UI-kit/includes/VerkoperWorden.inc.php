<?php
session_start();
if (isset($_POST['verkoopaccountActiveren'])) {
  require_once('database.php');

  $Gebruiksernaam = $_SESSION['userId'];

 if(isset($_POST['creditcard'])){
    $creditcard = $_POST['creditcard'];
     $identificatieMethode = "Creditcard";
     $sql = "INSERT  INTO Verkoper( Gebruiker, ControleOptie, Creditcard)
     VALUES (?, ?, ?)";
     $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
     try {
        $query = $dbh->prepare($sql);
        if($query->execute(array($Gebruiksernaam, $identificatieMethode, $creditcard))){
        
            $query = $dbh->prepare($sql2);
            if($query->execute(array("V",$Gebruiksernaam))){
                header("location: ../index.php");
                exit();
            }
        }
    
} 
catch (PDOException $e) {	
    $error = $e->getMessage();
    header("location: ../VerkoperWorden.php?error=$error");
    exit();
}
 }
 else if(isset( $_POST['bank']) && isset($_POST['rekeningnummer'])){  
    $bank = $_POST['bank'];
    $rekeningnummer = $_POST['rekeningnummer'];
    $identificatieMethode = "email";
 }
}else{
    header("location: ../index.php");
    exit();
}


header("location: ../VerkoperWorden.php?error=leeg");
exit();