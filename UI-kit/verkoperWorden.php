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
            <div class="verkoper" uk-filter="target: .js-filter">
                <h2> Aanmaken verkoopaccount </h2>
                <p class="voorwaarden">Kies hieronder uw gewenste identificatie methode.</p>
                <ul class="uk-subnav uk-subnav-pill">
                    <li class="uk-active" uk-filter-control=".tag-post"><a href="#">Post</a></li>
                    <li uk-filter-control=".tag-creditcard"><a href="#">Creditcard</a></li>
</ul>

                <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid>
                    <li class="tag-creditcard verkoopbox">
                        <div class="verkoopbox">
                            <h3>Identificatiemethode creditcard:</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                            <label for="creditcard">Creditcard nummer</label><br>
                            <input class="uk-input input-registratie" type="number" name="creditcard" id="creditcard"><br>
                            <button name="verkoopaccountActiveren" type="submit" class="uk-button knop-lang">Verkoopaccount activeren</button>
                            </form>
                        </div>
                    </li>
                    <li class="tag-post verkoopbox">
                        <div class="verkoopbox">
                            <h3>Identificatiemethode post:</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                            <label for="bank">Bank</label><br>
                            <input class="uk-input input-registratie" type="text" name="bank" id="bank"><br>
                            <label for="rekeningnummer">Rekeningnummer</label><br>
                            <input class="uk-input input-registratie" type="text" name="rekeningnummer" id="rekeningnummer"><br>
                            <label for="bevestigingsnummer">Bevestigingsnummer</label><br>
                            <input class="uk-input input-registratie" type="number" name="bevestigingsnummer" id="bevestigingsnummer"><br>
                            <button name="verkoopaccountActiveren" type="submit" class="uk-button knop-lang">Verkoopaccount activeren</button>
                            </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>