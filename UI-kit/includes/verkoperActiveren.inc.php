<?php
session_start();
if (isset($_POST['verkoopaccountActiveren'])) {
    require_once('database.php');
    $Gebruiksernaam = $_SESSION['userId'];

    $verificatiecode = $_POST['verificatiecode'];
    $sql = 'SELECT VerificatiecodeVerkoper FROM VerificatiecodeVerkoper WHERE Gebruikersnaam = ?';
    if($query = $dbh->prepare($sql)){
        if ($query->execute(array($Gebruiksernaam)))
        while($row = $query->fetch()){
            $verificatiecodeTabel = $row['VerificatiecodeVerkoper'];
        }
    }
    
    if ($verificatiecode == $verificatiecodeTabel) {
        $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
        $query = $dbh->prepare($sql2);
        if ($query->execute(array("V", $Gebruiksernaam))) {
            header("location: ../index.php?succes=uBentVerkoper");
            exit();
        }
    }else{
        header("location: ../verkoperActiveren.php?error=codeOnjuist");
        exit();
        
    }
}
