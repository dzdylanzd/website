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
    <?php  include 'includes/display_product.php'; include 'includes\nav-L-M.php'; ?>
    <?php header('Refresh: 100'); ?>
    <div class="page-container">
        <div class="content-wrap">




            <!-- header S (Mobile) -->
            <div class="uk-hidden@s">
                <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>

                    <div class="uk-navbar-nav  uk-flex-center">
                        <a class=" uk-logo uk-navbar-item " href="#"><img src="media\logo.png" alt="logo" width=100em></a>

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

            <!-- categorie nav S (mobile) -->
            <div class="uk-visible@s uk-hidden@m">

            </div>
            
            <!-- categorie nav M (desktop) -->
            <div class="uk-visible@m">
                <div class="uk-flex">
                    <div class="uk-width-1-3 ">
                        <div class=" CategorieNavigatieBox">
                        <h1>Rubrieken</h1>
                            <div class="scrollbox categorieNav">
                                <?php require_once('includes\categorie _nav.php'); ?>
                            
                            </div>
                            <div>
                            <h3> Staat</h3>
                            <form class="FilterenStaat" action="categorieen.php" method="post">
                                <input type="checkbox" name="nieuw" value="Nieuw"> Nieuw<br>
                                <input type="checkbox" name="bijnaNieuw" value="bijnaNieuw"> Zo goed als nieuw<br>
                                <input type="checkbox" name="gebruikt" value="Gebruikt"> Gebruikt<br>
                            </form>
                            <h3> Prijs</h3>
                            <form action="categorieen.php" method="post">
                                <label for="prijsVan"> Van</label>
                                <input class="FilterenPrijs" type="text" name="prijs" id="prijsVan">
                                <label for="prijsTot"> Tot</label>
                                <input class="FilterenPrijs" type="text" name="prijs" id="prijsTot">
                            </form>
                            <h3> Locatie</h3>
                            <form action="categorieen.php"  method="post">
                                <label for="afstand"> Binnen</label>
                                <select name="afstanden">
                                    <option value="niks"> ... </option>
                                    <option value="10km"> < 10 kilometer </option>
                                    <option value="25km"> < 25 kilometer </option>
                                    <option value="50km"> < 50 kilometer </option>
                                    <option value="100km"> < 100 kilometer </option>
                                    <option value="250km"> < 250 kilometer </option>
                                    <option value="500km"> < 500 kilometer </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-3-4">
                <?php
                if (isset($_GET["root"])) {
                    
                    $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE Rubrieknummer  = ? ");

                    if ($sth->execute(array($_GET["root"]))) {
                        while ($row = $sth->fetch()) {
                            if($row["Rubrieknummer"] != -1){
                            echo'<div class="ItemsSliderDonkerGroen">';
                            echo "<h1> $row[Rubrieknaam] </h1>";
                            displayCategorie($row["Rubrieknummer"], $dbh,100);
                            echo' </div>';
                            }
                        }
                    }
                    $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE volgnr = ?");

                    if ($sth->execute(array($_GET["root"]))) {
                        while ($row = $sth->fetch()) {
                            if($row["Rubrieknummer"] != -1){
                            echo'<div class="ItemsSliderGroen">';
                            echo "<h3> $row[Rubrieknaam] </h3>";
                            displayCategorie($row["Rubrieknummer"], $dbh,10);
                            echo' </div>';
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