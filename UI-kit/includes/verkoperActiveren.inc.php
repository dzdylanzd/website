<?php
session_start();
$verificatiecodeTabel = 'sdfasddsaffsadfsdfsadfasds';
if (isset($_POST['verkoopaccountActiveren'])) {
    require_once('database.php');
    $Gebruiksernaam = $_SESSION['userId'];

    $verificatiecode = $_POST['verificatiecode'];
    // haal alles op van  VerificatiecodeVerkoper 
    $sql = 'SELECT * FROM VerificatiecodeVerkoper WHERE Gebruikersnaam = ?';
    if ($query = $dbh->prepare($sql)) {
        if ($query->execute(array($Gebruiksernaam)))
            while ($row = $query->fetch()) {
                $verificatiecodeTabel = $row['VerificatiecodeVerkoper'];
                // check of de code niet meer geldig
                if (strtotime($row['DatumEinde']) < strtotime("now")) {
                    // verwijder de niet meer geldige 
                    $sqlVerwijder = 'DELETE FROM Verkoper
                WHERE Gebruiker = ?
                
                DELETE VerificatiecodeVerkoper
                WHERE Gebruikersnaam = ?
                
                UPDATE Gebruiker
                SET SoortGebruiker = \'K\'
                WHERE Gebruikersnaam = ?';
                    if ($sth = $dbh->prepare($sqlVerwijder)) {
                        $sth->execute(array($Gebruiksernaam, $Gebruiksernaam, $Gebruiksernaam));
                    }

                    header("location: ../verkoperWorden.php?error=codeNietMeerGeldig");
                    exit();
                }
            }
    }
    // check of code klopt
    if ($verificatiecode == $verificatiecodeTabel) {
        $sql2 = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?
                DELETE VerificatiecodeVerkoper
                WHERE Gebruikersnaam = ?';
        $query = $dbh->prepare($sql2);
        if ($query->execute(array("V", $Gebruiksernaam, $Gebruiksernaam))) {


            // zend mail naar de gebruiker die nu verkoper is geworden
            require_once('zendMailVerkoopaccount.php');
            header("location: ../index.php?succes=uBentVerkoper");
            exit();
        }
    } else {
        header("location: ../verkoperActiveren.php?error=codeOnjuist");
        exit();
    }
}
