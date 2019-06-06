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
    include 'includes/defaultMobileNav.php';?>
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
                        <select class="uk-select input-registratie" name="staat" id="staat"><br>
                            <option value="">...</option>
                                <option value="Nieuw">Nieuw</option>
                                <option value='Zo goed als nieuw'>Zo goed als nieuw</option>
                                <option value='Gebruikt'>Gebruikt</option>
                            </select>
                       
                        <h3> Prijs</h3>
                    
                            <label for="prijsVan"> Van</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsVan">
                            <label for="prijsTot"> Tot</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsTot">
                            <button type="submit" name="bevestigings-button" class="uk-button uk-button-default">filteren</button>
                        </form>
                       
                  
                    </div>
                </div>
            </div> <!-- categorie nav M (desktop) -->
            <div class="uk-flex">
                <div class="uk-width-1-3 uk-visible@m">
                    <div class=" CategorieNavigatieBox">
                        <h1>Rubrieken</h1>
                        <div class="scrollbox categorieNav">
                            <?php require 'includes\categorie _nav.php'; ?>
                        </div>
                       
                        <?php  
                if(isset($_GET['root'])){
                    $fromAction = "zoeken.php?root=$_GET[root]";
                }else{
                    $fromAction = "zoeken.php";
                }
                
                ?>
                        <form class="FilterenStaat" action="<?php echo$fromAction ?>" method="post">
                        <h3> Staat</h3>
                        <input class="uk-input input-registratie" type="text" id="staat" name="staat"><br>
                           
                       
                        <h3> Prijs</h3>
                    
                            <label for="prijsVan"> Van</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsVan">
                            <label for="prijsTot"> Tot</label>
                            <input class="FilterenPrijs" type="text" name="prijs" id="prijsTot">
                            <button type="submit" name="bevestigings-button" class="uk-button uk-button-default">filteren</button>
                        </form>
                    </div>
                </div>
                <div class="uk-width-3-4">
                    <?php
                    if (isset($_GET["root"])) {

                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE Rubrieknummer  = ? ");

                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = "";
                                    $text = $text . '<div class="ItemsSliderDonkerGroenRubrieken">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h1>  $row[Rubrieknaam] </h1> </a>";
                                    if (displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123) {
                                        $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                        $text = $text . ' </div>';
                                        echo $text;
                                    } else {
                                        echo "<h4 class=\"geenProducten\"> Excuses, er zijn geen producten weer te geven uit deze rubriek.</h4>";
                                    }
                                }
                            }
                        }
                        $sth = $dbh->prepare("SELECT * FROM Rubriek WHERE volgnr = ?");

                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                if ($row["Rubrieknummer"] != -1) {
                                    $text = "";
                                    $text = $text . '<div class="ItemsSliderGroenRubrieken">';
                                    $text = $text . "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\"> <h3>  $row[Rubrieknaam] </h3> </a>";
                                    if (displayCategorie($row["Rubrieknummer"], $dbh, 100) != 123) {
                                        $text = $text . displayCategorie($row["Rubrieknummer"], $dbh, 100);
                                        $text = $text . ' </div>';
                                        echo $text;
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
    </div>
</body>
<?php include 'includes/footer.inc.php'; ?>

</html>