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
    include 'includes/display_product.php'; 
    include 'includes/defaultMobileNav.php';
    ?>

    <div class="page-container">
        <div class="content-wrap">
            <div class="flex-column-phone">
                <div class="uk-width-1-5@m uk-text-center@s uk-text-left@m ">
                    <button class="uk-button uk-button-default uk-hidden@s" type="button" uk-toggle="target: #toggle-animation-multiple; animation: uk-animation-slide-bottom">Rubrieken</button>
                    <div id="toggle-animation-multiple" class="uk-card uk-card-default uk-card-body uk-hidden@s">
                        <div class="categorieNavHomepagina">
                            <!-- <script>
                                UIkit.toggle('.uk-card').toggle();
                            </script> -->
                            <h1>Rubrieken</h1>
                            <?php require_once('includes\categorie _nav.php'); ?>
                        </div>
                    </div>
                    <div class="categorieNavHomepagina uk-visible@s">

                        <h1>Rubrieken</h1>
                        <?php include('includes\categorie _nav.php'); ?>
                    </div>
                </div>
                <div class="uk-width-4-5@m ">
                    <div class="margin"> </div>
                    <?php
                    /* Tijdelijke Laatste kans en nieuw box */
                    echo '<div class="ItemsSliderGroen">';
                
                    echo "<h1> Laatste kans! </h1>";
                  
                    echo '</div>';
                    echo '<div class="ItemsSliderGroen">';
                    echo "<h1> Nieuw </h1>";
                    include('includes/nieuweVeilingen.php');
                    echo '</div>';

                    // Favoriete rubrieken 
                    $nietLatenZien = array(0, 0, 0);
                    if (isset($_SESSION['userId'])) {
                        $sql = "select * from voorkeur where gebruikersnaam = ?";
                        if ($sth = $dbh->prepare($sql)) {
                            if ($sth->execute(array($_SESSION['userId']))) {
                                $index = 0;
                                while ($row = $sth->fetch()) {
                                    $nietLatenZien[$index] = $row['Categorie'];
                                    $sth2 = $dbh->prepare("SELECT * FROM Rubriek WHERE Rubrieknummer  = ? ");

                                    if ($sth2->execute(array($row['Categorie']))) {
                                        while ($row2 = $sth2->fetch()) {
                                            if ($row2["Rubrieknummer"] != -1) {
                                                $text = "";
                                                $text = $text . '<div class="ItemsSliderGroen">';
                                                $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row2[Rubrieknummer]\"> <h1>  $row2[Rubrieknaam] </h1> </a>";
                                                if (displayCategorie($row2["Rubrieknummer"], $dbh, 100) != 123) {
                                                    $text = $text . displayCategorie($row2["Rubrieknummer"], $dbh, 100);
                                                    $text = $text . ' </div>';
                                                    echo $text;
                                                }
                                            }
                                        }
                                    }
                                    $index++;
                                }
                            }
                        }
                    }
                    // Display producten alle rubrieken, deze hebben een zandkleur
                    if (isset($_GET["root"])) {

                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE Rubrieknummer  = ? ");

                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = $text . '<div class="ItemsSlider">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h1>  $row[Rubrieknaam] </h1> </a>";
                                    if ((displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123)) {
                                        if (!($nietLatenZien[0] == $row["Rubrieknummer"] || $nietLatenZien[1] == $row["Rubrieknummer"] || $nietLatenZien[2] == $row["Rubrieknummer"])) {
                                            $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                            $text = $text . ' </div>';
                                            echo $text;
                                        }
                                    } else {
                                        echo "<h4 class=\"geenProducten\"> excusses er zijn geen veilingen in deze categorie</h4>";
                                    }
                                }
                            }
                        }
                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE volgnr = ?");

                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = "";
                                    $text = $text . '<div class="ItemsSlider">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h1>  $row[Rubrieknaam] </h1> </a>";
                                    if ((displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123)) {
                                        if (!($nietLatenZien[0] == $row["Rubrieknummer"] || $nietLatenZien[1] == $row["Rubrieknummer"] || $nietLatenZien[2] == $row["Rubrieknummer"])) {
                                            $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                            $text = $text . ' </div>';
                                            echo $text;
                                        }
                                    }
                                }
                            }
                        }
                    } else {

                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE Rubrieknummer  = ? ");

                        if ($sth->execute(array(-1))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = "";
                                    $text = $text . '<div class="ItemsSlider">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h1>  $row[Rubrieknaam] </h1> </a>";
                                    if ((displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123)) {
                                        if (!($nietLatenZien[0] == $row["Rubrieknummer"] || $nietLatenZien[1] == $row["Rubrieknummer"] || $nietLatenZien[2] == $row["Rubrieknummer"])) {
                                            $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                            $text = $text . ' </div>';
                                            echo $text;
                                        }
                                    } else {
                                        echo "<h4 class=\"geenProducten\"> excusses er zijn geen veilingen in deze categorie</h4>";
                                    }
                                }
                            }
                        }
                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE volgnr = ?");

                        if ($sth->execute(array(-1))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = "";
                                    $text = $text . '<div class="ItemsSlider">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h1>  $row[Rubrieknaam] </h1> </a>";
                                    if ((displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123)) {
                                        if (!($nietLatenZien[0] == $row["Rubrieknummer"] || $nietLatenZien[1] == $row["Rubrieknummer"] || $nietLatenZien[2] == $row["Rubrieknummer"])) {
                                            $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                            $text = $text . ' </div>';
                                            echo $text;
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
    </div>
    <?php include 'includes/footer.inc.php'; ?>

</body>

</html>