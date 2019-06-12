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

            <?php
            // error handlers
            if (isset($_GET['errorVerkoper'])) {
                $errorBericht = ($_GET['errorVerkoper']);
                if ($errorBericht == 'leegVeld') {
                    echo '<p class="errors">Vul alle velden in</p>';
                } else if ($errorBericht == 'onjuisteCreditcard') {
                    echo '<p class="errors">Het ingevulde creditcardnummer is ongeldig</p>';
                } else if ($errorBericht == 'teKortBank') {
                    echo '<p class="errors">Het ingevulde bankrekeningnummer is te kort</p>';
                }
            }
            ?>
            <div class="uk-flex uk-flex-center ">
                <div class="verkoper" uk-filter="target: .js-filter">
                    <h2> Aanmaken verkoopaccount </h2>
                    <p class="voorwaarden">Kies hieronder uw gewenste identificatie methode.</p>
                    <ul class="uk-subnav uk-subnav-pill">
                        <li class="uk-active" uk-filter-control=".tag-email"><a href="#">Email</a></li>
                        <li uk-filter-control=".tag-creditcard"><a href="#">Creditcard</a></li>
                    </ul>

                    <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid>
                        <li class="tag-creditcard verkoopbox">

                            <h3>Identificatiemethode creditcard:</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="creditcard">Creditcardnummer</label><br>
                                <input class="uk-input input-registratie" type="number" name="creditcard" id="creditcard"><br>
                                <button name="verkoopaccountAanvragen" type="submit" class="submit-button uk-button">Verkoopaccount activeren</button>
                            </form>

                        </li>
                        <li class="tag-email verkoopbox">

                            <h3>Identificatiemethode email:</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="bank">Bank</label><br>
                                <input class="uk-input input-registratie" type="text" name="bank" id="bank"><br>
                                <label for="rekeningnummer">Rekeningnummer</label><br>
                                <input class="uk-input input-registratie" type="text" name="rekeningnummer" id="rekeningnummer"><br>
                                <button name="verkoopaccountAanvragen" type="submit" class="submit-button uk-button">Verkoopaccount aanvragen</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>