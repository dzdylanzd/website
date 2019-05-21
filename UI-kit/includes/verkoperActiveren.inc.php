<?php
session_start();
if (isset($_POST['verkoopaccountActiveren'])) {
    require_once('database.php');
    $Gebruiksernaam = $_SESSION['userId'];

    echo "dik";
    $verificatiecode = $_POST['verificatiecode'];
    if ($verificatiecode == $_SESSION["verificatiecode"]) {
        $sql = 'UPDATE Gebruiker SET SoortGebruiker = ? WHERE Gebruikersnaam = ?';
        $query = $dbh->prepare($sql);
        if ($query->execute(array("V", $Gebruiksernaam))) {
            header("location: ../index.php");
            exit();
        }
    }else{
        echo$_SESSION["verificatiecode"];
    }
}
