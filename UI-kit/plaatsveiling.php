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

            <h2>Veiling plaatsen</h2>

            <!-- fotos plaatsen -->
            <div>
                <h3 id=testluuk>Foto's</h3>
            </div>

            <!-- Algemene informatie -->
            <div>
                <h3 id=testluuk>Algemene informatie</h3>
                <input type="text">
            </div>

            <!-- Veilinginformatie -->
            <div>
                <h3 id= testluuk>Veilinginformatie</h3>
                <form>
                <input class=".uk-form-width-large" placeholder="Titel">
                <!-- dropdown menu staat vab product -->
                
                
            </div>

            <!-- Locatie van product -->
            <div>
                <h3 id=testluuk>Locatie van product</h3>
            </div>









            <?php include 'includes/footer.inc.php'; ?>

</body>

</html>