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
    <?php include 'includes/display_product.php';
    include 'includes\nav-L-M.php';
    include 'includes/defaultMobileNav.php'; ?>
    <div class="page-container">
        <div class="content-wrap">

            <!-- categorie nav S (mobile) -->
            <div class="uk-hidden@m">
                <button class="uk-button-categorieen uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple; animation: uk-animation-slide-bottom">Rubrieken</button>
                <div id="toggle-animation-multiple" class="uk-card uk-card-default uk-card-body">
                    <div class=" CategorieNavigatieBox">
                        <!-- <script>
                            UIkit.toggle('.uk-card').toggle();
                        </script> -->
                        <h1>Rubrieken</h1>
                        <div class="scrollbox categorieNav">
                            <?php require_once('includes\categorie _nav.php'); ?>
                        </div>
                        <h3> Staat</h3>
                        <form class="FilterenStaat" action="categorieen.php" method="post">
                            <input type="radio" name="staat" value="Nieuw"> Nieuw<br>
                            <input type="radio" name="staat" value="bijnaNieuw"> Zo goed als nieuw<br>
                            <input type="radio" name="staat" value="Gebruikt"> Gebruikt<br>

                            <h3> Prijs</h3>

                            <label for="prijsVan"> Van</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsVan">
                            <label for="prijsTot"> Tot</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsTot">
                        </form>


                    </div>
                </div>
            </div> <!-- categorie nav M (desktop) -->
            <div class="uk-flex">
                <div class="uk-width-1-3 uk-visible@m">
                    <div class=" CategorieNavigatieBox">
                        <h1>Rubrieken</h1>
                        <div class="scrollbox categorieNav">
                            <?php
                            require_once('includes\database.php');
                            if (!isset($_GET["root"])) {
                                $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

                                if ($stmt->execute(array(-1))) {
                                    echo "<ul class=\"noDots\">";
                                    while ($row = $stmt->fetch()) {
                                        if ($row["Rubrieknummer"] != -1) {
                                            echo "<li> <a class=\"uk-link-heading\" href=\"zoeken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a></li>";
                                        }
                                    }
                                    echo "</ul>";
                                }
                            } else {

                                $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                                if ($stmt->execute(array($_GET["root"]))) {

                                    while ($row = $stmt->fetch()) {
                                        if ($row["Rubrieknummer"] != -1) {
                                            $text = $row["Rubrieknaam"];
                                            $parent = $row["Volgnr"];

                                            while ($parent > 0) {
                                                $stmt2 = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                                                if ($stmt2->execute(array($parent))) {
                                                    while ($row2 = $stmt2->fetch()) {
                                                        $text =  "<a class=\"uk-link-heading\" href=\"zoeken.php?root=$row2[Rubrieknummer]\">  $row2[Rubrieknaam] </a> /  $text";
                                                        $parent = $row2["Volgnr"];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $text = "<div> $text </div>";
                                    echo $text;
                                    echo "<div class=\"-margin20\"></div>";
                                }



                                echo "<ul class=\"noDots\">";
                                if ($_GET["root"] != -1) {
                                    $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                                    if ($stmt->execute(array($_GET["root"]))) {

                                        while ($row = $stmt->fetch()) {
                                            if ($row["Volgnr"] == -1) {
                                                echo "<li> <a class=\"categorie-terug\" href=\"zoeken.php\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
                                            } else {
                                                echo "<li> <a class=\"categorie-terug\" href=\"zoeken.php?root=$row[Volgnr]\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
                                            }
                                        }
                                    }
                                }
                                $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

                                if ($stmt->execute(array($_GET["root"]))) {
                                    if ($row = $stmt->fetch() > 0) {
                                        $stmt->execute(array($_GET["root"]));
                                        while ($row = $stmt->fetch()) {
                                            if ($row["Rubrieknummer"] != -1) {
                                                echo "<li> <a class=\"uk-link-heading\" href=\"zoeken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a> </li>  ";
                                            }
                                        }
                                    } else {
                                        $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                                        if ($stmt->execute(array($_GET["root"]))) {

                                            while ($row = $stmt->fetch()) {
                                                if ($row["Rubrieknummer"] != -1) {
                                                    echo "<li> <a class=\"uk-link-heading\" href=\"zoeken.php?root=$row[Volgnr]\">  $row[Rubrieknaam] </a> </li>  ";
                                                }
                                            }
                                        }
                                    }
                                    echo "</ul >";
                                }
                            }
                            ?>
                        </div>


                        <?php
                        if (isset($_GET['root'])) {
                            $fromAction = "zoeken.php?root=$_GET[root]";
                        } else {
                            $fromAction = "zoeken.php";
                        }

                        ?>
                        <form class="FilterenStaat" action="<?php echo $fromAction ?>" method="post">
                            <h3> Staat</h3>
                            <input class="uk-input input-registratie" type="text" id="staat" name="staat"><br>


                            <h3> Prijs</h3>

                            <label for="prijsVan"> Van</label>
                            <input class="FilterenPrijs" type="text" name="prijsVan" id="prijsVan">
                            <label for="prijsTot"> Tot</label>
                            <input class="FilterenPrijs" type="text" name="prijsTot" id="prijsTot">
                            <button type="submit" name="bevestigings-button" class="uk-button uk-button-default">filteren</button>
                        </form>
                    </div>
                </div>
                <div class="uk-width-3-4">
                    <?php
                    if (isset($_GET['root'])) {
                        $nummer = $_GET['root'];
                    } else {
                        $nummer = -1;
                    }

                    $naarBenedenNav = "and Rubriekoplaagsteniveau in(
    SELECT Rubrieknummer from Rubriek where Volgnr = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ))) or Rubrieknummer = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )))) or Rubrieknummer = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ))) or Rubrieknummer = any(
    select Rubrieknummer from Rubriek where Volgnr = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer )) or Rubrieknummer = any(
    SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ) or Rubrieknummer = any(
    
    SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ))))
    ) and IsVeilingGesloten = 0";




                    if (isset($_POST['search'])) {
                        $_SESSION['search'] = $_POST['search'];
                    } else if (!isset($_SESSION['search'])) {
                        $_SESSION['search'] = "";
                    }





                    if (isset($_POST['prijsVan'])) {
                        if (empty($_POST['prijsVan'])) {
                            $prijsvan = 0;
                        } else {
                            $prijsvan = $_POST['prijsVan'];
                        }
                    } else {
                        $prijsvan = 0;
                    }

                    if (isset($_POST['prijsTot'])) {
                        if (empty($_POST['prijsTot'])) {
                            $prijstot = 999999999;
                        } else {
                            $prijstot = $_POST['prijsTot'];
                        }
                    } else {
                        $prijstot = 9999999999;
                    }

                    if (!empty($_POST['staat'])) {

                        $staat = $_POST['staat'];
                        echo $staat;


                        $sql = "SELECT * from Voorwerp inner join Thumbnail on Thumbnail.VoorwerpNummer = Voorwerp.VoorwerpNummer inner join VoorwerpInRubriek on VoorwerpInRubriek.Voorwerp = Voorwerp.VoorwerpNummer
                         where Titel like ? and Voorwerp.StartPrijs BETWEEN ? AND ?  " . $naarBenedenNav;
                        if ($sth = $dbh->prepare($sql)) {

                            if ($sth->execute(array("%{$_SESSION['search']}%", $prijsvan, $prijstot))) {
                                $gelukt = true;
                            } else {
                                $gelukt = false;
                            }
                        }
                    } else {
                        $sql = "SELECT * from Voorwerp inner join Thumbnail on Thumbnail.VoorwerpNummer = Voorwerp.VoorwerpNummer inner join VoorwerpInRubriek on VoorwerpInRubriek.Voorwerp = Voorwerp.VoorwerpNummer
                        where Titel like ? and Voorwerp.StartPrijs BETWEEN ? AND ?  " . $naarBenedenNav;
                        if ($sth = $dbh->prepare($sql)) {

                            if ($sth->execute(array("%{$_SESSION['search']}%", $prijsvan, $prijstot))) {
                                $gelukt = true;
                            } else {
                                $gelukt = false;
                            }
                        }
                    }

                    if ($gelukt) {
                        echo '<div class="flex-column-phone uk-flex-center uk-flex-wrap uk-flex-wrap-around">';

                        while ($alles = $sth->fetch()) {

                            if (strpos($alles['Thumbnailfile'], "img") !== false) {
                                $alles['Thumbnailfile'] = "http://iproject5.icasites.nl/thumbnails/" . $alles['Thumbnailfile'];
                            } else {
                                $alles['Thumbnailfile'] = $alles['Thumbnailfile'];
                            }

                            $thumbnail = $alles['Thumbnailfile'];
                            $valuta = $alles['Valuta'];
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

                            $sql5 = "SELECT TOP 1 * FROM bod WHERE Voorwerp = ? ORDER BY BodDagTijd desc ";
                            if ($sth5 = $dbh->prepare($sql5)) {
                                if ($sth5->execute(array($alles['VoorwerpNummer']))) {
                                    if ($prijsje = $sth5->fetch()) {
                                        $prijs = (double)$prijsje['BodBedrag'];
                                        $geboden = "Huidig bod:";
                                    } else {
                                        $prijs = (double)$alles['StartPrijs'];
                                        $geboden = "Startprijs:";
                                    }
                                }
                            }

                            echo "<br>";
                            echo '<div class=" zoekbox">';
                            echo $alles['Titel'];
                            echo '<a href="productPage.php?ID=' . $alles['VoorwerpNummer'] . '"><img class="mijn-veilingen-thumbnail" src="' . $alles['Thumbnailfile'] . '" alt="Thumbnail"></a><br>';
                            echo "<p>  $geboden $valuta $prijs</p>";
                            echo '</div>';
                        }
                    }

                    echo '</div>'



















                    ?>

                </div>
            </div>

        </div>
    </div>
    </div>
</body>
<?php include 'includes/footer.inc.php'; ?>

</html>