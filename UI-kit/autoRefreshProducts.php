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
<?php
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 50; URL=$url1");
?>

<body>
    <?php include 'includes\nav-L-M.php';
    include 'includes/defaultMobileNav.php';
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">


            <div class="uk-flex-center uk-flex-column">


                <div class="registreerbox">

                    <h3>auto Refresh..</h3>
                    <?php

                    $sql12 = "select * from Voorwerp where LooptijdEinde < getdate() and IsVeilingGesloten = 0";
                    if ($sth12 = $dbh->prepare($sql12)) {
                        if ($sth12->execute(array())) {
                            if ($alles = $sth12->fetch()) {
                                $sth12->execute(array());
                                while ($alles = $sth12->fetch()) {
                                    $voorwerpNummer = $row['VoorwerpNummer'];
                                    $_SESSION['PID'] = $voorwerpNummer;
                                    require_once('includes/timer.php');
                                }
                            }
                        }
                    }

                    ?>

                </div>

            </div>
        </div>
    </div>

    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>