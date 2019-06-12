<?php
session_start();
if (!isset($_SESSION["gevalideert"])) {
    header("Location: email-Bevestiging.php");
    die();
} else {
    session_abort();
}

?>


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
            // error handlers
            if (isset($_GET['error'])) {
                $errorBericht = ($_GET['error']);
                switch ($errorBericht) {
                    case 1:
                        echo '<p class="errors">Vul alle velden in</p>';
                        break;
                    case 2:
                        echo '<p class="errors">Dit is geen correct e-mailadres</p>';
                        break;
                    case 3:
                        echo '<p class="errors">De gebruikersnaam is al in gebruik</p>';
                    case 4:
                        echo '<p class="errors">De wachtwoorden komen niet overeen</p>';
                        break;
                    case 5:
                        echo '<p class="errors">Een of meerdere invoervelden bevat te veel tekens</p>';
                        break;
                    case 6:
                        echo '<p class="errors">De gebruikersnaam bevat een speciaal teken</p>';
                        break;
                    case 7:
                        echo '<p class="errors">SQL error, probeer het opnieuw</p>';
                        break;
                    case 8:
                        echo '<p class="errors">Uw wachtwoord is te kort</p>';
                        break;
                    case 9:
                        echo '<p class="errors">Er moet een hoofletter in het wachtwoord zitten</p>';
                        break;
                    case 10:
                        echo '<p class="errors">Er moet een cijfer in het wachtwoord zitten</p>';
                        break;
                    case 11:
                        echo '<p class="errors">Een voorkeur is hetzelfde</p>';
                        break;
                    case 12:
                        echo '<p class="errors">Uw telefoonnummer is te kort</p>';
                        break;
                    default:
                        echo '<p class="errors">Onverwachte error, probeer het opnieuw';
                }
            }
            ?>l
            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Registreren</h2>
                </div>
                <form method="post" action="includes/registreren.inc.php">
                    <div class="registreerbox">

                        <h3>Persoonsgegevens</h3>
                        <label class="registreerlabel" for="voornaam">Voornaam *</label><br>
                        <input class="uk-input input-registratie" type="text" id="voornaam" name="voornaam"><br>
                        <label class="registreerlabel" for="achternaam">Achternaam *</label><br>
                        <input class="uk-input input-registratie" type="text" id="achternaam" name="achternaam"><br>
                        <label class="registreerlabel" for="geboortedatum">Geboortedatum *</label><br>
                        <input class="uk-input input-registratie" type="date" id="geboortedatum" name="geboortedatum"><br>
                        <label class="registreerlabel" for="telefoonnummer">Telefoonnummer *</label><br>
                        <input class="uk-input input-registratie" type="text" placeholder="minimaal 8 tekens" id="telefoonnummer" name="telefoonnummer"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <label class="registreerlabel" for="adres1">Straat en huisnummer *</label><br>
                        <input class="uk-input input-registratie" type="text" id="adres1" name="adres1"><br>
                        <label class="registreerlabel" for="postcode">Postcode *</label><br>
                        <input class="uk-input input-registratie" type="text" id="postcode" name="postcode"><br>
                        <label class="registreerlabel" for="plaats">Plaats *</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaats" name="plaats"><br>
                        <label class="registreerlabel" for="adresregel2">Adresregel 2</label><br>
                        <input class="uk-input input-registratie" type="text" id="adresregel2" name="adresregel2"><br>
                        <label class="registreerlabel" for="land">Land *</label><br>
                        <select class="uk-select input-registratie" name="land">
                            <?php
                            $sql = "SELECT LandNaam FROM Landen ORDER BY LandNaam ASC";
                            if ($sth = $dbh->prepare($sql)) {
                                if ($sth->execute(array())) {
                                    while ($alles = $sth->fetch()) {
                                        if ($alles['LandNaam'] == "Nederland") {
                                            $tekst = "<option value='$alles[LandNaam]' selected>$alles[LandNaam]</option>";
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
                        <label class="registreerlabel" for="gebruikersnaam">Gebruikersnaam *</label><br>
                        <input class="uk-input input-registratie" type="text" id="gebruikersnaam" name="gebruikersnaam"><br>
                        <label class="registreerlabel" for="wachtwoord">Wachtwoord *</label><br>
                        <input class="uk-input input-registratie" type="password" id="wachtwoord" name="wachtwoord" placeholder="Minimaal acht tekens, één hoofdletter en één cijfer"><br>
                        <label class="registreerlabel" for="bevestigWachtwoord">Wachtwoord herhalen *</label><br>
                        <input class="uk-input input-registratie" type="password" id="bevestigWachtwoord" name="bevestigWachtwoord"><br>
                        <label class="registreerlabel" for="bevestigingsvraag">Bevestigingsvraag *</label><br>
                        <select class="uk-select input-registratie" name="bevestigingsvraag">
                            <?php
                            $sql = "SELECT * from vraag ORDER BY vraagnummer ASC";
                            if ($sth = $dbh->prepare($sql)) {
                                if ($sth->execute(array())) {
                                    while ($vraag = $sth->fetch()) {
                                        $tekst = "<option value=$vraag[Vraagnummer] >$vraag[TekstVraag]</option>";
                                        echo $tekst;
                                    }
                                }
                            }
                            ?>
                        </select><br>
                        <label class="registreerlabel" for="antwoord">Antwoord *</label><br>
                        <input class="uk-input input-registratie" type="password" id="antwoord" name="antwoord"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Voorkeuren</h3>
                        <p class="voorwaarden">Voorkeuren mogen niet hetzelfde zijn</p>
                        
                            <?php
                            // haal rubrieken op voor voorkeur
                            $sql = "SELECT * FROM rubriek WHERE volgnr = ? AND rubrieknummer != ?";
                            if ($sth = $dbh->prepare($sql)) {
                                for ($x = 1; $x <= 3; $x++) {
                                    echo '<select class="uk-select input-registratie" name="voorkeur'.$x .'">';
                                    if ($sth->execute(array(-1, -1))) {
                                        while ($row = $sth->fetch()) {
                                            $tekst = "<option value='$row[Rubrieknummer]'>$row[Rubrieknaam]</option><br>";
                                            echo $tekst;
                                        }
                                    }
                                    echo'</select><br>';
                                } 
                               
                            }
                            ?>

                        
                      
                    </div>
                    <p class="registreer">Velden met een * zijn verplicht.</p>
                    <button type="submit" name="bevestigings-button" class="uk-button knop-registreren">Registreren</button>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>