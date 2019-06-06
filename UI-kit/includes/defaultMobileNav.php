<div class="uk-hidden@s">
    <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>
        <div class="uk-navbar-nav  uk-flex-center">
            <a class=" uk-logo uk-navbar-item " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>
        </div>
        <div class="uk-navbar-nav  uk-flex-center">
            <div class="uk-navbar-item ">


                <?php
                //bepaal de action van het zoek form
                if (isset($_GET['root'])) {
                    $fromSearchAction = "zoeken.php?root=$_GET[root]";
                } else {
                    $fromSearchAction = "zoeken.php";
                }

                ?>

                <!-- Zoek balk -->
                <form method="post" action="<?php echo $fromSearchAction; ?>">

                    <div class="uk-inline">
                        <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                        <input class="uk-input  " type="text" name="search" placeholder="Waar bent u naar op zoek?">
                    </div>
                </form>

<!-- inloggen mobile -->
                <?php
                if (!isset($_SESSION['userId'])) {
                    echo ' <a class="uk-margin-left" href="inloggen-Mobile.php" uk-icon="icon: user"></a>';
                } else {



                    $gebruikersnaam = $_SESSION['userId'];

                  //bepaal soort gebruiker
                    $sql = 'SELECT SoortGebruiker,Gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ?';
                    if ($sth = $dbh->prepare($sql)) {
                        if ($sth->execute(array($gebruikersnaam))) {
                            while ($row = $sth->fetch()) {
                              
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
                   
//echo nav afhankelijk van accounttype
                    if ($verkoper) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span> </button>
                <div uk-dropdown="mode: click"><button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button></div> </div>';
                    } else if ($activatie) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span> </button>
                    <div uk-dropdown="mode: click"><button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperActiveren.php\'">Verkoper activeren</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button></div> </div>';
                    } else if ($beheerder) {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span> </button>
                    <div uk-dropdown="mode: click"><button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-veilingen.php\'">Mijn veilingen</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'gebruikerBlokkeren.php\'">Gebruiker blokkeren</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'beheerderLogging.php\'">Beheerder logging</button>
                    <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button></div> </div>';
                    } else {
                        echo '<div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span> </button>
                <div uk-dropdown="mode: click"><button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-biedingen.php\'">Mijn biedingen</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'VerkoperWorden.php\'">Verkoper worden</button>
                <button class="mobileNav uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button></div> </div>';
                    }
                }


                ?>
            </div>
        </div>
    </nav>
</div>