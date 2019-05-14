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
            <div>
                <h2>Registreren</h2>
                <form method="post" action="registreren.inc.php">
                    <div class="registreerbox">
                        <h3>Persoonsgegevens</h3>
                        <label for="voornaam">Voornaam*</label><br>
                        <input type="text" id="voornaam" name="voornaam"><br>
                        <label for="tussenvoegsel">Tussenvoegsel</label><br>
                        <input type="text" id="tussenvoegsel" name="tussenvoegsel"><br>
                        <label for="achternaam">Achternaam*</label><br>
                        <input type="text" id="achternaam" name="achternaam"><br>
                        <label for="geboortedatum">Geboortedatum*</label><br>
                        <input type="date" id="geboortedatum" name="geboortedatum"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <label for="straat">Straat*</label><br>
                        <input type="text" id="straat" name="straat"><br>
                        <label for="huisnummer">Huisnummer*</label><br>
                        <input type="text" id="huisnummer" name="huisnummer"><br>
                        <label for="postcode">Postcode*</label><br>
                        <input type="text" id="postcode" name="postcode"><br>
                        <label for="plaats">Plaats*</label><br>
                        <input type="text" id="plaats" name="plaats"><br>
                        <label for="land">Land*</label><br>
                        <select name="land">
                            <option value="">tekst</option>
                            </select><br>
                    </div>  
                    <div class="registreerbox">
                        <h3>Inloggegevens</h3>
                        <label for="gebruikersnaam">Gebruikersnaam*</label><br>
                        <input type="text" id="gebruikersnaam" name="gebruikersnaam"><br>
                        <label for="email">E-mail adres*</label><br>
                        <input type="email" id="email" name="email"><br>
                        <label for="wachtwoord">Wachtwoord*</label><br>
                        <input type="password" id="wachtwoord" name="wachtwoord"><br>
                        <label for="bevestigWachtwoord">Wachtwoord herhalen*</label><br>
                        <input type="password" id="bevestigWachtwoord" name="bevestigWachtwoord"><br>
                        <label for="bevestigingsvraag">Bevestiginsvraag*</label><br>
                        <select name="bevestigingsvraag">
                            <option value="">tekst</option>
                            </select><br>
                        <label for="antwoord">Antwoord*</label><br>
                        <input type="password" id="antwoord" name="antwoord"><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Voorkeuren</h3>
                    
                </form>
            </div>




            <?php include 'includes/footer.inc.php'; ?>

</body>

</html>