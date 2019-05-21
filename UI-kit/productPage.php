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
    $_SESSION['PID'] = $_GET["ID"];
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
                        while ($alles = $sth->fetch()) {
                            $image = "src=\"http://iproject5.icasites.nl/pics/$alles[IllustratieFile]\" ";
                            $sliderFotos = "$sliderFotos <li class=\"Image-Border\">
                                <img $image alt=\"\" uk-cover>
                            </li>";
                            $knoppenFotos = "$knoppenFotos <img $image class=\"uk-width-1-4 \" alt=\"D\" onclick=\"UIkit.slideshow('.uk-slideshow').show($index);\">";
                            $index++;
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

                    $sql = "SELECT Staat FROM Voorwerp WHERE Voorwerpnummer = ? ";
                    $sth = $dbh->prepare($sql);
                    if ($sth->execute(array($_GET["ID"]))) {
                        while ($alles = $sth->fetch()) {
                            echo "<h4 class= \"uk-text-emphasis\"> Staat: $alles[Staat] </h4>";
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
                                   $bod .="<h5>$alles[BodBedrag]</h5>";
                                   $bieder .="<h5>$alles[Gebruiker]</h5>";
                                   $datumTijd .="<h5>" . substr($alles['BodDagTijd'],0,19) ." </h5>";
                                }
                            }
                            ?>
                    <h2>Vorige biedingen</h2>
                    <div class="uk-flex scrollbox Vorige-Bieder ">
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
                            ?>
                        </div>
                        <div class="uk-width-1-2@s uk-wdith-1-1 Plaats-Bod">
                            <div class="uk-flex">
                                <div class="uk-width-2-3@s uk-wdith-1-1">
                                    <form class="Bieden" method="post" action="includes/bieden.inc.php">
                                    <?php
 $sql = "SELECT top 1 * from Bod where Voorwerp = ? order by BodDagTijd desc";
 $bod = 0;
 $minimumVerhoging = 0.5;
 if ($sth = $dbh->prepare($sql)) {
     if ($sth->execute(array($_GET["ID"]))) {
         while ($row = $sth->fetch()) {
             $bod = $row['BodBedrag'];
             if($bod > 1 && $bod <= 50 ){
                $minimumVerhoging = 0.5;
             }else if($bod > 50 && $bod <= 500 ){
                $minimumVerhoging = 1;
             }else if($bod > 500 && $bod <= 1000 ){
                $minimumVerhoging = 5;
            }else if($bod > 1000 && $bod <= 5000 ){
                $minimumVerhoging = 10;
            }else{
                $minimumVerhoging = 50;
            }
         }
        }
    }
    echo " <input class=\"uk-input Bod-Veld\" type=\"number\" min=\"$bod\" max=\"10000000\" step=\"$minimumVerhoging\" name=\"bod\" placeholder=\"bod .....\">";
                                    ?>
                                       
                                      
                                </div>
                                <div class="uk-button uk-width-1-3@s uk-wdith-1-1">
                                    <input type="submit" class="Bod-Plaatsen" value="Plaats bod">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="reviews">
                        <?php
                        $sql = "SELECT Verkoper FROM Voorwerp WHERE VoorwerpNummer = ? ";
                        $sth = $dbh->prepare($sql);
                        if ($sth->execute(array($_GET["ID"]))) {
                            while ($alles = $sth->fetch()) {
                                echo "<h2>Reviews over $alles[Verkoper]</h2>";
                            }
                        }
                        ?>

                    </div>
                    <div class="uk-container">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>