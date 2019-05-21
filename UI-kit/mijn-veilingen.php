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
            <?php
            // Haal gegevens van de database en zet ze in variabelen
            if (isset($_SESSION['userId']) && isset($_SESSION['userUid'])) {
                $gebruikersnaam = $_SESSION['userId'];

                // Haal titel, 
                $sql = 'SELECT * FROM Voorwerp WHERE Verkoper = ?';
                if ($sth = $dbh->prepare($sql)) {
                    if ($sth->execute(array($gebruikersnaam))) {
                        while ($row = $sth->fetch()) {
                            $titel = $row['Titel'];
                            $looptijdBegin = $row['LooptijdBegin'];
                            $looptijdEinde = $row['LooptijdEinde'];
                            $looptijdVerschil = date_diff($looptijdBegin, $looptijdEinde);
                            
                            $voornaam = $row['Voornaam'];
                            $voorwerpnummer = $row ['VoorwerpNummer'];
                        }
                    }
                }

                // Haal thumbnail op
                $sql = 'SELECT * FROM Thumbnail WHERE VoorwerpNummer = ?';
                if ($sth = $dbh->prepare($sql)) {
                    if ($sth->execute(array($voorwerpnummer))) {
                            $thumbnail = $row['Thumbnailfile'];
                    }
                }

                // Haal huidig bod op
                $sql = 'SELECT * FROM Bod WHERE Voorwerp = ?';
                if ($sth = $dbh->prepare($sql)) {
                    if ($sth->execute(array($voorwerpnummer))) {
                            $huidigbod = $row['BodBedrag'];
                    }
                }
            }
            ?>

            <!-- titel -->
            <div class="mijn-veilingen">
                <h2>Mijn veilingen</h2>
            </div>

            <!-- veilingen -->
            <div class="uk-flex">
                <div class="uk-width-1-1 uk-width-1-3@s veilingbox">
                    Veiling
                </div>
                <div class="uk-width-1-1 uk-width-1-3@s veilingbox">
                    Veiling
                </div>
                <div class="uk-width-1-1 uk-width-1-3@s veilingbox">
                    Veiling
                </div>
                <div class="uk-width-1-1 uk-width-1-3@s veilingbox">
                    Veiling
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>