<!DOCTYPE html>
<html>

<head>
    <title>EenmaalAndermaal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body>
    <?php include 'includes\nav-L-M.php';
    include 'includes/defaultMobileNav.php';
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">

            <?php
            if (isset($_GET['error'])) {
                $errorBericht = ($_GET['error']);
                switch ($errorBericht) {
                    case 1:
                        echo '<p class="errors">Vul alle velden in</p>';
                        break;
                    case 3:
                        echo '<p class="errors">De gebruikersnaam is al in gebruik</p>';
                    case 4:
                        echo '<p class="errors">De wachtwoorden komen niet overeen</p>';
                        break;
                    case 5:
                        echo '<p class="errors">Een of meerdere invoervelden bevatten teveel tekens</p>';
                        break;
                    case 6:
                        echo '<p class="errors">De gebruikersnaam bevat een speciaal teken</p>';
                        break;
                    case 7:
                        echo '<p class="errors">SQL error, probeer het opnieuw</p>';
                        break;
                    default:
                        echo '<p class="errors">Onverwachte error, probeer het opnieuw';
                }
            }
            ?>
            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Wijzigen gegevens</h2>
                    <?php
                    if (isset($_SESSION['userId']) && isset($_SESSION['userUid'])) {
                        $gebruikersnaam = $_SESSION['userId'];
                        $email = $_SESSION['userUid'];

                        $sql = 'SELECT Telefoonnummer FROM Gebruikerstelefoon WHERE gebruiker = ?';
                        if ($sth = $dbh->prepare($sql)) {
                            if ($sth->execute(array($gebruikersnaam))) {
                                while ($row = $sth->fetch()) {
                                    $telefoonnummer = $row['Telefoonnummer'];
                                }
                            }
                        }

                        $sql = 'SELECT * FROM Gebruiker WHERE gebruikersnaam = ?';
                        if ($sth = $dbh->prepare($sql)) {
                            if ($sth->execute(array($gebruikersnaam))) {
                                while ($row = $sth->fetch()) {
                                    $voornaam = $row['Voornaam'];
                                    $achternaam = $row['Achternaam'];
                                    $geboortedatum = $row['Geboortedatum'];
                                    $straat = $row['Adresregel1'];
                                    $postcode = $row['Postcode'];
                                    $plaats = $row['Plaatsnaam'];
                                    $land = $row['Land'];
                                    $vraag = $row["Vraagnummer"];
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <form method="post" action="includes\wijziggegevens.inc.php">
                <!-- <form method="get" action="index.php"> -->
                    <div class="registreerbox">

                        <h3>Persoonsgegevens</h3>
                        <label class="registreerlabel" for="voornaam">Voornaam</label><br>
                        <input class="uk-input input-registratie" type="text" id="voornaam" name="voornaam" value="<?php echo $voornaam;  ?>">
                        <br>
                        <label class="registreerlabel" for="achternaam">Achternaam</label><br>
                        <input class="uk-input input-registratie" type="text" id="achternaam" name="achternaam" value="<?php echo $achternaam;  ?>"><br>
                        <label class="registreerlabel" for="geboortedatum">Geboortedatum </label><br>
                        <input class="uk-input input-registratie" type="date" id="geboortedatum" name="geboortedatum" value="<?php echo $geboortedatum;  ?>"><br>
                        <label class="registreerlabel" for="Email">Email </label><br>
                        <input class="uk-input input-registratie" type="text" id="Email" name="Email" value="<?php echo $email;  ?>"><br>
<!-- 
                           <?php       
                $sql = 'SELECT Telefoonnummer FROM Gebruikerstelefoon WHERE gebruiker = ?';
                if ($sth = $dbh->prepare($sql)) {
                    if ($sth->execute(array($gebruikersnaam))) {
                        while ($row = $sth->fetch()) {
                            echo"   <label class=\"registreerlabel\" for=\"telefoonnummer\">Telefoonnummer</label><br>
                            <input class=\"uk-input input-registratie\" type=\"number\" id=\"telefoonnummer\" name=\"telefoonnummer\" value=\"";
                            echo $row['Telefoonnummer'];
                            echo"\"><br>";
                            
                        }
                    }
                }
                ?> -->
                   
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <label class="registreerlabel" for="adres1">Straat en huisnummer</label><br>
                        <input class="uk-input input-registratie" type="text" id="adres1" name="adres1" value="<?php echo $straat;  ?>"><br>
                        <label class="registreerlabel" for="postcode">Postcode</label><br>
                        <input class="uk-input input-registratie" type="text" id="postcode" name="postcode" value="<?php echo $postcode;  ?>"><br>
                        <label class="registreerlabel" for="plaats">Plaats</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaats" name="plaats" value="<?php echo $plaats;  ?>"><br>
                        <label class="registreerlabel" for="land">Land</label><br>
                        <select class="uk-select input-registratie" name="land">
                            <?php
                            $sql = "SELECT LandNaam FROM Landen ORDER BY LandNaam ASC";
                            if ($sth = $dbh->prepare($sql)) {
                                if ($sth->execute(array())) {
                                    while ($alles = $sth->fetch()) {
                                        if ($alles['LandNaam'] == $land) {
                                            $tekst = "<option value='$alles[LandNaam]' selected >$alles[LandNaam]</option>";
                                        } else {
                                            $tekst = "<option value='$alles[LandNaam]'>$alles[LandNaam]</option>";
                                        }
                                        echo $tekst;
                                    }
                                }
                            }
                            ?>
                        </select><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Inloggegevens</h3>
                        <label class="registreerlabel" for="oudWachtwoord">Oud wachtwoord</label><br>
                        <input class="uk-input input-registratie" type="password" id="oudWachtwoord" name="oudWachtwoord"><br>
                        <label class="registreerlabel" for="wachtwoord">Wachtwoord</label><br>
                        <input class="uk-input input-registratie" type="password" id="wachtwoord" name="wachtwoord"><br>
                        <label class="registreerlabel" for="bevestigWachtwoord">Wachtwoord herhalen</label><br>
                        <input class="uk-input input-registratie" type="password" id="bevestigWachtwoord" name="bevestigWachtwoord"><br>

                    </div>
                    <div class="registreerbox">
                        <h3>Voorkeuren</h3>



                        <?php
                        
                        $sql2 = "select categorie from voorkeur where gebruikersnaam = ?";
                        if ($sth2 = $dbh->prepare($sql2)) {
                            if ($sth2->execute(array($gebruikersnaam))) {
                                $index = 1;
                                while ($row2 = $sth2->fetch()) {
                                    
                                    echo "<select class=\"uk-select input-registratie\" name=\"voorkeur$index\">";
                                    $sql = "SELECT * FROM rubriek WHERE volgnr = ? AND rubrieknummer != ?";
                                    if ($sth = $dbh->prepare($sql)) {
                                        if ($sth->execute(array(-1, -1))) {
                                            while ($row = $sth->fetch()) {
                                                if($row['Rubrieknummer'] == $row2['categorie']){
                                                $tekst = "<option value='$row[Rubrieknummer]' selected>$row[Rubrieknaam]</option><br>";
                                                }else{
                                                    $tekst = "<option value='$row[Rubrieknummer]'>$row[Rubrieknaam]</option><br>";
                                                }
                                                echo $tekst;
                                            }
                                        }
                                    }
                                    echo " </select><br>";
                                    $index++;
                                }
                            }
                        }
                        ?>


                    </div>
                    <button type="submit" name="bevestigings-button" class="uk-button veiling-maken-button">Gegevens wijzigen</button>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>