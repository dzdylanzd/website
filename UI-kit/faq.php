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
                    <h2>F.A.Q.</h2>
                    <p><i>Frequently Asked Questions</i></p>
                </div>
                <div class="registreerbox">
                    <h3><i> Hoe moet ik een product verkopen op EenmaalAndermaal? </i></h3>
                    <p class="witte-tekst margin-lr text-align-left"> Als u een account heeft gemaakt, kan u bieden op veilingen. 
                        Wilt u zelf ook veilingen maken en uw producten verkopen? 
                        Dit kan door op uw gebruikersnaam te klikken naast de zoekbalk en te navigeren naar 
                        'Verkoper worden'. Als u eenmaal verkoper bent kan u op dezelfde plek een knop vinden naar
                        'Mijn veilingen', hier vindt u al uw veilingen en maakt u nieuwe veilingen.
                    </p>
                </div>
                <div class="registreerbox">
                    <h3><i> Ik ben mijn gebruikersnaam of wachtwoord vergeten! Wat nu? </i></h3>
                    <p class="witte-tekst margin-lr text-align-left"> Geen zorgen. Als u op 'Inloggen' klikt in de navigatiebalk, 
                        vindt u onderaan een tekstknopje 'Wachtwoord vergeten?'. Als u hier op klikt krijgt u uw gebruikersnaam 
                        naar uw e-mailadres gestuurd en een nieuw tijdelijk wachtwoord waarmee u kan inloggen. Dit wachtwoord kan
                        u dan wijzigen op de 'Mijn gegevens' pagina.
                    </p>
                </div>
                <div class="registreerbox">
                    <h3><i> Hoe kan ik mijn contact- of accountgegevens aanpassen? </i></h3>
                    <p class="witte-tekst margin-lr text-align-left"> Als u op uw gebruikersnaam klikt in de navigatiebalk en vervolgens
                        klikt op 'Mijn gegevens', kan u al uw gegevens vinden. Onderaan de pagina vindt u een knop om uw gegevens te wijzigen.
                    </p>
                </div>
                <div class="registreerbox">
                    <h3><i> Hoe kan ik mijn account verwijderen? </i></h3>
                    <p class="witte-tekst margin-lr text-align-left"> Als u op uw gebruikersnaam klikt in de navigatiebalk en vervolgens
                        klikt op 'Mijn gegevens', kan u al uw gegevens vinden. Onderaan de pagina vindt u een knop om uw account definitief te verwijderen.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>