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

            <div class="verkoper" uk-filter="target: .js-filter">
                <?php 
                // error handlers
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "leeg") {
                        echo "<br> <p class=\"error\"> Gelieve alle velden in te vullen. </p>";
                    }
                }
                ?>
                <h2> Activeren verkoopaccount </h2>
                <p class="voorwaarden">Voer hier uw veificatiecode in die u per mail ontvangen heeft.</p>
                <div class="verkoopbox">
                    <h3>Activeren</h3>
                    <form method="post" action="includes/verkoperActiveren.inc.php">
                        <label for="verificatiecode">Verificatiecode</label><br>
                        <input class="uk-input input-registratie" type="text" name="verificatiecode" id="verificatiecode"><br>
                        <button name="verkoopaccountActiveren" type="submit" class="uk-button knop-lang">Verkoopaccount activeren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>