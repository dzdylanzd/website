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
    <div class="page-container">
        <div class="content-wrap">
            <div class="inloggen">
                <form method="post" action="includes/login.inc.php">

                    <div class="uk-margin">
                        <div class="uk-inline registreerbox">
                            <h2>Inloggen</h2>
                            <label class="registreerlabel" for="gebruikersnaam">Gebruikersnaam</label><br>
                            <input class="uk-input input-registratie" name="gebruikersnaam" type="text"><br>
                            <label class="registreerlabel" for="wachtwoord">Wachtwoord</label><br>
                            <input class="uk-input input-registratie" name="wachtwoord" type="password"><br>

                            <button class="knop-registreren uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button><br>
                </form>
                <a class="uk-link-muted" href="wachtwoordVergeten.php">Wachtwoord vergeten?</a><br>
                <a class="uk-link-muted" href="email-Bevestiging.php">Heeft u nog geen account? U kunt hier registreren.</a>
            </div>
        </div>
    </div>
</div>
</div>

    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>