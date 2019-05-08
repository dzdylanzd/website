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




            <!-- navigatie balk S -->
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

            <div class="uk-flex">
                <div class="uk-width-1-3 ">
                    <div class=" CategorieNavigatieBox">
                    <h1>Rubrieken</h1>
                        <div class="scrollbox categorieNav">
                            <?php require_once('includes\categorie _nav.php'); ?>
                           
                        </div>
                        <h3> Staat</h3>
                        <form action="categorieen.php" method="post">
                            <input type="checkbox">
                    </div>




                </div>
                <div class="uk-width-5-5">
                    <?php
                    "<h1> Rubrieken <h1>";
                    if (isset($_GET["root"])) {
                       
                        $sth = $dbh->prepare("SELECT * from Categorieen where ID = ?");
                        if ($sth->execute(array(-1))) {
                            while ($row = $sth->fetch()) {
                                $TITELS = $dbh->prepare("SELECT Titel from items where Categorie = ?");
                                if ($TITELS->execute(array($row["ID"]))) {
                                    $row2 = $TITELS->fetch();
                                    if ($row2  > 0) {
                                        while ($row2 = $TITELS->fetch()) {
                                            echo "$row2[Titel] <br>";
                                        }
                                    }
                                }
                            }
                        }
                        $sth = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

                        if ($sth->execute(array(-1))) {
                            while ($row = $sth->fetch()) {
                                echo'<div class="ItemsSlider">';
                                echo "<h1> $row[Name] </h1>";
                                displayCategorie($row["ID"], $dbh);
                               echo' </div>';
                            }
                        }
                    }
                    if (isset($_GET["root"])) {
                     
                        $sth = $dbh->prepare("SELECT * from Categorieen where ID = ?");
                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                $TITELS = $dbh->prepare("SELECT * from items where Categorie = ?");
                                if ($TITELS->execute(array($row["ID"]))) {
                                    $row2 = $TITELS->fetch();
                                    if ($row2  > 0) {
                                       
                                        echo'<div class="ItemsSlider">';
                                            echo "<h1> $row[Name] </h1>";
                                            displayCategorie($row["ID"], $dbh);
                                           echo' </div>';
                                        
                                    }else{
                                       echo" er is hier niks";
                                    }
                                }
                            }
                        }
                        $sth = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

                        if ($sth->execute(array($_GET["root"]))) {
                            while ($row = $sth->fetch()) {
                                echo'<div class="ItemsSlider">';
                                echo "<h1> $row[Name] </h1>";
                                displayCategorie($row["ID"], $dbh);
                                echo ' </div>';
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