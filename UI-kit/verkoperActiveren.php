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
                            <a class="uk-margin-left" href="inloggen-Mobile.php" uk-icon="icon: user"></a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="verkoper" uk-filter="target: .js-filter">
                <h2> Activeren verkoopaccount </h2>
                <p class="voorwaarden">Voer hier uw veificatiecode in die u per mail ontvangen heeft.</p>
                <div class="verkoopbox">
                    <h3>Activeren</h3>
                    <form method="post" action="includes/verkoperActiveren.inc.php">
                        <label for="verificatiecode">Verificatiecode</label><br>
                        <input class="uk-input input-registratie" type="text" name="verificatiecode" id="verificatiecode"><br>
                        <button name="verkoopaccountActiveren" type="submit" class="uk-button knop-lang">Verkoopaccount activeren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>