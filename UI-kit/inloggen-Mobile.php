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
if(isset( $_SESSION['userId'])){

    header("location: index.php");
    exit();
}else{
    session_destroy();
}

    ?>
    <?php include 'includes\nav-L-M.php';
    require_once('includes/database.php'); 
    include 'includes/defaultMobileNav.php';?>
    <div class="page-container">
        <div class="content-wrap">

            <form method="post" action="includes/login.inc.php">

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
    </div>

    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>