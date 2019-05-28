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
    <?php
    // $url1 = $_SERVER['REQUEST_URI'];
    // header("Refresh: 5; URL=$url1");
    ?>
    <?php include 'includes\nav-L-M.php';
    include 'includes/defaultMobileNav.php';
    require_once('includes/database.php');
    $_SESSION['PID'] = $_GET["ID"];
    ?>
    <div class="page-container">
        <div class="content-wrap">
            <!-- =========================================== -->
            <!--                    DESKTOP                  -->
            <!-- =========================================== -->

            <div class="flex-column-phone">
                <div class="uk-width-1-1 uk-width-1-3@s Card-Empty">
                    <!-- Titel -->

                    <?php
                    $sql = "SELECT Titel, Beschrijving, Startprijs FROM Voorwerp WHERE Voorwerpnummer = ? ";
                    if ($sth = $dbh->prepare($sql)) {
                        if ($sth->execute(array($_GET["ID"]))) {
                            while ($alles = $sth->fetch()) {
                                echo '<h2><span  class="uk-icon" uk-icon="icon: arrow-left; ratio: 2" onclick="history.go(-1);"></span>';
                                echo " $alles[Titel]</h2>";
                            }
                        }
                    }

                    // foto slideshow
                    $sql = "SELECT TOP 4 IllustratieFile FROM Illustraties WHERE Voorwerpnummer = ? ";
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array($_GET["ID"]))) {
                        $sliderFotos = '<div id="imagepreview-detailpage" class="uk-position-relative uk-visible-toggle uk-light  uk-width-4-4	uk-margin-bottom" tabindex="-1" uk-slideshow>

                            <ul class="uk-slideshow-items ">';
                        $knoppenFotos = '<div class="imagePreview uk-flex">';
                        $index = 0;
                        if ($sth->fetch()) {
                            $sth->execute(array($_GET["ID"]));
                            while ($alles = $sth->fetch()) {
                                if (strpos($alles['IllustratieFile'], "dt_") !== false) {
                                    $alles['IllustratieFile'] = "http://iproject5.icasites.nl/pics/" .  $alles['IllustratieFile'];
                                } else {
                                    $alles['IllustratieFile'] =   $alles['IllustratieFile'];
                                }
                                $image = "src=\"$alles[IllustratieFile]\" ";
                                $sliderFotos = "$sliderFotos <li class=\"Image-Border\">
                                <img $image alt=\"\" uk-cover>
                            </li>";
                                $knoppenFotos = "$knoppenFotos <img $image class=\"uk-width-1-4 \" alt=\"D\" onclick=\"UIkit.slideshow('.uk-slideshow').show($index);\">";
                                $index++;
                            }
                        } else {
                            $sql = "SELECT TOP 4 ThumbnailFile FROM Thumbnail WHERE Voorwerpnummer = ? ";
                            $sth = $dbh->prepare($sql);
                            if ($sth->execute(array($_GET["ID"]))) {
                                while ($alles = $sth->fetch()) {
                                    if (strpos($alles['ThumbnailFile'], "img") !== false) {
                                        $alles['ThumbnailFile'] = "http://iproject5.icasites.nl/thumbnails/" .  $alles['ThumbnailFile'];
                                    } else {
                                        $alles['ThumbnailFile'] =   $alles['ThumbnailFile'];
                                    }
                                    $image = "src=\"$alles[ThumbnailFile]\" ";
                                    $sliderFotos = "$sliderFotos <li class=\"Image-Border\">
                                    <img $image alt=\"\" uk-cover>
                                </li>";
                                    $knoppenFotos = "$knoppenFotos <img $image class=\"uk-width-1-4 \" alt=\"D\" onclick=\"UIkit.slideshow('.uk-slideshow').show($index);\">";
                                    $index++;
                                }
                            }
                        }
                        $sliderFotos = $sliderFotos . ' </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>';
                        $knoppenFotos = $knoppenFotos . ' </div>';
                        echo $sliderFotos;
                        echo $knoppenFotos;
                    }


                    // CONDITIE

                    $sql = "SELECT Staat, StartPrijs, Valuta, Verzendkosten,VerzendInstructies,BetalingsInstructie FROM Voorwerp WHERE Voorwerpnummer = ? ";
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array($_GET["ID"]))) {
                        while ($alles = $sth->fetch()) {
                            $valuta = $alles['Valuta'];
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
                            $startprijs = (double)$alles['StartPrijs'];

                            echo "<h4 class= \"uk-text-emphasis\">Staat: $alles[Staat] </h4><br> 
                            <h4 class=\"conditie\">Startprijs: $valuta " . $startprijs . "</h4><br>
                            <h4 class=\"conditie\">Verzendkosten: $valuta " . (double)$alles['Verzendkosten'] . "</h4><br>
                            <h4 class=\"conditie\">VerzendInstructies:  " . $alles['VerzendInstructies'] . "</h4><br>
                            <h4 class=\"conditie\">BetalingsInstructie:  " . $alles['BetalingsInstructie'] . "</h4>";
                        }
                    }
                    ?>

                    <!-- Beschrijving -->
                    <ul uk-accordion>
                        <li>
                            <a class="uk-accordion-title" href="#">Toon beschrijving </a>
                            <div class="uk-accordion-content">
                                <?php
                                $sql = "SELECT Titel, Beschrijving, Startprijs FROM Voorwerp WHERE Voorwerpnummer = ? ";
                                $sth = $dbh->prepare($sql);
                                if ($sth->execute(array($_GET["ID"]))) {
                                    while ($alles = $sth->fetch()) {
                                        $beschrijving = $alles['Beschrijving'];
                                        $beschrijving = strip_tags($beschrijving, "<style>");
                                        $substring = substr($beschrijving, strpos($beschrijving, "<style"), strpos($beschrijving, "</style>"));
                                        $beschrijving = str_replace($substring, "", $beschrijving);
                                        $beschrijving = str_replace(array("\t", "\r", "\n"), "", $beschrijving);
                                        $beschrijving = trim($beschrijving);

                                        echo $beschrijving;
                                    }
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="Vertical_Line"></div>

                <?php
                $huidigbod = '';

                // Haal het huidige bod op
                $sqlBod = 'SELECT BodBedrag FROM Bod WHERE Voorwerp = ? order by BodDagTijd  ';
                if ($sthBod = $dbh->prepare($sqlBod)) {
                    if ($sthBod->execute(array($_GET["ID"]))) {
                        while ($rowBod = $sthBod->fetch()) {
                            $huidigbod = $rowBod['BodBedrag'];
                            // if ($huidigbod <= $startprijs) {
                            //     $huidigbod = $startprijs;
                            // }
                        }
                    }
                }
                ?>

                <div class="uk-width-1-1 uk-width-2-3@s Card-Empty">
                    <h2>Bieding</h2>
                    <div class="uk-flex Bieding">
                        <div class="uk-width-1-2">
                            <h3>Tijd resterend: </h3>
                            <?php require_once('includes/database.php');
                            include('includes/timer.php'); ?>
                        </div>
                        <div class="uk-width-1-2">
                            <h3>Huidig bod: </h3>
                            <?php echo "<h1>" . $valuta . (double)$huidigbod . "</h1>"; ?>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * from Bod where Voorwerp = ? order by BodDagTijd desc ";
                    $sth = $dbh->prepare($sql);
                    $bod = "";
                    $datumTijd = "";
                    $bieder = "";


                    if ($sth->execute(array($_GET["ID"]))) {

                        while ($alles = $sth->fetch()) {
                            $bod .= "<p>" . $valuta . (double)$alles['BodBedrag'] . "</p>";
                            $bieder .= "<p>$alles[Gebruiker]</p>";
                            $datumTijd .= "<p>" . substr($alles['BodDagTijd'], 0, 19) . " </p>";
                        }
                    }
                    ?>
                    <h2>Vorige biedingen</h2>
                    <div class="uk-flex scrollbox Vorige-Bieder uk-visible@m">
                        <div class="uk-width-1-3">
                            <h3>Naam bieder</h3>
                            <?php echo $bieder ?>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Bod</h3>
                            <?php echo $bod ?>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Datum en tijd van bieding</h3>
                            <?php echo $datumTijd ?>
                        </div>
                    </div>
                    <div class="uk-flex scrollbox Vorige-Bieder uk-hidden@s">
                        <div class="uk-width-1-3">
                            <h3>Naam</h3>
                            <?php echo $bieder ?> </p>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Bod</h3>
                            <?php echo $bod ?>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Datum</h3>
                            <?php echo $datumTijd ?>
                        </div>
                    </div>

                    <div class="flex-column-phone Verkoper">
                        <div class="uk-width-1-2@s uk-wdith-1-1 ">
                            <?php
                            $sql = "SELECT Verkoper FROM Voorwerp WHERE VoorwerpNummer = ? ";
                            $sth = $dbh->prepare($sql);
                            if ($sth->execute(array($_GET["ID"]))) {
                                while ($alles = $sth->fetch()) {
                                    echo "<h2>Verkoper: $alles[Verkoper]</h2>";
                                }
                            }

                            $sql = "SELECT DatumMakenAccount FROM Gebruiker where Gebruikersnaam in (
                                select Verkoper from Voorwerp where VoorwerpNummer = ?
                                )";
                            $sth = $dbh->prepare($sql);
                            if ($sth->execute(array($_GET["ID"]))) {
                                while ($alles = $sth->fetch()) {
                                    echo "<h4>Lid sinds: $alles[DatumMakenAccount]</h4>";
                                    
                                }
                            }

                        
                            ?>
                        </div>
                        <div class="uk-width-1-2@s uk-wdith-1-1 Plaats-Bod">
                            <div class="uk-flex">
                                <div class="uk-width-2-3@s uk-wdith-1-1">
                                    <form class="Bieden" method="post" action="includes/bieden.inc.php">
                                        <?php
                                        $sql = "SELECT top 1 * from Bod where Voorwerp = ? order by BodDagTijd desc";
                                        $sql2 = "SELECT StartPrijs FROM Voorwerp WHERE VoorwerpNummer = ?";
                                        if ($sth = $dbh->prepare($sql2)) {
                                            if ($sth->execute(array($_GET["ID"]))) {
                                                while ($row = $sth->fetch()) {
                                                    $minimumVerhoging = $row['StartPrijs'];
                                                    $bod =  $minimumVerhoging;
                                                    // if ($bod > 1 && $bod <= 50) {
                                                    //     $minimumVerhoging = $minimumVerhoging + 0.5;
                                                    // } else if ($bod > 50 && $bod <= 500) {
                                                    //     $minimumVerhoging = $minimumVerhoging + 1;
                                                    // } else if ($bod > 500 && $bod <= 1000) {
                                                    //     $minimumVerhoging =  $minimumVerhoging + 5;
                                                    // } else if ($bod > 1000 && $bod <= 5000) {
                                                    //     $minimumVerhoging =  $bod + 10;
                                                    // } else if ($bod >  5000) {
                                                    //     $minimumVerhoging = $minimumVerhoging  + 50;
                                                    // }
                                                }
                                            }
                                        }


                                        if ($sth = $dbh->prepare($sql)) {
                                            if ($sth->execute(array($_GET["ID"]))) {
                                                while ($row = $sth->fetch()) {
                                                    $bod = $row['BodBedrag'];
                                                    if ($bod > 1 && $bod <= 50) {
                                                        $minimumVerhoging = $row['BodBedrag'] + 0.5;
                                                    } else if ($bod > 50 && $bod <= 500) {
                                                        $minimumVerhoging = $row['BodBedrag'] + 1;
                                                    } else if ($bod > 500 && $bod <= 1000) {
                                                        $minimumVerhoging =  $row['BodBedrag'] + 5;
                                                    } else if ($bod > 1000 && $bod <= 5000) {
                                                        $minimumVerhoging =  $bod + 10;
                                                    } else {
                                                        $minimumVerhoging =  $row['BodBedrag'] + 50;
                                                    }
                                                }
                                            }
                                        }
                                        echo " <input class=\"uk-input Bod-Veld\" type=\"number\" min=\"$minimumVerhoging\" max=\"10000000\" step=\"0.01\" name=\"bod\" placeholder=\"bod .....\">";
                                        ?>


                                </div>
                                <div class="uk-button uk-width-1-3@s uk-wdith-1-1">
                                    <input type="submit" class="Bod-Plaatsen" value="Plaats bod">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php
                         $sql = "SELECT Mailadres from Gebruiker where Gebruikersnaam in (
                            select Verkoper from Voorwerp where VoorwerpNummer = ?
                            )";
                        $sth = $dbh->prepare($sql);
                        if ($sth->execute(array($_GET["ID"]))) {
                            while ($alles = $sth->fetch()) {
                                echo "<h4 class=\"verkoop-Email\"> Emailadres: $alles[Mailadres]</h4>";
                                
                            }
                        }

                         $sql = "SELECT Telefoonnummer from Gebruikerstelefoon where Gebruiker in (
                            select Verkoper from Voorwerp where VoorwerpNummer = ?)";
                        $sth = $dbh->prepare($sql);
                        if ($sth->execute(array($_GET["ID"]))) {
                            while ($alles = $sth->fetch()) {
                                echo "<h4 class=\"verkoop-Telefoon\">Telefoonnummer: $alles[Telefoonnummer]</h4>";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>