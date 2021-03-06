<!--                       -->
<!-- navigatiebalk Desktop -->
<!--                       -->
<?php session_start();
include 'database.php';
//haal meldingen op
include 'meldingen.php';
include 'autoRefreshProducts.php'; ?>
<div class="uk-visible@m sticky">

    <!-- navbar -->
    <nav class="uk-navbar-container marginRemove" uk-navbar>
        <div class="uk-navbar-left">
            <div class="uk-navbar-nav">
                <a class=" uk-logo uk-navbar-item logo " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>

            </div>
        </div>
        <div class="uk-navbar-center">
            <div class="uk-navbar-nav">
                <div class="uk-navbar-item ">

                    <!-- haal op form action zoekbalk -->
                    <?php
                    if (isset($_GET['root'])) {
                        $fromSearchAction = "zoeken.php?root=$_GET[root]";
                    } else {
                        $fromSearchAction = "zoeken.php";
                    }

                      // zet zoek
                      if (isset($_POST['search'])) {
                        $_SESSION['search'] = $_POST['search'];
                    } else if (!isset($_SESSION['search'])) {
                        $_SESSION['search'] = "";
                    }

                    ?>
                    <!-- zoek balk -->
                    <form method="post" action="<?php echo $fromSearchAction; ?>">

                        <div class="uk-inline">
                            <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit" "></button>
                            <input class=" uk-input uk-form-width-large " value="<?php if (isset($_SESSION['search'])) {
                                                                                        echo $_SESSION['search'];
                                                                                    } ?>" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="uk-navbar-right">
            <div class="uk-navbar-nav">
                <div class=" uk-navbar-item ">
                    <?php
                    // inlog knop met foutmeldingen
                    if (!isset($_SESSION['userId'])) {
                        echo ' <div class="uk-inline">
                                <button class="uk-button uk-button-primary " type="button">Inloggen</button>
                                <div uk-dropdown="mode: click">
                                    <form method="post" action="includes/login.inc.php">';
                        if (isset($_GET["errorLogin"])) {
                            if ($_GET["errorLogin"] == "leeg") {
                                echo "<br> <p class=\"errorLogin\"> Gelieve alle velden in te vullen. </p>";
                            }
                            if ($_GET["errorLogin"] == "GebruikerBestaatNiet") {
                                echo "<br> <p class=\"errorLogin\"> Deze gebruikersnaam is niet bekend bij ons. </p>";
                            }
                            if ($_GET["errorLogin"] == "verkeerdwachtwoord") {
                                echo "<br> <p class=\"errorLogin\"> Onjuist wachtwoord. </p>";
                            }
                            if ($_GET["errorLogin"] == "geblokkeerd") {
                                echo "<br> <p class=\"errorLogin\"> Dit account is geblokkeerd. </p>";
                            }
                            if ($_GET["errorLogin"] == "sql") {
                                echo "<br> <p class=\"errorLogin\"> Er is een onverwachte foutmelding opgetreden. Probeer het opnieuw. </p>";
                            }
                        }
                        echo '<div class="uk-margin">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                <input class="uk-input" name="gebruikersnaam" type="text">
                                            </div>
                                        </div>

                                        <div class="uk-margin">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                <input class="uk-input" name="wachtwoord" type="password">
                                            </div>
                                        </div>
                                        <button class="loginknop uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button>
                                    </form>
                                    <a class="uk-link-muted" href="wachtwoordVergeten.php">Wachtwoord vergeten?</a>';
                        echo '
                                </div>
                            </div>
                            </div>
                            <div class="uk-navbar-right">
                                <div class="uk-navbar-nav">
                                    <div class=" uk-navbar-item ">

                                        <div class=" uk-navbar-item "> <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'email-Bevestiging.php\'">registreren</button>
                                        </div>
                                    </div>
                                </div>';
                    } else {
                        $gebruikersnaam = $_SESSION['userId'];
                        // haal soort gebruiker op 
                        $sql = 'SELECT Gebruikersnaam,SoortGebruiker FROM Gebruiker WHERE gebruikersnaam = ?';
                        if ($sth = $dbh->prepare($sql)) {
                            if ($sth->execute(array($gebruikersnaam))) {
                                while ($row = $sth->fetch()) {
                                    $gebruikersnaam = $row['Gebruikersnaam'];
                                    if ($row['SoortGebruiker'] == 'A') {
                                        $activatie = true;
                                    } else {
                                        $activatie = false;
                                    }
                                    if ($row['SoortGebruiker'] == 'V') {
                                        $verkoper = true;
                                    } else {
                                        $verkoper = false;
                                    }
                                    if ($row['SoortGebruiker'] == 'B') {
                                        $beheerder = true;
                                    } else {
                                        $beheerder = false;
                                    }
                                }
                            }
                        }

                        // gebruikers navigatie gebaseerd op accounttype
                        if ($verkoper) {
                            echo '<div class="uk-inline">
                        <button class=" knop-lang uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                        <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                        <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                        <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button></div> </div>';
                        } else if ($activatie) {
                            echo '<div class="uk-inline">
                            <button class="knop-lang uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                            <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperActiveren.php\'">Verkoper activeren</button></div> </div>';
                        } else if ($beheerder) {
                            echo '<div class="uk-inline">
                            <button class=" knop-lang uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                            <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'BeheerderLogging.php\'">Beheerder logging</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'blokkeerGebruiker.php\'">Gebruiker blokkeren</button>
                            <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button></div> </div>';
                        } else {
                            echo '<div class="uk-inline">
                        <button class="knop-lang uk-button uk-button-default uk-margin-right" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                        <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                        <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                        <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperWorden.php\'">Verkoper worden</button></div> </div>';
                        }
                        echo '<button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button>';
                    }
                    ?>
    </nav>
</div>
















<!--                      -->
<!-- navigatiebalk tablet -->
<!--                      -->
<div class="uk-visible@s uk-hidden@m sticky ">


    <nav class="uk-navbar-container" uk-navbar>

        <div class="uk-navbar-nav">

            <a class=" uk-logo uk-navbar-item logo" href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>

        </div>


        <div class="uk-navbar-nav">
            <div class="uk-navbar-item ">
                <!-- haal op form action zoekbalk -->
                <?php
                if (isset($_GET['root'])) {
                    $fromSearchAction = "zoeken.php?root=$_GET[root]";
                } else {
                    $fromSearchAction = "zoeken.php";
                }
                  // zet zoek
                  if (isset($_POST['search'])) {
                    $_SESSION['search'] = $_POST['search'];
                } else if (!isset($_SESSION['search'])) {
                    $_SESSION['search'] = "";
                }
                ?>
                <!-- nav bar -->
                <form method="post" action="<?php echo $fromSearchAction; ?>">

                    <div class="uk-inline">
                        <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                        <input class="uk-input uk-form-width-medium" type="text" name="search" value="<?php if (isset($_SESSION['search'])) {
                                                                                        echo $_SESSION['search'];
                                                                                    } ?>" placeholder="Waar bent u naar op zoek?">
                    </div>
                </form>
            </div>
        </div>

        <!-- navigatie balk -->
        <div class="uk-navbar-nav">
            <div class=" uk-navbar-item ">
                <!-- login kop met foutmeldingen -->
                <?php
                if (!isset($_SESSION['userId'])) {
                    echo ' <div class="uk-inline">
    <button class="uk-button uk-button-primary " type="button">Inloggen</button>
    <div uk-dropdown="mode: click">
        <form method="post" action="includes/login.inc.php">

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input" name="gebruikersnaam" type="text">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                    <input class="uk-input" name="wachtwoord" type="password">
                </div>
            </div>
            <button class="loginknop uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button>
        </form>
        <a class="uk-link-muted" href="wachtwoordVergeten.php">Wachtwoord vergeten?</a>';
                    // foutmeldingen
                    if (isset($_GET["errorLogin"])) {
                        if ($_GET["errorLogin"] == "leeg") {
                            echo "<br> <p class=\"errorLogin\"> Niet alle velden zijn ingevuld </p>";
                        }
                        if ($_GET["errorLogin"] == "GebruikerBestaatNiet") {
                            echo "<br> <p class=\"errorLogin\"> Deze gebruiker bestaat niet </p>";
                        }
                        if ($_GET["errorLogin"] == "verkeerdwachtwoord") {
                            echo "<br> <p class=\"errorLogin\"> Onjuist wachtwoord </p>";
                        }
                        if ($_GET["errorLogin"] == "sql") {
                            echo "<br> <p class=\"errorLogin\"> Er is een fout opgelopen, probeer het opnieuw </p>";
                        }
                    }
                    echo '
                                </div>
                            </div>
                        </div>
                        <div class="uk-navbar-right">
                            <div class="uk-navbar-nav">
                                <div class=" uk-navbar-item ">

                                    <div class=" uk-navbar-item "> <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'email-Bevestiging.php\'">registreren</button>
                                    </div>
                                </div>
                            </div>';
                } else {

                    // haal op soort
                    $gebruikersnaam = $_SESSION['userId'];

                    $sql = 'SELECT Gebruikersnaam,SoortGebruiker FROM Gebruiker WHERE gebruikersnaam = ?';
                    if ($sth = $dbh->prepare($sql)) {
                        if ($sth->execute(array($gebruikersnaam))) {
                            while ($row = $sth->fetch()) {
                                $gebruikersnaam = $row['Gebruikersnaam'];
                                if ($row['SoortGebruiker'] == 'V') {
                                    $verkoper = true;
                                } else {
                                    $verkoper = false;
                                }
                                if ($row['SoortGebruiker'] == 'A') {
                                    $activatie = true;
                                } else {
                                    $activatie = false;
                                }
                                if ($row['SoortGebruiker'] == 'B') {
                                    $beheerder = true;
                                } else {
                                    $beheerder = false;
                                }
                            }
                        }
                    }

                    // gebruikers navigatie gebaseerd op accounttype
                    if ($verkoper) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button></div> </div>';
                    } else if ($activatie) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                    <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                    <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                    <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperActiveren.php\'">Verkoper activeren</button></div> </div>';
                    }
                    if ($beheerder) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'beheerderLogging.php\'">Beheerder logging</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'blokkeerGebruiker.php\'">Blokkeer Gebruiker</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button></div> </div>';
                    } else {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span>' . $gebruikersnaam . ' </button>
                <div uk-dropdown="mode: click"><button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                <button class="knop-lang uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperWorden.php\'">Verkoper worden</button></div> </div>';
                    }
                    echo '<button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button>';
                }
                ?>


            </div>

    </nav>

</div>


</nav>