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
                <form method="post" action="includes/registreren.inc.php">
                    <div class="registreerbox">

                        <h3>Algemene informatie</h3>
                        <label class="registreerlabel" for="titel">Titel</label><br>
                        <input class="uk-input input-registratie" type="text" id="titel" name="titel"><br>
                        <label class="registreerlabel" for="staat">Staat van het product</label><br>
                        <select class="uk-select input-registratie" name="staat"><br>
                            <option value="...">...</option>
                        </select><br>
                        <label class="registreerlabel" for="beschrijving">Beschrijving</label><br>
                        <textarea class="uk-textarea" name="message" rows="5" cols="20"></textarea>
                    </div>
                    <div class="registreerbox">
                        <h3>Veilinginformatie</h3>
                        <label class="registreerlabel" for="lengte">lengte van de veiling</label><br>
                        <select class="uk-select input-registratie" name="lengte"><br>
                            <option value="...">...</option>
                        </select><br>
                        <label class="registreerlabel" for="valuta">Valuta</label><br>
                        <select class="uk-select input-registratie" name="valuta"><br>
                            <option value="...">...</option>
                        </select><br>
                        <label class="registreerlabel" for="prijs">Prijs</label><br>
                        <input class="uk-input input-registratie" type="text" id="verzendkosten" name="verzendkosten"><br>
                        <label class="registreerlabel" for="verzendkosten">Verzendkosten</label><br>
                        <input class="uk-input input-registratie" type="text" id="verzendkosten" name="verzendkosten"><br>
                        <label class="registreerlabel" for="betalingswijze">Betalingswijze</label><br>
                        <select class="uk-select input-registratie" name="betalingswijze"><br>
                            <option value="...">...</option>
                        </select><br>
                           <br>
                    </div>
                    <div class="registreerbox">
                        <h3>Locatie van het product</h3>
                        <label class="registreerlabel" for="plaatsnaam">Plaatsnaam</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaatsnaam" name="plaatsnaam"><br>
                        <label class="registreerlabel" for="land">Land</label><br>
                        <select class="uk-select input-registratie" name="land"><br>
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
                    <button type="submit" name="veiling-maken-button" class="uk-button knop-veiling-maken">Veiling plaatsen</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>