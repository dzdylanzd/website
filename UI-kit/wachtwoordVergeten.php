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
    include 'includes/defaultMobileNav.php';
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">

            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Wachtwoord vergeten</h2>
                </div>
                <form method="post" action="includes/zendWachtwoordVergetenMail.php">
                    <div class="registreerbox witte-tekst">
                        <h3>Wachtwoord vergeten</h3>
                        <p>Beste bezoeker,<br> Voordat u uw wachtwoord kunt wijzigen moet u uw e-mailadres ingeven. <br>
                            Dit doet u door uw e-mail in te geven en op 'E-mail bevestigen' te klikken. Ook moet u uw antwoord op de beveiliginsvraag ingeven.
                        </p>
                        <label for="wachtwoorVergetenEmail">E-mail:</label><br>
                        <input class="uk-input input-registratie" type="email" name="wachtwoorVergetenEmail" id="wachtwoorVergetenEmail"><br>
                        <label for="beveiligingsvraag">Antwoord op de beveiligingsvraag:</label><br>
                        <input class="uk-input input-registratie" type="password" name="beveiligingsvraag" id="beveiligingsvraag"><br>
                        <button class="uk-button knop-email">Bevestigen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>