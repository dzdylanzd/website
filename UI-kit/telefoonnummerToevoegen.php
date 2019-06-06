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

<?php
            if (isset($_GET['error'])) {
                $errorBericht = ($_GET['error']);
                switch ($errorBericht) {
                        case 8:
                        echo '<p class="errors">Het telefoonnummer is te kort.</p>';
                        break;
                    default:
                        echo '<p class="errors">Onverwachte error, probeer het opnieuw';
                }
            }
            ?>

    <div class="page-container">
        <div class="content-wrap">
            <div class="registreerbox">
                <!-- telefoonnummer toevoegen form -->
                <form method="post" action="includes\telefoonNummerToevoegen.inc.php">
                    <label class="registreerlabel" for="telefoonNummer"><h3>Telefoonnummer toevoegen</h3></label><br>
                    <input class="uk-input input-registratie" type="number" id="telefoonNummer" name="telefoonNummer" placeholder="Vul hier uw telefoonnummer in">
                    <button type="submit" name="submit" class="uk-button input-registratie">Telefoonnummer toevoegen</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>
</html>