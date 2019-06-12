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

    if ($_SESSION['soortGebruiker'] !== 'B') {
        header("Location: index.php");
        exit();
    } ?>
    <div class="page-container">
        <div class="content-wrap">

            <div class="verkoper" uk-filter="target: .js-filter">
                <h2> Beheerderlogging </h2>
                <p class="voorwaarden"></p>
                <ul class="uk-subnav uk-subnav-pill">
                    <li uk-filter-control=".tag-email"><a href="#">activiteit</a></li>
                    <li class="uk-active" uk-filter-control=".tag-creditcard"><a href="#">verdachte gebruikers</a></li>
                </ul>

                <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid>

                    <!-- verdachte gebruikers -->
                    <li class="tag-creditcard verkoopbox">


                        <h3>Blacklist:</h3>
                        <!-- display blacklist -->
                        <?php
                        $sqlBlacklistGet = 'select * from Blacklist';
                        $sth = $dbh->prepare($sqlBlacklistGet);
                        if ($sth->execute(array())) {
                            while ($alles = $sth->fetch()) {
                                echo " $alles[Item]  <br>";
                            }
                        }

                        ?>
                        <h3>Blacklist item toevoegen</h3>
                        <form method="post" action="includes\blacklistBeheer.php">
                            <label for="blacklistItemT">Blacklist Item</label><br>
                            <input class="uk-input input-registratie" type="text" name="blacklistItemT" id="blacklistItemT"><br>
                            <button name="Toevoegen" type="submit" class="uk-button knop-lang">blacklist item toevoegen</button>
                        </form>
                        <br>
                        <h3>Blacklist item verwijderen</h3>
                        <form method="post" action="includes\blacklistBeheer.php">
                            <label for="blacklistItemV">Blacklist Item</label><br>
                            <input class="uk-input input-registratie" type="text" name="blacklistItemV" id="blacklistItemV"><br>
                            <button name="Verwijderen" type="submit" class="uk-button knop-lang">blacklist item verwijderen</button>
                        </form>
                        <br>
                        <h3>Verdachte gebruikers:</h3>

                        <?php
                        $sqlVerdacht = "select distinct Verkoper from Voorwerp where Titel not like '%%'";
                        // maak sql sript verdachte Gebruikes
                        $sqlBlacklistGet = 'select * from Blacklist';
                        $sth = $dbh->prepare($sqlBlacklistGet);
                        if ($sth->execute(array())) {
                            while ($alles = $sth->fetch()) {

                                $sqlVerdacht .= "or Titel like '%$alles[Item]%' ";
                            }
                        }
                        // display verdachte gebruikers
                        $sth = $dbh->prepare($sqlVerdacht);
                        if ($sth->execute(array())) {
                            while ($alles = $sth->fetch()) {

                                echo "$alles[Verkoper] <br>";
                            }
                        }

                        ?>


                    </li>





                    <!-- activiteit logging -->
                    <li class="tag-email verkoopbox">
                        <div>
                            <h3>Activiteit per dag per uur in procenten</h3>
                            <div class="uk-flex uk-flex-center uk-flex-wrap uk-flex-wrap-around">
                                <?php

                                $sqlWeekdagen = 'DECLARE @totaal int = (select  count(Gebruikersnaam) from LoginActiviteit)
                                                select count(Gebruikersnaam) * 100 / @totaal  as percentage,count(Gebruikersnaam) as totaal,  FORMAT(Datum, \'dddd\') as dag from LoginActiviteit
                                                group by FORMAT(Datum, \'dddd\')
                                                order by (count(Gebruikersnaam) * 100 / @totaal )';

                                $sqlUren = 'DECLARE @totaal int= ?
                                            select count(Gebruikersnaam) * 100 / @totaal  as percentage,  FORMAT(Datum, \'dddd\') as dag,DATEPART(HOUR,Datum) as uur from LoginActiviteit
                                            group by FORMAT(Datum, \'dddd\') ,DATEPART(HOUR,Datum)
                                            having FORMAT(Datum, \'dddd\') = ?';

                                // display activiteit op de site
                                $sth = $dbh->prepare($sqlWeekdagen);
                                if ($sth->execute(array())) {
                                    while ($alles = $sth->fetch()) {
                                        $percentage = (double)$alles['percentage'];
                                        echo "<div class=\"uk-inline\">
                                                <button class=\"uk-button uk-button-default\" type=\"button\">$percentage%  $alles[dag]</button>  
                                                <div uk-dropdown=\"mode: click\">";
                                        $sth2 = $dbh->prepare($sqlUren);
                                        if ($sth2->execute(array($alles['totaal'], $alles['dag']))) {
                                            while ($alles2 = $sth2->fetch()) {
                                                $percentage = round($alles2['percentage'], 2);
                                                echo " $alles2[uur]:00 uur $percentage%  <br>";
                                            }
                                        }
                                        echo "</div>
                                        </div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="tag-email verkoopbox">
                        <h3>Aantal actieve gebruikers</h3>
                        <!-- display actieve gebruikers het afgelopen uur -->
                        <?php
                        $sql = 'SELECT COUNT(DISTINCT Gebruikersnaam) AS AantalIngelogd
                                FROM LoginActiviteit
                                WHERE Datum BETWEEN DATEADD(HOUR, -1, GETDATE()) AND GETDATE()';
                        $sth = $dbh->prepare($sql);
                        if ($sth->execute(array())) {
                            while ($alles = $sth->fetch()) {
                                echo " $alles[AantalIngelogd]";
                            }
                        }

                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>