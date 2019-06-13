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
    <?php
    session_start();
    if (isset($_SESSION['userId'])) {
        header("location: index.php");
        exit();
    } else {
        session_destroy();
    }
    ?>

    <?php include 'includes\nav-L-M.php';
    require_once('includes/database.php');
    include 'includes/defaultMobileNav.php'; ?>

    <!-- Error handlers -->
    <?php if (isset($_GET['errorLogin'])) {
        if ($_GET['errorLogin'] == "leeg") {
            echo '<p class="errorLogin"> Gelieve alle velden in te vullen. </p>';
        } else if ($_GET['errorLogin'] == "sql") {
            echo '<p class="errorLogin"> De ingevulde gegevens zijn onjuist. </p>';
        } else if ($_GET['errorLogin'] == "verkeerdwachtwoord") {
            echo '<p class="errorLogin"> het wachtwoord is onjuist. </p>';
        } else if ($_GET["errorLogin"] == "geblokkeerd") {
            echo '<p class="errorLogin"> Dit account is geblokkeerd. </p>';
        }
    }
    ?>

    <div class="page-container">
        <div class="content-wrap">
            <div class="inloggen">
                <form method="post" action="includes/login.inc.php">
                    <div class="uk-margin">
                        <div class="uk-inline registreerbox">
                            <h1>Inloggen</h1>
                            <label class="registreerlabel" for="gebruikersnaam">Gebruikersnaam</label><br>
                            <input class="uk-input input-registratie" name="gebruikersnaam" type="text"><br>
                            <label class="registreerlabel" for="wachtwoord">Wachtwoord</label><br>
                            <input class="uk-input input-registratie" name="wachtwoord" type="password"><br>

                            <button class="knop-inloggen uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button><br>
                </form>
                <a class="uk-link-muted" href="wachtwoordVergeten.php">
                    <p class="witte-tekst">Wachtwoord vergeten?</p>
                </a><br>
                <a class="uk-link-muted" href="email-Bevestiging.php">
                    <p class="witte-tekst">Heeft u nog geen account? U kunt hier registreren.</p>
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>