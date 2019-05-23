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

            <!-- titel van pagina -->
            <div class="mijn-veilingen-titel">
                <h2>Mijn veilingen <button onclick="window.location.href='veiling-Maken.php'" name="bevestigings-button" class="uk-button knop-nieuwe-veiling">Nieuwe veiling maken</button><h2>
            </div>

            <!-- veilingen -->
            <div class="uk-flex uk-flex-center uk-flex-wrap uk-flex-wrap-around">

                <?php
                // Haal gegevens van de database en zet ze in variabelen
                if (isset($_SESSION['userId']) && isset($_SESSION['userUid'])) {
                    $gebruikersnaam = $_SESSION['userId'];

                    $titel = '';
                    $looptijdeinde = '';
                    $voorwerpnummer = '';
                    $looptijd = '';
                    $thumbnail = '';
                    $huidigbod = '';

                    // Haal titel, looptijd en voorwerpnummer op
                    $sql = 'SELECT * FROM Voorwerp WHERE Verkoper = ?';
                    if ($sth = $dbh->prepare($sql)) {
                        if ($sth->execute(array($gebruikersnaam))) {
                            while ($row = $sth->fetch()) {
                                $titel = $row['Titel'];
                                $titel = substr($titel, 0, 30);
                                $looptijdEinde = $row['LooptijdEinde'];
                                $voorwerpnummer = $row['VoorwerpNummer'];
                                $valuta = $row['Valuta'];

                                // Schrijf valuta om in tekens
                                switch ($valuta) {
                                    case 'EUR': 
                                        $valuta = '€';
                                        break;
                                    
                                    case 'GBP':
                                        $valuta = '£';
                                        break;
                                    
                                    case 'AUD':
                                        $valuta = 'A$';
                                        break;
                                    
                                    case 'CAD':
                                        $valuta = 'C$';
                                        break;

                                    case 'INR':
                                        $valuta = '₹';
                                        break;

                                    case 'USD':
                                        $valuta = '$';
                                        break;
                                }

                                // Bereken de looptijd
                                $looptijd = substr(substr_replace($looptijdEinde, "T", 11, 0), 0, 20) . "+01:00";
                                $looptijd =  str_replace(" ", "", $looptijd);


                                // Haal thumbnail op
                                $sqlThumbnail = 'SELECT * FROM Thumbnail WHERE VoorwerpNummer = ?';
                                if ($sthThumbnail = $dbh->prepare($sqlThumbnail)) {
                                    if ($sthThumbnail->execute(array($voorwerpnummer))) {
                                        while ($rowThumbnail = $sthThumbnail->fetch()) {
                                            $thumbnailSource = $rowThumbnail['Thumbnailfile'];
                                            $thumbnail = "src=\"http://iproject5.icasites.nl/thumbnails/$thumbnailSource";
                                        }
                                    }
                                }

                                // Haal huidig bod op
                                $sqlBod = 'SELECT * FROM Bod WHERE Voorwerp = ?';
                                if ($sthBod = $dbh->prepare($sqlBod)) {
                                    if ($sthBod->execute(array($voorwerpnummer))) {
                                        while ($rowBod = $sthBod->fetch()) {
                                            $huidigbod = $rowBod['BodBedrag'];
                                        }
                                    }
                                }

                                echo '<div class="uk-width-1-1 uk-width-1-3@s veilingbox">';
                                echo '<h3>' . $titel . '...</h3>';
                                echo '<img class="mijn-veilingen-thumbnail" '.$thumbnail.'" alt="Thumbnail"><br>';
                                echo "<h3 class=\"mijn-veilingen\"> Tijd resterend: <br>  
                                        <div class=\"margin-left uk-grid-small uk-child-width-auto\" uk-grid uk-countdown=\"date:  $looptijd\">
                                            <div>
                                                <div class=\"countdown-getal-klein uk-countdown-number uk-countdown-days\"></div>
                                            </div>
                                            <div class=\"countdown-getal-klein uk-countdown-separator\">d</div>
                                            <div>
                                                <div class=\"countdown-getal-klein uk-countdown-number uk-countdown-hours\"></div>
                                            </div>
                                            <div class=\"countdown-getal-klein uk-countdown-separator\">u</div>
                                            <div>
                                                <div class=\"countdown-getal-klein uk-countdown-number uk-countdown-minutes\"></div>
                                            </div>
                                            <div class=\"countdown-getal-klein uk-countdown-separator\">m</div>
                                            <div>
                                                <div class=\"countdown-getal-klein uk-countdown-number uk-countdown-seconds\"></div>
                                            </div>
                                            <div class=\"countdown-getal-klein uk-countdown-separator\">s</div>
                                        </div></h3>";
                                echo '<h3>Huidig bod: ' . $valuta . $huidigbod;
                                echo '</div></h3>';
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>