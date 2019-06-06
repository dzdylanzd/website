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
                <!-- Error handlers -->
                <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == "leegveld") {
                        echo '<p class="errors"> Gelieve een code in te vullen. </p>';
                    } else if ($_GET['error'] == "legeEmail") {
                        echo '<p class="errors">  Gelieve een e-mailadres in te vullen. </p>';
                    } else if ($_GET['error'] == "emailInGebruik") {
                        echo '<p class="errors"> Dit e-mailadres is helaas al in gebruik. </p>';
                    } else if ($_GET['error'] == "codeNietMeerValide") {
                        echo '<p class="errors"> De ingevoerde code is niet meer geldig. </p>';
                    } else if ($_GET['error'] == "foutecode") {
                        echo '<p class="errors"> De code is onjuist, gelieve een juiste code in te vullen. </p>';
                    } else if ($_GET['error'] == "codeAlOntvangen") {
                        echo '<p class="errors"> U heeft al een code ontvangen, kijk in uw e-mail. </p>';
                        echo '<p class="errorLogin"><i> Vergeet niet in de mappen junk/spam te kijken! </i></p>';
                    } else if ($_GET['error'] == "fouteEmail") {
                        echo '<p class="errors"> Het ingevoerde e-mailadres is incorrect.</p>';
                    } else if ($_GET['error'] == "succes") {
                        echo '<p class="succes"> Er is een code naar uw e-mailadres verzonden. </p>';
                    } 
                }
                ?>
                <div class="registreren">
                    <h2>Registreren</h2>
                </div>
                <form method="post" action="zendMail.php">
                    <div class="registreerbox">
                        <h3>E-mail bevestiging</h3>
                        <p>Beste bezoeker,<br> Voordat u een gebruiker aan kunt maken moet u eerst uw e-mail adres bevestigen. <br>
                            Dit doet u door uw e-mail in te geven en op 'E-mail bevestigen' te klikken.
                        </p>
                        <label for="emailbevestiging">E-mail:</label><br>
                        <input class="uk-input input-registratie" placeholder="maximaal 60 tekens" type="email" name="emailbevestiging" id="emailbevestiging">
                        <button class="uk-button knop-email">E-mail bevestigen</button>
                    </div>
                </form>
                <div class="registreerbox">
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