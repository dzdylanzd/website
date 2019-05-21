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
    <?php
    require_once('includes/database.php');
    $sql = "select * from Rubriek where Volgnr = ? ";
    $sth = $dbh->prepare($sql);
  $sth->execute(array(-1)) ;
        while ($row = $sth->fetch()) {
            echo" <ul uk-accordion> <li>
            <a class=\"uk-accordion-title\" href=\"test.php?catogorie=$row[Rubrieknummer]\">                  
            <input type=\"radio\" name=\"Rubriek\" value=\"$row[Rubrieknummer]\">$row[Rubrieknaam]<br>
            </a>  <div class=\"uk-accordion-content\">";
echo"jan";
            echo"</div>
        </li>
    </ul>";
        }

    ?>

    <ul uk-accordion>
        <li>
            <a class="uk-accordion-title" href="#">drop</a>
            <div class="uk-accordion-content">
                content</div>
        </li>
    </ul>

</body>