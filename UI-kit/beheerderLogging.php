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
                <h2> Beheerder logging </h2>
                <p class="voorwaarden"></p>
                <ul class="uk-subnav uk-subnav-pill">
                    <li class="uk-active" uk-filter-control=".tag-email"><a href="#">activiteit</a></li>
                    <li uk-filter-control=".tag-creditcard"><a href="#">verdachte gebruikesr</a></li>
                </ul>

                <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid>
                    <li class="tag-creditcard verkoopbox">
                        <div class="verkoopbox">
                        <div class="verkoopbox">
                            <h3>blacklist:</h3>
                            <h3>blacklist item toevoegen</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="blacklistItemT">blacklist Item</label><br>
                                <input class="uk-input input-registratie" type="text" name="blacklistItemT" id="blacklistItemT"><br>
                                <button name="Toevoegen" type="submit" class="uk-button knop-lang">blacklist item toevoegen</button>
                            </form>
                            <br>
                            <h3>blacklist item verwijderen</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="blacklistItemV">blacklist Item</label><br>
                                <input class="uk-input input-registratie" type="text" name="blacklistItemV" id="blacklistItemV"><br>
                                <button name="Verwijderen" type="submit" class="uk-button knop-lang">blacklist item verwijderen</button>
                            </form>
                            <br>
                            <h3>verdachte gebruikers:</h3>
                        </div>
                        </div>
                    </li>
                    <li class="tag-email verkoopbox">
                        <div class="verkoopbox">
                            <h3>blacklist:</h3>
                            <h3>blacklist item toevoegen</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="blacklistItemT">blacklist Item</label><br>
                                <input class="uk-input input-registratie" type="text" name="blacklistItemT" id="blacklistItemT"><br>
                                <button name="Toevoegen" type="submit" class="uk-button knop-lang">blacklist item toevoegen</button>
                            </form>
                            <br>
                            <h3>blacklist item verwijderen</h3>
                            <form method="post" action="includes/verkoperWorden.inc.php">
                                <label for="blacklistItemV">blacklist Item</label><br>
                                <input class="uk-input input-registratie" type="text" name="blacklistItemV" id="blacklistItemV"><br>
                                <button name="Verwijderen" type="submit" class="uk-button knop-lang">blacklist item verwijderen</button>
                            </form>
                            <br>
                            <h3>verdachte gebruikers:</h3>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    </div>
    </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>