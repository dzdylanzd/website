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
            <div class="uk-flex-center uk-flex-column">
                <!-- Error handlers -->
                <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == "leegveld") {
                        echo '<p class="errors"> Voer een code in </p>';
                    } else if ($_GET['error'] == "legeemail") {
                        echo '<p class="errors"> Voer uw e-mailadres in </p>';
                    } else if ($_GET['error'] == "codeNietMeerValide") {
                        echo '<p class="errors"> De ingevoerde code is niet meer geldig </p>';
                    } else if ($_GET['error'] == "nietDeGoedeCode") {
                        echo '<p class="errors"> De ingevoerde code wordt niet herkent </p>';
                    } else if ($_GET['error'] == "succes") {
                        echo '<p class="succes"> Er is een code naar uw e-mailadres verzonden </p>';
                    } 
                }
                ?>
                <div class="registreren">
                    <h2>Registreren</h2>
                </div>
                <form method="post" action="zendMail.php">
                    <div class="email-box">
                        <h3>E-mail bevestiging</h3>
                        <p>Beste bezoeker,<br> voordat u een gebruiker aan kunt maken moet u eerst uw e-mail adres bevestigen. <br>
                            Dit doet u door uw e-mail in te geven en op 'E-mail bevestigen' te klikken.
                        </p>
                        <label for="emailbevestiging">E-mail:</label><br>
                        <input class="uk-input input-registratie" type="email" name="emailbevestiging" id="emailbevestiging">
                        <button class="uk-button knop-email">E-mail bevestigen</button>
                    </div>
                </form>
                <div class="email-box">
                    <h3> Bevestigingscode </h3>
                    <p> Voer hier de bevestigingscode in die u per mail heeft ontvangen.</p>
                    <form method="post" action="includes/checkCode.inc.php">
                        <label for="bevestigingscode">Bevestigingscode:</label><br>
                        <input class="uk-input input-registratie" type="password" id="bevestigingscode" name="bevestigingscode">
                        <button class="uk-button knop-email">Bevestigen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>