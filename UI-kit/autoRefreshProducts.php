<?php
session_start();


?>


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
               
            
                    <div class="registreerbox">

                        <h3>Persoonsgegevens</h3>
                        <label class="registreerlabel" for="voornaam">Voornaam *</label><br>
                        <input class="uk-input input-registratie" type="text" id="voornaam" name="voornaam"><br>
                        <label class="registreerlabel" for="achternaam">Achternaam *</label><br>
                        <input class="uk-input input-registratie" type="text" id="achternaam" name="achternaam"><br>
                        <label class="registreerlabel" for="geboortedatum">Geboortedatum *</label><br>
                        <input class="uk-input input-registratie" type="date" id="geboortedatum" name="geboortedatum"><br>
                        <label class="registreerlabel" for="telefoonnummer">Telefoonnummer *</label><br>
                        <input class="uk-input input-registratie" type="number" placeholder="minimaal 8 tekens" id="telefoonnummer" name="telefoonnummer"><br>
                    </div>
                    
            </div>
        </div>
        <?php include 'includes/footer.inc.php'; ?>
</body>

</html>