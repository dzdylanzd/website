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
    <?php include 'includes\nav-L-M.php'; ?>
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

            <div class="  flex-column-phone">
                <div class="uk-width-1-5@m uk-text-center@s uk-text-left@m ">


<div class="catogorieNav"  >
                    <?php require_once('includes\catogorie _nav.php'); ?>
</div>
                </div>
                <div class="uk-width-4-5@m ">

                    <?php
                    if (!isset($_GET["root"])) {
                        include 'includes/display_product.php';
                        $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");
                        if ($stmt->execute(array(-1))) {
                            while ($row = $stmt->fetch()) {
                                $TITELS = $dbh->prepare("SELECT Titel from items where Categorie = ?");
                                if ($TITELS->execute(array($row["ID"]))) {
                                    $row2 = $TITELS->fetch();
                                    if ($row2  > 0) {
                                        echo "<br><br><br> <h1> $row[Name]</h1> <br> ";
                                        while ($row2 = $TITELS->fetch()) {
                                            echo "$row2[Titel] <br>";
                                        }
                                    }
                                }
                            }
                        }
                        $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

                        if ($stmt->execute(array(-1))) {
                            while ($row = $stmt->fetch()) {
                                echo'<div class="ItemsSlider">';
                                echo "<h1> $row[Name] </h1>";
                                displayCatogorie($row["ID"], $dbh);
                               echo' </div>';
                            }
                        }
                    }
                    if (isset($_GET["root"])) {
                        include 'includes/display_product.php';
                        $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");
                        if ($stmt->execute(array($_GET["root"]))) {
                            while ($row = $stmt->fetch()) {
                                $TITELS = $dbh->prepare("SELECT Titel from items where Categorie = ?");
                                if ($TITELS->execute(array($row["ID"]))) {
                                    $row2 = $TITELS->fetch();
                                    if ($row2  > 0) {
                                        echo "<br><br><br> <h1> $row[Name]</h1> <br> ";
                                        while ($row2 = $TITELS->fetch()) {
                                            echo "$row2[Titel] <br>";
                                        }
                                    }
                                }
                            }
                        }
                        $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

                        if ($stmt->execute(array($_GET["root"]))) {
                            while ($row = $stmt->fetch()) {
                                echo'<div class="ItemsSlider">';
                                echo "<h1> $row[Name] </h1>";
                                displayCatogorie($row["ID"], $dbh);
                               echo' </div>';
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