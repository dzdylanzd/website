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
    
    if($_SESSION['soortGebruiker'] !== 'B'){
        header("Location: index.php");
        exit();
    }
    
    
    ?>
    <div class="page-container">
        <div class="content-wrap">

            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Gebruiker blokkeren</h2>
                    
                </div>
                <div class="registreerbox">
                <h3>Gebruiker blokkeren</h3>
                                <form method="post" action="includes\blokkeerGebruiker.php">
                                    <label for="gebruikersnaam">Gebruikersnaam</label><br>
                                    <input class="uk-input input-registratie" type="text" name="gebruikersnaam" id="gebruikersnaam"><br>
                                    <button name="GebruikerBlokkeren" type="submit" class="uk-button knop-lang">gebruiker blokkeren</button>
                                </form>
                </div>
            
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>