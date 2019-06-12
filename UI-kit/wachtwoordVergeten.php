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
    require_once('includes/database.php');
    ?>
    <div class="page-container">
        <div class="content-wrap">

            <?php
            // error handlers
            if (isset($_GET['error'])) {
                $errorBericht = ($_GET['error']);
                if ($errorBericht == 'legeemail') {
                    echo '<p class="errors">Vul alle velden in</p>';
                }
                else if ($errorBericht == 'fout') {
                    echo '<p class="errors">De ingevoerde velden zijn incorrect</p>';
                }
            }
            ?>

            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Wachtwoord vergeten</h2>
                </div>
                <form method="post" action="includes/zendWachtwoordVergetenMail.php">
                    <div class=" witte-tekst registreerbox ">
                        <h3>Wachtwoord vergeten</h3>
                        <p>Beste bezoeker,<br> Voordat u uw wachtwoord kunt wijzigen, moet u uw e-mailadres ingeven. <br>
                            Dit doet u door uw e-mail en uw antwoord op de beveiligingsvraag in te geven.
                        </p>
                        <label for="wachtwoordVergetenEmail">E-mail:</label><br>
                        <input class="uk-input input-registratie" type="email" name="wachtwoordVergetenEmail" id="wachtwoordVergetenEmail"><br>
                        <label for="beveiligingsvraag">Antwoord op de beveiligingsvraag:</label><br>
                        <select class="uk-select input-registratie margin-bottom" name="bevestigingsvraag">
                            <?php
                            // Haal de beveiligingsvraag op
                            $sql = "SELECT * from Vraag ORDER BY Vraagnummer ASC";
                            if ($sth = $dbh->prepare($sql)) {
                                if ($sth->execute(array())) {
                                    while ($vraag = $sth->fetch()) {
                                        echo '<option value=' . $vraag[' Vraagnummer'] . '>' . $vraag['TekstVraag'] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select> <input class="uk-input input-registratie" type="password" name="beveiligingsvraag" id="beveiligingsvraag"><br>
                        <button class="uk-button knop-email">Bevestigen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>