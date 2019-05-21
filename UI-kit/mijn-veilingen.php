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
    ?>

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

            <!-- titel van pagina -->
            <div class="mijn-veilingen-titel">
                <h2>Mijn veilingen</h2>
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
                                echo "<h4 class=\"mijn-veilingen\">  
                                        <div class=\"uk-grid-small uk-child-width-auto\" uk-grid uk-countdown=\"date:  $looptijd\">
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
                                        </div></h4>";
                                echo 'Huidig bod: ' . $huidigbod;
                                echo '</div>';
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