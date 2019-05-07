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

            <div class="uk-hidden@s">
                <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
                    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
                        <ul class="uk-navbar-nav">
                            <li><a href="index.php" uk-icon="icon: triangle-left; ratio: 3"></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="uk-flex">
                <div class="uk-width-1-3 Card-Empty">
                    <!-- Titel -->
                    <?php
                    $sql = "SELECT Titel, Beschrijving, Prijs FROM Items WHERE ID = ? ";
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array($_GET["ID"]))) {
                        while ($alles = $sth->fetch()) {
                            echo "<h1>$alles[Titel]</h1>";
                        }
                    }

                    // foto slideshow
                    $sql = "SELECT TOP 4 IllustratieFile FROM Illustraties WHERE ItemID = ? ";
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array($_GET["ID"]))) {
                        $sliderFotos = '<div id="imageprevieuw-detailpage" class="uk-position-relative uk-visible-toggle uk-light  uk-width-4-4	uk-margin-bottom" tabindex="-1" uk-slideshow>

                        <ul class="uk-slideshow-items ">';
                        $knoppenFotos = '<div class="imagePrevieuw uk-flex">';
                        $index = 0;
                        while ($alles = $sth->fetch()) {
                            $image = "src=\"http://iproject5.icasites.nl/pics/$alles[IllustratieFile]\" ";
                            $sliderFotos = "$sliderFotos <li class=\"Image-Border\">
                            <img $image alt=\"\" uk-cover>
                        </li>";
                         $knoppenFotos = "$knoppenFotos <img $image class=\"uk-width-1-4 \" alt=\"D\" onclick=\"UIkit.slideshow('.uk-slideshow').show($index);\">";
                         $index++;
                        }
                        $sliderFotos = $sliderFotos .' </ul>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    </div>';
                        $knoppenFotos = $knoppenFotos .' </div>';
                        echo $sliderFotos;
                        echo $knoppenFotos;
                    }
                    ?>

                    <!-- Beschrijving -->
                    <?php
                        $sql = "SELECT Titel, Beschrijving, Prijs FROM Items WHERE ID = ? ";
                        $sth = $dbh->prepare($sql);
                        if ($sth->execute(array($_GET["ID"]))) {
                            while ($alles = $sth->fetch()) {
                                $beschrijving = strip_tags($alles['Beschrijving']);
                                echo $beschrijving;
                            }
                        }
                    ?>
                </div>

                

                <div class="Vertical_Line"></div>

                <div class="uk-width-2-3 Card-Empty">
                    <h2>Bieding</h2>
                    <div class="uk-flex Bieding">
                        <div class="uk-width-1-2">
                            <h3>Tijd resterend</h3>
                        </div>
                        <div class="uk-width-1-2">
                            <h3>Huidig bod: </h3>
                        </div>
                    </div>

                    <h2>Vorige biedingen</h2>
                    <div class="uk-flex Vorige-Bieder">
                        <div class="uk-width-1-3">
                            <h3>Naam bieder</h3>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Bod</h3>
                        </div>
                        <div class="uk-width-1-3">
                            <h3>Datum en tijd van bieding</h3>
                        </div>
                    </div>

                    <div class="uk-flex Verkoper">
                        <div class="uk-width-1-2 ">
                            <h2>Verkoper</h2>
                        </div>
                        <div class="uk-width-1-2 Plaats-Bod">
                            <div class="uk-flex">
                                <div class="uk-width-2-3">
                                    <form class="Bieden" action="productpage.php">
                                        <input class="uk-input Bod-Veld" type="text" name="bod" placeholder="bod .....">
                                </div>
                                <div class="uk-button uk-width-1-3">
                                    <input type="submit" class="Bod-Plaatsen" value="Plaats bod">
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="uk-container">
                    
                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>