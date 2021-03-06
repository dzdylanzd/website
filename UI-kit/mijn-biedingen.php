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
    require_once('includes/database.php');
    include 'includes/defaultMobileNav.php';
    ?>

    <div class="page-container">
        <div class="content-wrap">

            <!-- titel van pagina -->
            <div class="mijn-veilingen-titel">
                <h2>Mijn biedingen<h2>
            </div>

            <!-- veilingen -->
            <div class="flex-column-phone uk-flex-center uk-flex-wrap uk-flex-wrap-around">

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
                    $bodGebruiker = '';

                    // Haal unieke voorwerpen op
                    $sqlDistinctVoorwerp = 'SELECT DISTINCT (Voorwerp) FROM Bod WHERE Gebruiker = ?';
                    if ($sthDistinctVoorwerp = $dbh->prepare($sqlDistinctVoorwerp)) {
                        if ($sthDistinctVoorwerp->execute(array($gebruikersnaam))) {
                            while ($rowDistinctVoorwerp = $sthDistinctVoorwerp->fetch()) {
                                $voorwerpnummer = $rowDistinctVoorwerp['Voorwerp'];

                                // Haal titel, looptijd en voorwerpnummer op
                                $sqlVoorwerp = 'SELECT * FROM Voorwerp WHERE VoorwerpNummer = ?';
                                if ($sthVoorwerp = $dbh->prepare($sqlVoorwerp)) {
                                    if ($sthVoorwerp->execute(array($voorwerpnummer))) {
                                        while ($rowVoorwerp = $sthVoorwerp->fetch()) {
                                            $titel = $rowVoorwerp['Titel'];
                                            $titel = substr($titel, 0, 30);
                                            $looptijdEinde = $rowVoorwerp['LooptijdEinde'];
                                            $valuta = $rowVoorwerp['Valuta'];

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
                                                        if(strpos( $rowThumbnail['Thumbnailfile'],"img") !== false){
                                                            $rowThumbnail['Thumbnailfile'] = "http://iproject5.icasites.nl/thumbnails/".  $rowThumbnail['Thumbnailfile'];
                                                        }else{
                                                            $rowThumbnail['Thumbnailfile'] = $rowThumbnail['Thumbnailfile'];
                                                        }
                                                       
                                                        $thumbnail = $rowThumbnail['Thumbnailfile'];
                                                    }
                                                }
                                            }

                                            // Haal het huidige bod op
                                            $sqlBod = 'SELECT BodBedrag FROM Bod WHERE Voorwerp = ? order by BodDagTijd desc';
                                            if ($sthBod = $dbh->prepare($sqlBod)) {
                                                if ($sthBod->execute(array($voorwerpnummer))) {
                                                    while ($rowBod = $sthBod->fetch()) {
                                                        $huidigbod = $rowBod['BodBedrag'];
                                                       
                                                    }
                                                }
                                            }

                                            // Haal het bod van de gebruiker op
                                            $sqlBodGebruiker = 'SELECT top 1 BodBedrag FROM Bod WHERE Gebruiker = ? and Voorwerp = ? order by BodDagTijd desc';
                                            if ($sthBodGebruiker = $dbh->prepare($sqlBodGebruiker)) {
                                                if ($sthBodGebruiker->execute(array($gebruikersnaam,$voorwerpnummer))) {
                                                    while ($rowBodGebruiker = $sthBodGebruiker->fetch()) {
                                                        $bodGebruiker = $rowBodGebruiker['BodBedrag'];
                                                    }
                                                }
                                            }

                                            // Haal op hoevaak er is geboden
                                            $sqlAantalBiedingen = 'SELECT COUNT(BodBedrag) AS \'AantalBiedingen\' FROM Bod WHERE Voorwerp = ?';
                                            if ($sthAantalBiedingen = $dbh->prepare($sqlAantalBiedingen)) {
                                                if ($sthAantalBiedingen->execute(array($voorwerpnummer))) {
                                                    while ($rowAantalBiedingen = $sthAantalBiedingen->fetch()) {
                                                        $aantalBiedingen = $rowAantalBiedingen['AantalBiedingen'];
                                                    }
                                                }
                                            } 

                                            echo '<div class="uk-width-1-1 uk-width-1-3@s veilingbox">';
                                            echo '<h3>' . $titel . '...</h3>';
                                            echo '<a href="productPage.php?ID='. $voorwerpnummer . '"><img class="mijn-veilingen-thumbnail" src="' . $thumbnail . '" alt="Thumbnail"></a><br>';
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
                                            echo '<h3>Huidig bod ('.$aantalBiedingen.'): ' . $valuta . (double)$huidigbod . '</h3>';
                                            echo '<h3>Uw bod: ' . $valuta . (double)$bodGebruiker . '</h3>';
                                            if ($huidigbod == $bodGebruiker) {
                                                echo '<h3 class=succes> U heeft het hoogste bod! </h3>';
                                            } else {
                                                echo '<h3 class=errors> U heeft niet het hoogste bod! </h3>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                }
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