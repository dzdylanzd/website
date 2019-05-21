<?php



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
                    <h2>Veiling Plaatsen</h2>
                </div>
              
                    <div class="registreerbox">

                        <h3>foto's</h3>
                
                        <div class="uk-flex">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-3 "><img src="https://via.placeholder.com/150" alt="Girl in a jacket"></div>
    
    
    <div class="uk-card uk-card-default uk-card-body uk-width-expand ">Item 3</div>
</div>



                    </div>
                    <form method="post" action="includes/registreren.inc.php">
                    <div class="registreerbox">

                        <h3>Algemene informatie</h3>
                        <label class="registreerlabel" for="titel">Titel</label><br>
                        <input class="uk-input input-registratie" type="text" id="titel" name="titel"><br>
                        <label class="registreerlabel" for="staat">Staat van het product</label><br>
                        <select class="uk-select input-registratie" name="staat">
                            <option value="...">...</option>
                        </select>
                    </div>
                    <div class="registreerbox">
                        <h3>Adresgegevens</h3>
                        <label class="registreerlabel" for="adres1">Straat en huisnummer</label><br>
                        <input class="uk-input input-registratie" type="text" id="adres1" name="adres1"><br>
                        <label class="registreerlabel" for="postcode">Postcode</label><br>
                        <input class="uk-input input-registratie" type="text" id="postcode" name="postcode"><br>
                        <label class="registreerlabel" for="plaats">Plaats</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaats" name="plaats"><br>
                        <label class="registreerlabel" for="land">Land</label><br>
                        <select class="uk-select input-registratie" name="land">

                            </><br>
                    </div>
                    <div class="registreerbox">
                        <h3>Inloggegevens</h3>
                        <label class="registreerlabel" for="gebruikersnaam">Gebruikersnaam</label><br>
                        <input class="uk-input input-registratie" type="text" id="gebruikersnaam" name="gebruikersnaam"><br>
                        <label class="registreerlabel" for="wachtwoord">Wachtwoord</label><br>
                        <input class="uk-input input-registratie" type="password" id="wachtwoord" name="wachtwoord" placeholder="Minimaal acht tekens, één hoofdletter en één cijfer"><br>
                        <label class="registreerlabel" for="bevestigWachtwoord">Wachtwoord herhalen</label><br>
                        <input class="uk-input input-registratie" type="password" id="bevestigWachtwoord" name="bevestigWachtwoord"><br>
                        <label class="registreerlabel" for="bevestigingsvraag">Bevestigingsvraag</label><br>
                        <select class="uk-select input-registratie" name="bevestigingsvraag">

                    </div>
                    <button type="submit" name="veiling-maken-button" class="uk-button knop-veiling-maken">Veiling maken</button>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>