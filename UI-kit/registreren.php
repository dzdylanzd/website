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
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">

            <!-- header -->
            <div class="uk-hidden@s">
                <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <a class=" uk-logo uk-navbar-item " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>
                    </div>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <div class="uk-navbar-item ">
                            <form action="productpage.php">
                                <div class="uk-inline">
                                    <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                                    <input class="uk-input" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                                </div>
                            </form>
                            <a class="uk-margin-left" href="index.php" uk-icon="icon: user"></a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Registreren</h2>
                </div>
                <form method="post" action="registreren.inc.php">
                    <div class="registreerbox">

                        <h3>Persoonsgegevens</h3>
                        <label for="voornaam">Voornaam*</label><br>
                        <input class="uk-input input-registratie" type="text" id="voornaam" name="voornaam"><br>
                        <label for="achternaam">Achternaam*</label><br>
                        <input class="uk-input input-registratie" type="text" id="achternaam" name="achternaam"><br>
                        <label for="geboortedatum">Geboortedatum*</label><br>
                        <input class="uk-input input-registratie" type="date" id="geboortedatum" name="geboortedatum"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <label for="adres1">Straat en huisnummer</label><br>
                        <input class="uk-input input-registratie" type="text" id="adres1" name="adres1"><br>
                        <label for="postcode">Postcode</label><br>
                        <input class="uk-input input-registratie" type="text" id="postcode" name="postcode"><br>
                        <label for="plaats">Plaats</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaats" name="plaats"><br>
                        <label for="land">Land</label><br>
                        <select class="uk-select input-registratie" name="land">
                            <option value="">tekst</option>
                        </select><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Inloggegevens</h3>
                        <label for="gebruikersnaam">Gebruikersnaam*</label><br>
                        <input class="uk-input input-registratie" type="text" id="gebruikersnaam" name="gebruikersnaam"><br>
                        <label for="wachtwoord">Wachtwoord*</label><br>
                        <input class="uk-input input-registratie" type="password" id="wachtwoord" name="wachtwoord"><br>
                        <label for="bevestigWachtwoord">Wachtwoord herhalen*</label><br>
                        <input class="uk-input input-registratie" type="password" id="bevestigWachtwoord" name="bevestigWachtwoord"><br>
                        <label for="bevestigingsvraag">Bevestiginsvraag*</label><br>
                        <select class="uk-select input-registratie" name="bevestigingsvraag">
                            <option value="">tekst</option>
                        </select><br>
                        <label for="antwoord">Antwoord*</label><br>
                        <input class="uk-input input-registratie" type="password" id="antwoord" name="antwoord"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Voorkeuren</h3>
                        <input class="uk-checkbox" type="checkbox" value="categorie">categorie<br>
                    </div>
                    <button type="submit" name="bevestigings-button" class="uk-button knop-email">E-mail bevestigen</button>
                </form>
            </div>
        </div>




        <?php include 'includes/footer.inc.php'; ?>

</body>

</html>