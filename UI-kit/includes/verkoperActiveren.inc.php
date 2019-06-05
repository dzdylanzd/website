<?php
session_start();
$verificatiecodeTabel = 'sdfasddsaffsadfsdfsadfasds';
if (isset($_POST['verkoopaccountActiveren'])) {
    require_once('database.php');
    $Gebruiksernaam = $_SESSION['userId'];

    $verificatiecode = $_POST['verificatiecode'];
    $sql = 'SELECT * FROM VerificatiecodeVerkoper WHERE Gebruikersnaam = ?';
    if($query = $dbh->prepare($sql)){
        if ($query->execute(array($Gebruiksernaam)))
        while($row = $query->fetch()){
            $verificatiecodeTabel = $row['VerificatiecodeVerkoper'];
            if( $alles['DatumEinde'] < getdate()) {
                $sqlVerwijder = 'delete from Verkoper
                where Gebruiker = ?
                
                delete VerificatiecodeVerkoper
                where Gebruikersnaam = ?
                
                update Gebruiker
                set SoortGebruiker = \'K\'
                where Gebruikersnaam = ?';
                if ($sth = $dbh->prepare($sqlVerwijder)) {
                  $sth->execute(array($Gebruiksernaam,$Gebruiksernaam,$Gebruiksernaam));
                }
                header("location: ../verkoperWorden.php?error=codeVerlopen");
                exit();
            }
        }
    }
    
    if ($verificatiecode == $verificatiecodeTabel) {
        $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?
        delete VerificatiecodeVerkoper
where Gebruikersnaam = ?';
        $query = $dbh->prepare($sql2);
        if ($query->execute(array("V", $Gebruiksernaam,$Gebruiksernaam))) {

// hidde hier moet de mail


            header("location: ../index.php?succes=uBentVerkoper");
            exit();
        }
    }else{
        header("location: ../verkoperActiveren.php?error=codeOnjuist");
        exit();
        
    }
}
