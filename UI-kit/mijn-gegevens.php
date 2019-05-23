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
    require_once('includes/database.php');
    ?>

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
            <?php
            // Haal gegevens van de database en zet ze in variabelen
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
                            $accountType = $row["SoortGebruiker"];
                        }
                    }
                }
            }
            ?>
            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Mijn gegevens</h2>
                </div>
                <form method="post" action="wijzigen-gegevens.php">
                    <div class="registreerbox">
                        <h3>Persoonsgegevens</h3>
                        <p class="mijngegevens">Voornaam: <?php echo $voornaam ?> </p><br>
                        <p class="mijngegevens">Achternaam: <?php echo $achternaam ?> </p><br>
                        <p class="mijngegevens">Geboortedatum: <?php echo $geboortedatum ?> </p><br>

                 <?php       
                $sql = 'SELECT Telefoonnummer FROM Gebruikerstelefoon WHERE gebruiker = ?';
                if ($sth = $dbh->prepare($sql)) {
                    if ($sth->execute(array($gebruikersnaam))) {
                        while ($row = $sth->fetch()) {
                            echo"<p class=\"mijngegevens\">Telefoonnummer:";
                            echo" $row[Telefoonnummer]";
                            echo"</p><br>";
                        }
                    }
                }
                ?>
                <p class="mijngegevens"> </p>
                 
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <p class="mijngegevens">Straat en huisnummer: <?php echo $straat ?></p><br>
                        <p class="mijngegevens">Postcode: <?php echo $postcode ?></p><br>
                        <p class="mijngegevens">Plaats: <?php echo $plaats ?></p><br>
                        <p class="mijngegevens">Land: <?php echo $land ?></p><br>
                    </div>

                    <div class="registreerbox">
                        <h3>Accountgegevens</h3>
                        <p class="mijngegevens">Account type: <?php if ($accountType == 'K') {
                                                                    echo "Koper";
                                                                } else if ($accountType == 'V') {
                                                                    echo "Verkoper";
                                                                } else if ($accountType == 'A') {
                                                                    echo "Activatie";
                                                                } else if ($accountType == 'B') {
                                                                    echo "Beheerder";
                                                                } else {
                                                                    echo "?";
                                                                }  ?></p><br>
                        <p class="mijngegevens">Gebruikersnaam: <?php echo $gebruikersnaam ?></p><br>
                        <p class="mijngegevens">E-mailadres: <?php echo $email ?></p><br>

                    </div>

                    <div class="registreerbox">
                        <h3>Voorkeuren</h3>

                        <?php
                        $sql = "select Rubrieknaam from Rubriek where Rubrieknummer in(

                                select categorie from voorkeur where gebruikersnaam = ?)";
                        if ($sth = $dbh->prepare($sql)) {
                            if ($sth->execute(array($gebruikersnaam))) {
                                while ($row = $sth->fetch()) {
                                    echo "<p class=\"mijngegevens\">$row[Rubrieknaam]</p> <br>";
                                }
                            }
                        }
                        ?>

                    </div>
                    <button action="wijzigen-gegevens.php" type="submit" name="bevestigings-button" class="uk-button knop-registreren">Gegevens wijzigen</button>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>