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
            <?php
            if (isset($_GET['error'])) {
                $errorBericht = ($_GET['error']);
                switch ($errorBericht) {
                    case 1:
                        echo '<p class="errors">Vul alle velden in</p>';
                        break;
                    case 3:
                        echo '<p class="errors">De gebruikersnaam is al in gebruik</p>';
                    case 4:
                        echo '<p class="errors">De wachtwoorden komen niet overeen</p>';
                        break;
                    case 5:
                        echo '<p class="errors">Een of meerdere invoervelden bevatten teveel tekens</p>';
                        break;
                    case 6:
                        echo '<p class="errors">De gebruikersnaam bevat een speciaal teken</p>';
                        break;
                    case 7:
                        echo '<p class="errors">SQL error, probeer het opnieuw</p>';
                        break;
                    default:
                        echo '<p class="errors">Onverwachte error, probeer het opnieuw';
                }
            }
            ?> <form method="post" action="includes/login.inc.php">

                <div class="uk-margin">
                    <div class="uk-inline">
                        <h2>Inloggen</h2>
                        <label class="" for="gebruikersnaam">Gebruikersnaam *</label><br>
                        <input class="uk-input" name="gebruikersnaam" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-inline">
                        <label class="" for="wachtwoord">Wachtwoord *</label><br>
                        <input class="uk-input" name="wachtwoord" type="password">
                    </div>
                </div>
                <button class="loginknop uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button>
            </form>
            <a class="uk-link-muted" href="wachtwoordVergeten.php">Wachtwoord vergeten?</a><br>
            <a class="uk-link-muted" href="email-Bevestiging.php">Heeft u nog geen account? U kunt hier registreren.</a>
            
            <?php
            if (isset($_GET["errorLogin"])) {
                if ($_GET["errorLogin"] == "leeg") {
                    echo "<br> <p class=\"errorLogin\"> Niet alle velden zijn ingevuld </p>";
                }
                if ($_GET["errorLogin"] == "GebruikerBestaatNiet") {
                    echo "<br> <p class=\"errorLogin\"> Deze gebruiker bestaat niet </p>";
                }
                if ($_GET["errorLogin"] == "verkeerdwachtwoord") {
                    echo "<br> <p class=\"errorLogin\"> Onjuist wachtwoord </p>";
                }
                if ($_GET["errorLogin"] == "sql") {
                    echo "<br> <p class=\"errorLogin\"> Er is een fout opgelopen, probeer het opnieuw </p>";
                 }
            }else{
                header("location: index.php");
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>